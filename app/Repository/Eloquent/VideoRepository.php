<?php

namespace App\Repository\Eloquent;

use App\Models\Video;
use App\Repository\VideoRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class VideoRepository extends BaseRepository implements VideoRepositoryInterface
{
   /**
    * VideoRepository constructor.
    *
    * @param Video $model
    */
   public function __construct(Video $model)
   {
       parent::__construct($model);
   }

   /**
    * @return LengthAwarePaginator
    */
   public function paginate(): LengthAwarePaginator
   {
       return $this->model->orderBy('id', 'DESC')->paginate(10);    
   }

    /**
    * @return Collection
    */
    public function all(): Collection
    {
        return $this->model->all();    
    }

    /**
    * @param array $attributes
    *
    * @return Model|null
    */
    public function create(array $attributes)
    {
        $attributes['created_by'] = auth()->user()->id;
        $video = $this->model->create($attributes);

        if (request()->has('image_url')) {
            $imageUrl = $this->uploadthumb($video);
            if($imageUrl == false){
                $video->delete();
                return [
                    'status' => false,
                    'errors' => [
                        'image_url' => ['Warng was happen when image upload.']
                    ],
                    'data' => null
                ];
            }
        }
        if (request()->has('video_uri')) {
            $videoUri = $this->uploadVideo($video);
            if($videoUri == false){
                $video->delete();
                return [
                    'status' => false,
                    'errors' => [
                        'video_uri' => ['Warng was happen when video upload.']
                    ],
                    'data' => null
                ];
            }
        }
        $video->update([
            'image_url' => $imageUrl,
            'video_uri' => $videoUri
        ]);

        return [
            'status' => true, 
            'data' => $video,
            'errors' => null
        ];    
    }

    /**
     * Upload thumb to public/images directory
     * 
     */
    private function uploadthumb($video)
    {
        $image = request()->file('image_url');

        // Get filename with the extension
        $filenameWithExt = $image->getClientOriginalName();
        // Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just ext
        $extension = $image->getClientOriginalExtension();

        $fileNameToStore = 'image-' . $video->id . '.' . $extension;
        $path = $image->storeAs('public',  $fileNameToStore);
        $image->move(base_path('\public\images'), $fileNameToStore);
        $fileNameToStore = Str::replaceFirst('public/', '', $path);

        if(file_exists(public_path().'/images/'. $fileNameToStore) && Storage::exists('public/' . $fileNameToStore)){
            Storage::delete('public/' . $fileNameToStore);
            return $fileNameToStore;
        }

        return null;
    }

    /**
     * Upload video to public/videos directory
     * 
     */
    private function uploadVideo($video)
    {
        $file = request()->file('video_uri');

        // Get filename with the extension
        $filenameWithExt = $file->getClientOriginalName();
        // Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just ext
        $extension = $file->getClientOriginalExtension();

        $fileNameToStore = 'video-' . $video->id . '.' . $extension;
        $path = $file->storeAs('public',  $fileNameToStore);
        $file->move(base_path('\public\videos'), $fileNameToStore);
        $fileNameToStore = Str::replaceFirst('public/', '', $path);

        if(file_exists(public_path().'/videos/'. $fileNameToStore) && Storage::exists('public/' . $fileNameToStore)){
            Storage::delete('public/' . $fileNameToStore);
            return $fileNameToStore;
        }
        
        return null;
    }
}
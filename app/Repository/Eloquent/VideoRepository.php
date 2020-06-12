<?php

namespace App\Repository\Eloquent;

use App\Models\Video;
use App\Repository\VideoRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

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
       return $this->model->paginate();    
   }

    /**
    * @param array $attributes
    *
    * @return Model
    */
    public function create(array $attributes): Model
    {
        $attributes['created_by'] = auth()->user()->id;
        $video = $this->model->create($attributes);

        if (request()->has('image_url')) {
            $this->uploadthumb($video);
        }

        if (request()->has('video_uri')) {
            $this->uploadVideo($video);
        }
        return $video;    
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
        
        $video->update([
            'image_url' => $fileNameToStore
        ]);

        return $video;
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
        
        $video->update([
            'video_uri' => $fileNameToStore
        ]);

        return $video;
    }
}
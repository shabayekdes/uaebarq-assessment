<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\VideoRepositoryInterface; 
use App\Http\Resources\VideoResource;
use App\Http\Requests\storeVideoRequest;

class VideoController extends Controller
{
    /**
     * @var VideoRepositoryInterface
     */
    private $videoRepository;
  
    /**
     * Video Controller constructor.
     *
     * @param VideoRepositoryInterface $videoRepository
     */
    public function __construct(VideoRepositoryInterface $videoRepository)
    {
        $this->videoRepository = $videoRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = $this->videoRepository->paginate();

        return VideoResource::collection($videos);

        // return response()->json(['status' => true ,'data'=> $video, 'message' => 'List videos','errors' => null]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  storeVideoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeVideoRequest $request)
    {
        $video = $this->videoRepository->create($request->all());
        if($video['status'] == false){
            return response()->json(['status' => false ,'data'=> null, 'message' => 'List videos','errors' => $video['errors']], 422);
        }
        return new VideoResource($video['data']);    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

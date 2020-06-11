<?php

namespace App\Repository\Eloquent;

use App\Models\Video;
use App\Repository\VideoRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

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
    * @return Collection
    */
   public function paginate(): LengthAwarePaginator
   {
       return $this->model->paginate();    
   }
}
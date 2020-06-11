<?php

namespace App\Repository;

use App\Models\Video;
use Illuminate\Pagination\LengthAwarePaginator;

interface VideoRepositoryInterface
{
   public function paginate(): LengthAwarePaginator ;
}
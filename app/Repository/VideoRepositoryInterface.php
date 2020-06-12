<?php

namespace App\Repository;

use App\Models\Video;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface VideoRepositoryInterface
{
   public function paginate(): LengthAwarePaginator ;

   public function all(): Collection;
}
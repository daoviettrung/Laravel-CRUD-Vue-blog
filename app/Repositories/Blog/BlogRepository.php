<?php

namespace App\Repositories\Blog;

use App\Repositories\BaseRepository;
use App\Repositories\Blog\BlogRepositoryInterface;

class BlogRepository extends BaseRepository implements BlogRepositoryInterface
{
    /**
     * get the corresponding model
     */
    public function getModel()
    {
        return \App\Models\Blog::class;
    }

    public function search($title){
        $result  = $this->model::where('title','like', $title ."%")
        ->get();
        return $result;
    }
}
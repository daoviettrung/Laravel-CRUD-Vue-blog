<?php

namespace App\Repositories\Blog;

use App\Repositories\RepositoryInterface;

interface BlogRepositoryInterface extends RepositoryInterface
{
    /**
     * Search
     * @param $title
     * @return object
     */
    public function search($title);
}

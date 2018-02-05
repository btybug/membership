<?php

namespace BtyBugHook\Membership\Repository;

use Btybug\btybug\Models\Universal\Paginator;
use Btybug\btybug\Repositories\GeneralRepository;
use BtyBugHook\Membership\Models\Blog;

class BlogRepository extends GeneralRepository
{
    /**
     * @return mixed
     */
    public function getGroupedWithAuthor ($id)
    {
        return $this->model->where('author_id', $id)->get();
    }

    public function getActive ()
    {
        return $this->model->where('status', true)->get();
    }


    public function model ()
    {
        return new Blog();
    }
}
<?php

namespace BtyBugHook\Membership\Repository;

use Btybug\btybug\Repositories\GeneralRepository;
use BtyBugHook\Membership\Models\MembershipTypes;

class MembershipTypesRepository extends GeneralRepository
{
    /**
     * @return mixed
     */

    public function model()
    {
        return new MembershipTypes();
    }

    public function makeDefault(int $id)
    {
        $this->model()->where('is_default', 1)->update(['is_default' => 0]);
        return $this->model()->where('id', $id)->update(['is_default' => 1]);

    }

    public function getDefault()
    {
        return $this->model()->where('is_default', 1)->first();
    }
}
<?php

namespace BtyBugHook\Membership\Repository;

use Btybug\btybug\Repositories\GeneralRepository;
use BtyBugHook\Membership\Models\MembershipStatuses;

class MembershipStatusesRepository extends GeneralRepository
{
    /**
     * @return mixed
     */

    public function model ()
    {
        return new MembershipStatuses();
    }

    public function getDefault ()
    {
        return $this->model()->where('type', 'core')->first();
    }
}
<?php

namespace BtyBugHook\Membership\Repository;

use Btybug\btybug\Repositories\GeneralRepository;
use BtyBugHook\Membership\Models\MembershipTypes;
use BtyBugHook\Membership\Models\Plans;

class MembershipTypesRepository extends GeneralRepository
{
    /**
     * @return mixed
     */

    public function model()
    {
        return new MembershipTypes();
    }
}
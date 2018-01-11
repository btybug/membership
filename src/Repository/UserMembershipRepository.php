<?php

namespace BtyBugHook\Membership\Repository;

use Btybug\btybug\Repositories\GeneralRepository;
use BtyBugHook\Membership\Models\MembershipTypes;
use BtyBugHook\Membership\Models\UserMembership;

class UserMembershipRepository extends GeneralRepository
{
    /**
     * @return mixed
     */

    public function model()
    {
        return new UserMembership();
    }

}
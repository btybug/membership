<?php

namespace BtyBugHook\Membership\Repository;

use Btybug\btybug\Repositories\GeneralRepository;
use BtyBugHook\Membership\Models\Plans;

class PlansRepository extends GeneralRepository
{
    /**
     * @return mixed
     */

    public function model ()
    {
        return new Plans();
    }
}
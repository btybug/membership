<?php
/**
 * Created by PhpStorm.
 * User: menq
 * Date: 11.01.2018
 * Time: 13:30
 */

namespace BtyBugHook\Membership\Models;


use Laravel\Cashier\Billable;

class User extends \Btybug\User\User
{
    use Billable;

    public function membership()
    {
       return $this->belongsTo(MembershipTypes::class,'membership_id');
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 11.01.2018
 * Time: 23:03
 */

namespace BtyBugHook\Membership\Models;


use Illuminate\Database\Eloquent\Model;

class UserMembership extends Model
{

    protected $table = 'user_membership';

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function membership_type()
    {
        return $this->belongsTo(MembershipTypes::class, 'membership_type_id');
    }

    public function status()
    {
        return $this->belongsTo(MembershipStatuses::class, 'status_id');
    }
}
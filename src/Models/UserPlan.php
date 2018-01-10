<?php namespace BtyBugHook\Membership\Models;

use Btybug\User\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 08.01.2018
 * Time: 23:10
 */
class UserPlan extends Model
{

    protected $table = 'user_plan';

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function plan()
    {
        return $this->belongsTo(Plans::class, 'plan_id');
    }
}
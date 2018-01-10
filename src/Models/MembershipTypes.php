<?php namespace BtyBugHook\Membership\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 08.01.2018
 * Time: 23:10
 */

class MembershipTypes extends Model
{

    protected $table='membership_types';

    protected $guarded=['id'];

    public function plan(){
        return $this->belongsTo(Plans::class,'plan_id');
    }
}
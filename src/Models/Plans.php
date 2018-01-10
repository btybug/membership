<?php namespace BtyBugHook\Membership\Models;
use Btybug\User\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 08.01.2018
 * Time: 23:10
 */

class Plans extends Model
{

    protected $table='plans';

    protected $guarded=['id'];

    public function users(){
        return $this->morphedByMany(User::class,'user_plan');
    }
}
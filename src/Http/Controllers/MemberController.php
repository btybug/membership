<?php
/**
 * Created by PhpStorm.
 * User: menq
 * Date: 11.01.2018
 * Time: 17:34
 */

namespace BtyBugHook\Membership\Http\Controllers;


use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    public function getIndex()
    {
        return view('mbshp::members.index');
    }
}
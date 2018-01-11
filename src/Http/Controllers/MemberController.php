<?php
/**
 * Created by PhpStorm.
 * User: menq
 * Date: 11.01.2018
 * Time: 17:34
 */

namespace BtyBugHook\Membership\Http\Controllers;


use App\Http\Controllers\Controller;
use Btybug\User\Repository\UserRepository;
use BtyBugHook\Membership\Models\MembershipTypes;
use BtyBugHook\Membership\Repository\MembershipStatusesRepository;
use BtyBugHook\Membership\Repository\MembershipTypesRepository;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function getIndex()
    {
        return view('mbshp::members.index');
    }
    public function getEdit(
        UserRepository $userRepository,
        MembershipTypesRepository $membershipTypes,
        MembershipStatusesRepository $membershipStatusesRepository,
        $id
    )
    {
        $user=$userRepository->findOrFail($id);
        $mb_types=$membershipTypes->pluck('title','id');
        $mb_types= $mb_types->toArray();
        $mb_types[0]='No Types';

        $mb_status=$membershipStatusesRepository->pluck('title','slug');
        $mb_status= $mb_status->toArray();
        $mb_status[0]='No Status';
        ksort($mb_status);
        return view('mbshp::members.edit',compact('user','mb_types','mb_status'));
    }

    public function postEdit(Request $request,UserRepository $userRepository)
    {
        $userRepository->update($request->get('id',$request->id),$request->except('_token'));
        return redirect()->route('mbsp_stripe');
    }
}
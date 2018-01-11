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
use BtyBugHook\Membership\Models\User;
use BtyBugHook\Membership\Models\UserMembership;
use BtyBugHook\Membership\Repository\MembershipStatusesRepository;
use BtyBugHook\Membership\Repository\MembershipTypesRepository;
use BtyBugHook\Membership\Repository\UserMembershipRepository;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function getIndex()
    {
        return view('mbshp::members.index');
    }

    public function getEdit(
        UserMembershipRepository $userRepository,
        MembershipTypesRepository $membershipTypes,
        MembershipStatusesRepository $membershipStatusesRepository,
        $id
    )
    {
        $user = $userRepository->findOrFail($id);
        $mb_types = $membershipTypes->pluck('title', 'id');
        $mb_status = $membershipStatusesRepository->pluck('title', 'id');
        return view('mbshp::members.edit', compact('user', 'mb_types', 'mb_status'));
    }

    public function postEdit(Request $request, UserMembershipRepository $userRepository)
    {
        $userRepository->update($request->get('id', $request->id), $request->except('_token'));
        return redirect()->route('mbsp_stripe');
    }

    public function getoptimize(
        User $user,
        UserMembership $membership,
        MembershipTypesRepository $membershipTypesRepository,
        MembershipStatusesRepository $membershipStatusesRepository
    )
    {
        $users = $user->where('role_id', 0)->get();
        $data = [];
        $type = $membershipTypesRepository->getDefault();
        $status = $membershipStatusesRepository->getDefault();
        foreach ($users as $user) {
            $data[] = ['user_id' => $user->id, 'membership_type_id' => $type->id, 'status_id' => $status->id];
        }
         dd(\DB::table('user_membership')->insert($data));
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: menq
 * Date: 10.01.2018
 * Time: 19:46
 */

namespace BtyBugHook\Membership\Http\Controllers;


use App\Http\Controllers\Controller;
use BtyBugHook\Membership\Repository\MembershipTypesRepository;
use BtyBugHook\Membership\Repository\PlansRepository;
use Illuminate\Http\Request;

class MembershipController extends Controller
{

    public function getIndex()
    {
        return view('mbshp::membership_types.index');
    }

    public function getNewMembership(PlansRepository $plansRepository,$id = null)
    {
        $model = null;
        if ($id) {
            $membership = new MembershipTypesRepository();
            $model = $membership->findOrFail($id);
        }
        $plans=$plansRepository->pluck('name','id')->toArray();
        return view('mbshp::membership_types.create', compact('model','plans'));
    }

    public function postNewMembership(Request $request,MembershipTypesRepository $repository)
    {

        $data=$request->except('_token');
        $validator = \Validator::make($request->all(), [
            'title' => 'required',
            'icon' => 'required',
            'description' => 'required',
            'is_active' => 'required',
            'is_default' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $params=['id'=>$request->get('id')];
        $result=$repository->updateOrCreate($params,$data);
        if($data['is_default']){
            $repository->makeDefault($result->id);
        }
        return redirect()->route('mbsp_membership');
    }

    public function makeDefault(MembershipTypesRepository $membershipTypesRepository,$id)
    {
        $membershipTypesRepository->makeDefault($id);
        return redirect()->route('mbsp_membership');
    }
}
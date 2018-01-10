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
use Illuminate\Http\Request;

class MembershipController extends Controller
{

    public function getIndex()
    {
        return view('forms::membership_types.index');
    }

    public function getNewMembership($id = null)
    {
        $model = null;
        if ($id) {
            $membership = new MembershipTypesRepository();
            $model = $membership->findOrFail($id);
        }
        return view('forms::membership_types.create', compact('model'));
    }

    public function postNewMembership(Request $request,MembershipTypesRepository $repository)
    {
        $data=$request->except('_token');
        $params=['id'=>$request->get('id')];
        $repository->updateOrCreate($params,$data);
        return redirect()->route('mbsp_membership');
    }
}
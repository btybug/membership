<?php

namespace BtyBugHook\Membership\Http\Controllers;

use App\Http\Controllers\Controller;
use BtyBugHook\Membership\Repository\PlansRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlansController extends Controller
{

    public function createPlans(){
        return view('forms::plans.create');
    }
    public function editPlans(PlansRepository $repo,$id){
        $plan = $repo->find($id);
        if(!$plan){
            abort(404);
        }
        return view('forms::plans.edit',compact("plan"));
    }
    public function saveCreatePlan(PlansRepository $repo, Request $request){

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'price' => 'required|integer',
            'period' => 'required|integer',
            'period_type' => 'required',
            'currency' => 'required',
            'description' => 'required',
            'is_active' => 'required',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        $result = $repo->model()->create($data);

        return redirect()->route('mbsp_plans');
    }
    public function saveEditPlan(PlansRepository $repo, Request $request,$id){

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            //'price' => 'required|integer',
           // 'period' => 'required|integer',
           // 'period_type' => 'required',
            'currency' => 'required',
            'description' => 'required',
            'is_active' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->except('_token','price','period','period_type');

        $repo->update($id,$data);
        return redirect()->route("mbsp_plans");
    }

}
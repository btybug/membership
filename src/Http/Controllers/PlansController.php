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
    public function editPlans($id){
        return view('forms::plans.edit');
    }
    public function saveCreatePlan(PlansRepository $repo, Request $request){

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'price' => 'required|integer',
            'period' => 'required|integer',
            'period_type' => 'required',
            'currency' => 'required',
            'is_active' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        $result = $repo->model()->create($data);

        return redirect()->route('mbsp_plans');
    }
    public function updatePlan(PlansRepository $repo, Request $request,$id){
        $data = $request->all();
        $repo->model()->update($id,$data);
    }

}
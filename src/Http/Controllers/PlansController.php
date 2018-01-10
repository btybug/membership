<?php

namespace BtyBugHook\Membership\Http\Controllers;

use App\Http\Controllers\Controller;
use BtyBugHook\Membership\Repository\PlansRepository;
use Illuminate\Http\Request;

class PlansController extends Controller
{
    public function createPlans(){
        return view('forms::plans.create');
    }
    public function editPlans($id){
        return view('forms::plans.edit');
    }
    public function saveCreatePlan(PlansRepository $repo, Request $request){
        $data = $request->all();
        $repo->model()->create($data);
    }
    public function updatePlan(PlansRepository $repo, Request $request,$id){
        $data = $request->all();
        $repo->model()->update($id,$data);
    }

}
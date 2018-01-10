<?php

namespace BtyBugHook\Membership\Http\Controllers;

use App\Http\Controllers\Controller;
use BtyBugHook\Membership\Repository\PlansRepository;
use Illuminate\Http\Request;

class IndexConroller extends Controller
{
    public function getIndex()
    {
        return view('forms::index');
    }
    public function getPlans()
    {
        return view('forms::plans.index');
    }
    public function getPayments()
    {
        return view('forms::payments.index');
    }
    public function createPlans(){
        return view('forms::plans.create');
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
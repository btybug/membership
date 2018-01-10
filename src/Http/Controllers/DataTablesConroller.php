<?php

namespace BtyBugHook\Membership\Http\Controllers;

use App\Http\Controllers\Controller;
use BtyBugHook\Membership\Models\MembershipTypes;
use BtyBugHook\Membership\Models\Plans;
use BtyBugHook\Membership\Repository\PlansRepository;
use Yajra\DataTables\DataTables;

class DataTablesConroller extends Controller
{

    public function getPlans()
    {
        return DataTables::of(Plans::query())->addColumn('actions', function ($plans) {
            $url= url("admin/membership/plans/edit",$plans->id);
            return "<a href='$url' class='bty-btn-acction bt-edit'></a>";
        },2)->rawColumns(['actions'])->make(true);
  }
  public function getMbTypes()
    {
        return DataTables::of(MembershipTypes::query())->addColumn('actions', function ($membership) {
            $url= route("mbsp_new_membership",$membership->id);
            return "<a href='$url' class='bty-btn-acction bt-edit'></a>";
        },2)->editColumn('plan_id',function ($membership){
            $planRepo=new PlansRepository();
            $id=($membership->plan_id)??0;
            $plan=$planRepo->findBy('id',$id);
            return ($plan) ? $plan->title : 'No Plan';
        })->editColumn('is_active',function ($membership){
            return ($membership->is_active) ? 'Yes' : 'No';
        })->rawColumns(['actions'])->make(true);
  }
}
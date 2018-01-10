<?php

namespace BtyBugHook\Membership\Http\Controllers;

use App\Http\Controllers\Controller;
use BtyBugHook\Membership\Models\MembershipTypes;
use BtyBugHook\Membership\Models\Plans;
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
        return DataTables::of(MembershipTypes::query())->addColumn('actions', function ($plans) {
            $url= url("#",$plans->id);
            return "<a href='$url' class='bty-btn-acction bt-edit'></a>";
        },2)->rawColumns(['actions'])->make(true);
  }
}
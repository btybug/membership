<?php

namespace BtyBugHook\Membership\Http\Controllers;

use App\Http\Controllers\Controller;
use BtyBugHook\Membership\Models\Plans;
use Yajra\DataTables\DataTables;

class DataTablesConroller extends Controller
{
    public function getPlans()
    {
        return DataTables::of(Plans::query())->addColumn('actions', function ($plans) {
            $url= url("admin/membership/plan/edit",$plans->id);
            return "<a href='$url' class='btn btn-warning'><i class='fa fa-edit'></i></a>";
        },2)->make(true);
  }
}
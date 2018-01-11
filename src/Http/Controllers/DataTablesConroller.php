<?php

namespace BtyBugHook\Membership\Http\Controllers;

use App\Http\Controllers\Controller;
use BtyBugHook\Membership\Models\User;
use BtyBugHook\Membership\Models\MembershipStatuses;
use BtyBugHook\Membership\Models\MembershipTypes;
use BtyBugHook\Membership\Models\Plans;
use BtyBugHook\Membership\Repository\PlansRepository;
use Yajra\DataTables\DataTables;

class DataTablesConroller extends Controller
{

    public function getPlans()
    {
        return DataTables::of(Plans::query())->addColumn('actions', function ($plans) {
            $url = url("admin/membership/plans/edit", $plans->id);
            return "<a href='$url' class='bty-btn-acction bt-edit'></a>";
        }, 2)->editColumn('is_active', function ($membership) {
            return ($membership->is_active) ? 'Yes' : 'No';
        })->editColumn('livemode', function ($membership) {
            return ($membership->livemode) ? 'Yes' : 'No';
        })->editColumn('created', function ($membership) {
            return BBgetDateFormat($membership->livemode);
        })->rawColumns(['actions'])->make(true);
    }

    public function getMbTypes()
    {
        return DataTables::of(MembershipTypes::query())->addColumn('actions', function ($membership) {
            $url = route("mbsp_new_membership", $membership->id);
            return "<a href='$url' class='bty-btn-acction bt-edit'></a>";
        }, 2)->editColumn('plan_id', function ($membership) {
            $planRepo = new PlansRepository();
            $id = ($membership->plan_id) ?? 0;
            $plan = $planRepo->findBy('id', $id);
            return ($plan) ? $plan->title : 'No Plan';
        })->editColumn('is_active', function ($membership) {
            return ($membership->is_active) ? 'Yes' : 'No';
        })->rawColumns(['actions'])->make(true);
    }

    public function getMembers()
    {
        return DataTables::of(User::where('role_id',0))
            ->editColumn('membership_id', function ($member) {
                $type=$member->membership;

            return  ($type)?$type->title:'Default Type';
        })->addColumn('actions', function ($member) {
                $url = route("mbsp_edit_member", $member->id);
                return "<a href='$url' class='bty-btn-acction bt-edit'></a>";
            }, 2)->rawColumns(['actions'])->make(true);
    }

    public function getStatuses()
    {
        return DataTables::of(MembershipStatuses::query())->editColumn('actions', function ($status) {
            $url = route("mbsp_settings_status_edit", $status->id);
            $action = "<a href='$url' class='bty-btn-acction bt-edit'></a>";
            if($status->type == 'custom'){
                $del_url = route("mbsp_settings_status_del", $status->id);
                $action.= "<a href='$del_url' class='bty-btn-acction bt-delete'></a>";
            }
            return $action;
        })->editColumn('created_at', function ($status) {
            return BBgetDateFormat($status->created_at);
        })->rawColumns(['actions'])->make(true);
    }
}
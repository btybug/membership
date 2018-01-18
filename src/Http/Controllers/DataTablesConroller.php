<?php

namespace BtyBugHook\Membership\Http\Controllers;

use App\Http\Controllers\Controller;
use BtyBugHook\Membership\Models\Blog;
use BtyBugHook\Membership\Models\MembershipStatuses;
use BtyBugHook\Membership\Models\MembershipTypes;
use BtyBugHook\Membership\Models\Plans;
use BtyBugHook\Membership\Models\UserMembership;
use BtyBugHook\Membership\Repository\BlogRepository;
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
            $makeActive = route("mbsp_type_make_active", $membership->id);
            $html="<a href='$url' class='bty-btn-acction bt-edit'></a>";
            if($membership->is_default){
                $html.="<button class='btn btn-default'>Active</button>";
            }else{
                $html.="<a href='$makeActive' class='btn btn-warning'>Make Active</a>";
            }
            return $html;
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
        return DataTables::of(UserMembership::query())
            ->editColumn('username', function ($member) {
                $user = $member->user;
                return $user->username;
            })->editColumn('email', function ($member) {
                $user = $member->user;
                return $user->email;
            })->editColumn('status', function ($member) {
                $status = $member->status;
                return $status->title;
            })->editColumn('membership_id', function ($member) {
                $type = $member->membership_type;
                return ($type) ? $type->title : 'Default Type';
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
        })->editColumn('icon', function ($status) {
            return '<i class="fa '.$status->icon.'"></i>';
        })->rawColumns(['actions','icon'])->make(true);
    }

    public function getBlogs(BlogRepository $repository)
    {
        return DataTables::of($repository->model()->where('status', true))->addColumn('actions', function ($blog) {
            $url = route("mbsp_blog_edit", $blog->id);
            $deactivate = route("mbsp_blog_deactivate", $blog->id);
            $html="<a href='$url' class='bty-btn-acction bt-edit'></a>";
            $html.="<a href='$deactivate' class='btn btn-info'>Archive</a>";
            return $html;
        }, 2)->editColumn('author_id', function ($blog) {
            return BBGetUser($blog->author_id);
        })->editColumn('created_at', function ($status) {
            return BBgetDateFormat($status->created_at);
        })->rawColumns(['actions'])->make(true);
    }

    public function getBlogsArchive(BlogRepository $repository)
    {
        return DataTables::of($repository->model()->where('status', false))->addColumn('actions', function ($blog) {
            $deleteUrl = route("mbsp_blog_delete", $blog->id);
            $makeActive = route("mbsp_blog_make_active", $blog->id);
            $html ="<a href='$deleteUrl' class='bty-btn-acction bt-delete'></a>";
            $html.="<a href='$makeActive' class='btn btn-success'>Make Active</a>";
            return $html;
        }, 2)->editColumn('author_id', function ($blog) {
            return BBGetUser($blog->author_id);
        })->editColumn('created_at', function ($status) {
            return BBgetDateFormat($status->created_at);
        })->rawColumns(['actions'])->make(true);
    }
}
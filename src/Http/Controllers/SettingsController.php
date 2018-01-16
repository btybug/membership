<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 11.01.2018
 * Time: 21:55
 */

namespace BtyBugHook\Membership\Http\Controllers;


use App\Http\Controllers\Controller;
use Btybug\btybug\Repositories\AdminsettingRepository;
use BtyBugHook\Membership\Http\Requests\MembershipStatusCreateRequest;
use BtyBugHook\Membership\Repository\MembershipStatusesRepository;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function getSettings(AdminsettingRepository $adminsettingRepository)
    {
        $pricing_page=$adminsettingRepository->getSettings('membership','pricing_page');
        return view('mbshp::settings.index',compact('pricing_page'));
    }
    public function getMembershipTypes()
    {
        return view('mbshp::settings.mb_types');
    }

    public function getCreateStatus()
    {
        $model = null;
        return view('mbshp::settings.status_form',compact(['model']));
    }

    public function  postCreateStatus(
        MembershipStatusCreateRequest $request,
        MembershipStatusesRepository $repository
    )
    {
        $data = $request->except('_token');
        $data['slug'] = uniqid();
        $repository->create($data);

        return redirect()->route('mbsp_settings_mb_types');
    }

    public function getEditStatus(MembershipStatusesRepository $repo, $id)
    {
        $model = $repo->find($id);
        if (!$model) {
            abort(404);
        }
        return view('mbshp::settings.status_form', compact("model"));
    }

    public function  postEditStatus(
        Request $request,
        MembershipStatusesRepository $repo,
        $id
    )
    {
        $model = $repo->find($id);
        if (!$model) {
            abort(404);
        }

        $model->update($request->except('_token'));

        return redirect()->route('mbsp_settings_mb_types');
    }

    public function getDeleteStatus (
        MembershipStatusesRepository $repo,
        $id
    )
    {
        $status = $repo->find($id);
        if (!$status) {
            abort(404);
        }

        $status->delete();

        return redirect()->back()->with('message','Status Deleted');
    }

    public function postSavePricingPage(Request $request,AdminsettingRepository $adminsettingRepository)
    {
        $adminsettingRepository->createOrUpdateOriginalToJson($request->except('_token'),'membership','pricing_page');
        return redirect()->back();
    }

    public function getMembershipOptions()
    {
        return view('mbshp::settings.options');
    }
}
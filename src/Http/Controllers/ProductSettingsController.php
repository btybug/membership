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

class ProductSettingsController extends Controller
{
    public function getIndex (AdminsettingRepository $adminsettingRepository)
    {

        return view('mbshp::product_settings.index', compact('pricing_page'));
    }

}
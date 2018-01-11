<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 11.01.2018
 * Time: 21:55
 */

namespace BtyBugHook\Membership\Http\Controllers;


use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function getSettings()
    {
        return view('mbshp::settings.index');
    }
    public function getMembershipTypes()
    {
        return view('mbshp::settings.mb_types');
    }
}
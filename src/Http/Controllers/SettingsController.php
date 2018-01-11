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
        return view('forms::settings.index');
    }
    public function getMembershipTypes()
    {
        return view('forms::settings.mb_types');
    }
}
<?php

namespace BtyBugHook\Membership\Http\Controllers;

use App\Http\Controllers\Controller;

class IndexConroller extends Controller
{

    public function getPlans()
    {
        return view('forms::plans.index');
    }
    public function getPayments()
    {
        return view('forms::payments.index');
    }
    public function getSettings()
    {
        return view('forms::settings.index');
    }
}
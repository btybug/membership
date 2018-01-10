<?php

namespace BtyBugHook\Membership\Http\Controllers;

use App\Http\Controllers\Controller;

class IndexConroller extends Controller
{
    public function getIndex()
    {
        return view('forms::index');
    }
    public function getPlans()
    {
        return view('forms::plans.index');
    }
    public function getPayments()
    {
        return view('forms::payments.index');
    }
}
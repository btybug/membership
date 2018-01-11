<?php

namespace BtyBugHook\Membership\Http\Controllers;

use App\Http\Controllers\Controller;

class IndexConroller extends Controller
{

    public function getPlans()
    {
        return view('mbshp::plans.index');
    }
    public function getPayments()
    {
        return view('mbshp::payments.index');
    }

}
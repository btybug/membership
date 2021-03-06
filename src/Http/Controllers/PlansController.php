<?php

namespace BtyBugHook\Membership\Http\Controllers;

use App\Http\Controllers\Controller;
use BtyBugHook\Membership\Repository\PlansRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Stripe\Stripe;

class PlansController extends Controller
{

    public function createPlans ()
    {
        return view('mbshp::plans.create');
    }

    public function editPlans (PlansRepository $repo, $id)
    {
        $plan = $repo->find($id);
        if (! $plan) {
            abort(404);
        }

        return view('mbshp::plans.edit', compact("plan", 'id'));
    }

    public function editPlansPrice (PlansRepository $repo, $id)
    {
        $plan = $repo->find($id);
        if (! $plan) {
            abort(404);
        }

        return view('mbshp::plans.edit_price', compact("plan", 'id'));
    }

    public function saveCreatePlan (PlansRepository $repo, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'plan_id'        => 'required|unique:plans',
            'amount'         => 'required|integer',
            'currency'       => 'required|alpha',
            'interval'       => 'required',
            'interval_count' => 'required|integer',
            'name'           => 'required',
            'is_active'      => 'required',
        ]);

        if ($validator->fails()) {
            dd($validator->messages());

            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = $request->except('_token');
//        Stripe::setApiKey(\Config::get('services.stripe.secret'));
//
//        $response = \Stripe\Plan::create(array(
//            "amount" => $data['amount'],
//            "interval" => $data['interval'],
//            "interval_count" => $data['interval_count'],
//            "name" => $data['name'],
//            "currency" => $data['currency'],
//            "id" => $data['plan_id']
//        ));
        $data['object'] = 'plan';
        $data['created'] = time();
        $data['metadata'] = 'object';
        $result = $repo->model()->create($data);

        return redirect()->route('mbsp_plans');

    }

    public function saveEditPlan (PlansRepository $repo, Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'plan_id'        => 'required|unique:plans',
            'amount'         => 'required|integer',
            'currency'       => 'required|alpha',
            'interval'       => 'required',
            'interval_count' => 'required|integer',
            'name'           => 'required',
            'is_active'      => 'required',
        ]);

        if ($validator->fails()) {
            dd($validator->messages());

            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->except('_token', 'price', 'period', 'period_type');

        $repo->update($id, $data);

        return redirect()->route("mbsp_plans");
    }

}
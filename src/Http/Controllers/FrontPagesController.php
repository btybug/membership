<?php
/**
 * Created by PhpStorm.
 * User: sahak
 * Date: 12.01.2018
 * Time: 21:56
 */

namespace BtyBugHook\Membership\Http\Controllers;


use App\Http\Controllers\Controller;
use Btybug\btybug\Repositories\AdminsettingRepository;
use BtyBugHook\Membership\Repository\PlansRepository;

class FrontPagesController extends Controller
{
    public function grtProducts(AdminsettingRepository $adminsettingRepository)
    {
        $pricing_page = $adminsettingRepository->getSettings('membership', 'pricing_page');
        $unit = null;
        if ($pricing_page) {
            $json = json_decode($pricing_page->val, true);
            $unit = $json['pricing'];
        }
        return view('mbshp::frontend.products', compact('unit'));
    }

    public function getProduct(AdminsettingRepository $adminsettingRepository, PlansRepository $plansRepository, $id)
    {
        $product = $plansRepository->find($id);
        $pricing_page = $adminsettingRepository->getSettings('membership', 'pricing_page');
        $unit = null;
        if ($pricing_page) {
            $json = json_decode($pricing_page->val, true);
            $unit = $json['product'] ?? null;
        }
        return view('mbshp::frontend.product', compact('unit', 'product'));
    }
}
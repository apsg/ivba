<?php
namespace App\Domains\Payments\Controllers;

use App\Domains\Payments\Requests\QuickFullAccessRequest;
use App\Helpers\PayuPayment;
use App\Http\Controllers\Controller;
use App\Order;

class QuickFullAccessOrderController extends Controller
{
    public function order(QuickFullAccessRequest $request)
    {
        $user = $request->resolveUser();

        $order = $user->getCurrentOrder()
            ->clear()
            ->setFullAccess();

        if ($request->coupon() !== null && $request->coupon()->isValidForFullAccess()) {
            $order->coupons()->attach($request->coupon());
        }

        return [
            'payment_url' => (new PayuPayment())->getUrl($order),
        ];
    }
}

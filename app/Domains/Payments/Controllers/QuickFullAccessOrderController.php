<?php
namespace App\Domains\Payments\Controllers;

use App\Domains\Payments\Requests\QuickFullAccessRequest;
use App\Helpers\PayuPayment;
use App\Http\Controllers\Controller;

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

        if ($order->total() == 0) {
            $order->confirm();
            flash("Twoje zamówienie zostało potwierdzone! Zaloguj się na swoje konto by skorzystać z dostępu do strony. Instrukcję znajdziesz w swojej skrzynce mailowej.");

            return ['url' => url('/continue?order=' . $order->id)];
        }

        return [
            'url' => (new PayuPayment())->getUrl($order),
        ];
    }
}

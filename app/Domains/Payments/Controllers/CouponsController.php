<?php
namespace App\Domains\Payments\Controllers;

use App\Domains\Payments\Requests\RedeemCouponRequest;
use App\Http\Controllers\Controller;

class CouponsController extends Controller
{
    public function show()
    {
        return view();
    }

    public function use(RedeemCouponRequest $request)
    {
        if ($request->coupon() === null) {
            flash('Błędny kupon')->error();

            return back();
        }

        $request->coupon()->use();

        flash('Pomyślnie aktywowano dostęp');

        return redirect('/account');
    }
}
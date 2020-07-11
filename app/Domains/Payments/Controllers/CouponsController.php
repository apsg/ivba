<?php
namespace App\Domains\Payments\Controllers;

use App\Domains\Payments\Requests\RedeemCouponRequest;
use App\Http\Controllers\Controller;

class CouponsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }

    public function show()
    {
        return view('common.coupons.redeem');
    }

    public function use(RedeemCouponRequest $request)
    {
        if ($request->coupon() === null) {
            flash('Błędny kupon')->error();

            return back();
        }

        $request->coupon()->use();

        flash('Pomyślnie aktywowano dostęp. Sprawdź zakładkę "Moje kursu" oraz "Finanse".');

        return redirect('/account');
    }
}

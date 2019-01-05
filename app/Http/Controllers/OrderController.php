<?php
namespace App\Http\Controllers;

use App\Coupon;
use App\Helpers\Payment;
use App\Order;
use Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Pokaż koszyk
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function showCart(Request $request)
    {
        $order = Auth::user()->getCurrentOrder();

        return view('cart')->with(compact('order'));
    }

    /**
     * Wygeneruj płatność dla tego zamówienia.
     * @param  Order $order [description]
     * @return [type]        [description]
     */
    public function pay(Order $order)
    {
        if ($order->total() > 0) {
            $payment = new Payment();

            return redirect($payment->getUrl($order));
        } else {
            $order->final_total = 0;
            if ($order->confirm()) {
                return redirect('/continue');
            } else {
                return redirect('/cart');
            }
        }
    }

    /**
     * Dodaj pełen dostęp do aktualnego zamówienia
     */
    public function addFullAccess()
    {
        if (Auth::user()->canAddFullAccess()) {
            $order = Auth::user()->getCurrentOrder();
            $order->is_full_access = true;
            $order->duration = config('ivba.full_access_duration');
            $order->price = config('ivba.full_access_price');
            $order->description = config('ivba.full_access_description');
            $order->save();
        }

        return redirect('/cart');
    }

    /**
     * Usuń pełen dostęp z koszyka
     * @return [type] [description]
     */
    public function removeFullAccess()
    {
        $order = Auth::user()->getCurrentOrder();
        $order->is_full_access = false;
        $order->save();

        return redirect('/cart');
    }

    /**
     * Dodaj kupon do tego zamówienia
     * @param Order   $order [description]
     * @param Request $request [description]
     */
    public function addCoupon(Order $order, Request $request)
    {
        $code = $request->code;

        $coupon = \App\Coupon::where('code', $code)->first();

        if ($coupon) {
            if ($coupon->uses_left > 0) {
                $order->coupons()->save($coupon);
                flash('Kod rabatowy dodany');
            } else {
                flash('Wyczerpano już limit użyć tego kodu rabatowego');
            }
        } else {
            flash('Nie znaleziono kuponu rabatowego o takim kodzie.')->error();
        }

        return back();

    }

    /**
     * Usuń kod rabatowy z koszyka
     * @param  Order  $order [description]
     * @param  Coupon $coupon [description]
     * @return [type]         [description]
     */
    public function removeCoupon(Order $order, Coupon $coupon)
    {
        $order->coupons()->detach($coupon);

        return back();
    }

}

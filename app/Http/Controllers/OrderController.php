<?php
namespace App\Http\Controllers;

use App\Coupon;
use App\Helpers\GateHelper;
use App\InvoiceRequest;
use App\Order;
use App\Payments\Tpay\TpayMethodSelector;
use App\Payments\Tpay\TpayTransaction;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showCart(Request $request)
    {
        $order = Auth::user()->getCurrentOrder();

        $form = (new TpayMethodSelector())
            ->getBankForm(route('order.pay', compact('order')));

        return view('cart')->with(compact('order', 'form'));
    }

    public function pay(Order $order, Request $request)
    {
        if ($order->total() > 0) {
            $transaction = new TpayTransaction($order);

            return redirect($transaction->createTransaction((int)$request->input('group')));
        } else {
            $order->final_total = 0;
            if ($order->confirm()) {
                return redirect('/continue');
            } else {
                return redirect('/cart');
            }
        }
    }

    public function addFullAccess()
    {
        if (Auth::user()->canAddFullAccess()) {
            $order = Auth::user()->getCurrentOrder();
            $order->is_full_access = true;
            $order->duration = setting('ivba.full_access_duration');
            $order->price = setting('ivba.full_access_price');
            $order->description = setting('ivba.full_access_description');
            $order->save();
        }

        return redirect('/cart');
    }

    public function removeFullAccess()
    {
        $order = Auth::user()->getCurrentOrder();
        $order->is_full_access = false;
        $order->save();

        return redirect('/cart');
    }

    public function addCoupon(Order $order, Request $request)
    {
        $code = $request->code;

        $coupon = Coupon::where('code', $code)->first();

        if ($coupon === null) {
            flash('Nie znaleziono kuponu rabatowego o takim kodzie.')->error();

            return back();
        }

        if ($coupon->uses_left < 1) {
            flash('Wyczerpano już limit użyć tego kodu rabatowego');

            return back();
        }

        if ($order->coupons()->where('id', $coupon->id)->exists()) {
            flash('Ten kupon został już dodany do tego zamówienia. Nie możesz dodać dwa razy tego samego kuponu.');

            return back();
        }

        $order->coupons()->save($coupon);
        flash('Kod rabatowy dodany');

        return back();
    }

    /**
     * Usuń kod rabatowy z koszyka
     * @param Order  $order [description]
     * @param Coupon $coupon [description]
     * @return [type]         [description]
     */
    public function removeCoupon(Order $order, Coupon $coupon)
    {
        $order->coupons()->detach($coupon);

        return back();
    }

    public function removeEasyAccess(Order $order)
    {
        $order->clear();

        return back();
    }

    public function requestInvoice(Order $order)
    {
        if (Gate::denies(GateHelper::REQUEST_INVOICE)) {
            flash('Proszę uzupełnić dane do faktury');

            return redirect(url('/account'))
                ->withErrors(['Proszę uzupełnić dane do faktury']);
        }

        if ($order->invoice_request !== null) {
            flash('Już wygenerowano wcześniej prośbę o fakturę dla tego zamówienia.');

            return back()->withErrors(['Prośba już istnieje']);
        }

        InvoiceRequest::create([
            'invoicable_id'   => $order->id,
            'invoicable_type' => Order::class,
        ]);

        return back();
    }
}

<?php
namespace App\Http\Controllers;

use App\Payments\Tpay\CardPaymentGate;

class TpayController extends Controller
{

    public function showGate()
    {
        $gate = (new CardPaymentGate())->init();

        return view('tpay.gate')
            ->with(compact('gate'));
    }
}
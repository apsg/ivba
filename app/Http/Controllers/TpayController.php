<?php
namespace App\Http\Controllers;

use App\Payments\Tpay\CardNotification;
use App\Payments\Tpay\CardPaymentGate;
use Auth;
use Illuminate\Http\Request;
use Log;

class TpayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('notification');
    }

    public function showGate()
    {
        $gate = (new CardPaymentGate())->getRedirectTransaction(Auth::user());

        return redirect($gate);
    }

    public function debug(Request $request)
    {
        dd($request->all());
    }

    public function handleResponse(Request $request)
    {
        $handler = (new CardNotification())->handleNotification($request->input('type'));
    }

    public function notification(Request $request)
    {
        Log::info('tpay notification', $request->all());

        return response()->json(['ok'], 200);
    }
}
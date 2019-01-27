<?php
namespace App\Http\Controllers;

use App\Payments\Tpay\CardNotification;
use App\Payments\Tpay\OnSiteGate;
use App\Repositories\PaymentRepository;
use Illuminate\Http\Request;
use Log;

class TpayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('showGate');
    }

    public function showGate()
    {

        $gate = (new OnSiteGate())->init();

        return view('tpay.gate')->with(compact('gate'));
    }

    public function debug(Request $request)
    {
        return redirect('/buy_access');
    }

    public function success()
    {
        return redirect('/success');
    }

    public function error()
    {
        return redirect('/error');
    }

    public function handleResponse(Request $request)
    {
        $handler = (new CardNotification())->handleNotification($request->input('type'));
    }

    public function notification(Request $request, PaymentRepository $paymentRepository)
    {
        Log::info('tpay notification', $request->all());

        $paymentRepository->handle(
            $request->input('order_id'),
            $request->input('status'),
            $request->all()
        );

        $n = (new CardNotification())->notification();

        return response()->json([$n], 200);
    }
}
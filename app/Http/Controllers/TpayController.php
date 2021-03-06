<?php
namespace App\Http\Controllers;

use App\Payments\Requests\TpayIpnRequest;
use App\Payments\Tpay\CardNotification;
use App\Payments\Tpay\OnSiteGate;
use App\Payments\Tpay\TransactionNotification;
use App\Repositories\PaymentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use tpayLibs\src\_class_tpay\Utilities\TException;

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

    public function success(Request $request)
    {
        if ($request->input('return') !== null) {
            return redirect($request->input('return'));
        }

        return redirect('/success');
    }

    public function error()
    {
        return redirect('/blad-platnosci');
    }

    public function handleResponse(Request $request)
    {
        $handler = (new CardNotification())->handleNotification($request->input('type'));
    }

    public function notification(Request $request, PaymentRepository $paymentRepository)
    {
        try {
            Log::info('tpay notification', $request->all());

            $paymentRepository->handle(
                $request->input('order_id'),
                $request->input('status'),
                $request->all()
            );

            $n = (new CardNotification())->notification();

            return response()->json([$n], 200);
        } catch (TException $exception) {
            Log::error('Tpay exception', [
                'message' => $exception->getMessage(),
            ]);

            return response()->json([], 422);
        }
    }

    public function ipn(TpayIpnRequest $request)
    {
        Log::info('ipn', $request->all());

        if ($request->isSuccess()) {
            $order = $request->order();
            if ($order !== null) {
                $order->confirm($request->externalId());
            }
        }

        return (new TransactionNotification())
            ->disableValidationServerIP()
            ->checkPayment();
    }
}

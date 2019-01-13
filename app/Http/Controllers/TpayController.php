<?php
namespace App\Http\Controllers;

use App\Payments\Tpay\CardNotification;
use App\Payments\Tpay\OnSiteGate;
use Illuminate\Http\Request;
use Log;
use tpayLibs\src\Dictionaries\CardDictionary;

class TpayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('notification');
    }

    public function showGate()
    {

        $gate = (new OnSiteGate())->init();

        return view('tpay.gate')->with(compact('gate'));
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

        $n = (new CardNotification())
            ->handleNotification(CardDictionary::SALE);

        return response()->json([$n], 200);
    }
}
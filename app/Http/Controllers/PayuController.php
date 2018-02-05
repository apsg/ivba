<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PayuController extends Controller
{
    
    /**
     * Payu potwierdza opłacenie zamówienia
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function notify(Request $request){

    	if($request->order['status'] == 'COMPLETED'){

			$order = \App\Order::where('payu_order_id', '=', $request->order['extOrderId'])
				->firstOrFail();

			$order->confirm();

		}
    }

    /**
     * [process description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function process(Request $request){

        $payment = new \App\Helpers\Payment;

        try{

            $order = \App\Order::create([
                'user_id'   => \Auth::user()->id,
                'price'     => $request->amount,
                'description' => config('ivba.subscription_description'),
                'duration'  => 31,
            ]);

            $result = $payment->first($order, $request->input('value') );


        } catch(\Exception $ex){
            return $ex->getMessage();
        }

        \Auth::user()->update([
            'card_token'    => $result->payMethods->payMethod->value,
        ]);

        if( $result->status->statusCode == "WARNING_CONTINUE_3DS" 
            || $result->status->statusCode == "WARNING_CONTINUE_CVV" 
        ){
            return redirect($result->redirectUri);
        }

        if($result->status->statusCode == "SUCCESS"){
            return redirect('/subscription_success');
        }

        // Nie powinniśmy tutaj trafić
        dd($result);

    }

    /**
     * Potwierdzenie od payu.
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function notifyRecurring(Request $request){
        \Log::info($request->all());

        
    }

}

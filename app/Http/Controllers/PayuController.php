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
     * Przetwarza płatność
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function process(Request $request){

        $payment = new \App\Helpers\Payment;

        try{

            $order = \App\Order::create([
                'user_id'   => \Auth::user()->id,
                'price'     => $request->amount,
                'description' => config('ivba.subscription_description_first'),
                'duration'  => config('ivba.subscription_duration_first'),
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
            $order->confirm();
            return redirect('/subscription_success');
        }

        // Nie powinniśmy tutaj trafić
        dd($result);

    }

    /**
     * Kontynuuj..
     * @param  Order   $order   [description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function continueOrder(\App\Order $order, Request $request){

        if(isset($request->statusCode)){
            if($request->statusCode == "SUCCESS"){
                $order->confirm();
                return redirect('/subscription_success');
                // return redirect('/continue?order='.$order->id);
            }
        }

        dd($request->all());
    }

    /**
     * Kontynuacja po potwierdzeniu 3DS/CVV
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function continueRecurring(Request $request){
        if(isset($request->statusCode)){
            if($request->statusCode == "SUCCESS"){
                $order = \App\Order::where('payu_refid', $request->refReqId)->first();
                $order->confirm();
                return redirect('/continue?order='.$order->id);
            }
        }

        dd($request->all());
    }

    /**
     * Pokaż widok końcowy procesu subskrypcji
     * @return [type] [description]
     */
    public function subscriptionSuccess(){
        $page = \App\Page::where('slug', 'subscription_success')->first();
        return view('subscription_success')->with(compact('page'));
    }

    /**
     * Potwierdzenie od payu.
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function notifyRecurring(Request $request){
        

        // if($request->order['status'] == 'COMPLETED'){

        //     $order = \App\Order::where('payu_order_id', '=', $request->order['extOrderId'])
        //         ->firstOrFail();

        //     $subscription = \App\Subscription::where('user_id', $order->user_id)
        //         ->whereNull('cancelled_at')
        //         ->first();

        //     $order->confirm();

        // }

        \Log::info($request->all());
    }

}

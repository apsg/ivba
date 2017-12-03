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

}

<?php
namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class PayuController extends Controller
{
    public function notify(Request $request)
    {
        if ($request->order['status'] == 'COMPLETED') {

            /** @var Order $order */
            $order = Order::where('payu_order_id', '=', $request->order['extOrderId'])
                ->firstOrFail();

            $order->confirm($request->order['extOrderId']);
        }

        return response()->json([], 200);
    }
}

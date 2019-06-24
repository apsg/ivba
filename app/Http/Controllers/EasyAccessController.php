<?php
namespace App\Http\Controllers;

use App\Http\Requests\EasyAccessAddRequest;
use App\Order;
use Auth;

class EasyAccessController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showForm()
    {
        $price1 = config('ivba.subscription_price');
        $price3 = 3 * $price1;
        $price6 = 6 * $price1;

        return view('easy_access')->with(compact('price1', 'price3', 'price6'));
    }

    public function add($duration, EasyAccessAddRequest $request)
    {
        /** @var Order $order */
        $order = Auth::user()->getCurrentOrder();

        $order->setEasyAccess($duration);

        return redirect('/cart');
    }
}

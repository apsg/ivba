<?php
namespace App\Http\Controllers;

use App\Order;
use DataTables;
use Illuminate\Http\Request;

class AdminOrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Pokaż spis zamówień
     * @return [type] [description]
     */
    public function index()
    {
        return view('admin.orders');
    }

    /**
     * Zwraca dane dla datatables
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getData(Request $request)
    {
        $orders = Order::confirmed()
            ->with(['user']);

        return DataTables::of($orders)
            ->addColumn('total', function ($item) {
                return $item->total();
            })
            ->addColumn('items2', function ($item) {
                if ($item->is_full_access) {
                    return "Pałen dostęp";
                } else {
                    return '';
                }
            })
            ->addColumn('coupons', function ($item) {
                $coupons = [];
                foreach ($item->coupons as $coupon) {
                    $coupons[] = $coupon->code . ' (' . $coupon->valueFormatted() . ')';
                }

                return implode(',', $coupons);
            })
            ->make(true);
    }
}

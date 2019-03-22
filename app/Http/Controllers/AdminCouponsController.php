<?php

namespace App\Http\Controllers;

use App\Coupon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminCouponsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Pokaż listę kuponów
     */
    public function index()
    {
        $coupons = Coupon::all();
        return view('admin.coupons')->with(compact('coupons'));
    }

    /**
     * Usuń kupon
     */
    public function delete(Coupon $coupon)
    {
        if (Gate::allows('admin')) {
            $coupon->delete();
        }
        return back();
    }

    /**
     * Widok tworzenia nowego kodu rabatowego
     */
    public function create()
    {
        return view('admin.coupons.new');
    }

    /**
     * Widok edycji kuponu
     */
    public function show(Coupon $coupon)
    {
        return view('admin.coupons.coupon')->with(compact('coupon'));
    }

    /**
     * Widok edycji kuponu
     */
    public function edit(Coupon $coupon)
    {
        return view('admin.coupons.coupon')->with(compact('coupon'));
    }

    /**
     * Zapisz nowy kupon
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'code'      => 'required|unique:coupons,code',
            'amount'    => 'required|numeric|min:0',
            'uses_left' => 'required|numeric|min:0',
            'type'      => 'required|in:1,2,3,4',
        ]);

        $coupon = Coupon::create($request->all());

        return redirect('/admin/coupon/' . $coupon->id);
    }

    /**
     * Zaktualizuj istniejący kupon
     */
    public function update(Coupon $coupon, Request $request)
    {

        $this->validate($request, [
            'code'      => [
                'required',
                Rule::unique('coupons', 'code')->ignore($coupon->id),
            ],
            'amount'    => 'required|numeric|min:0',
            'uses_left' => 'required|numeric|min:0',
            'type'      => 'required|in:1,2,3,4',
        ]);

        $coupon->update($request->all());

        return back();
    }
}

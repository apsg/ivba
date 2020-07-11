<?php

namespace App\Http\Controllers;

use App\MenuItem;
use Illuminate\Http\Request;

class AdminMenusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Pokaż listę elementów menu.
     * @return [type] [description]
     */
    public function index()
    {
        $items = MenuItem::orderBy(\DB::raw('menu_id, position'))->get()->groupBy('menu_id');

        return view('admin.menus')->with(compact('items'));
    }

    /**
     * Zapisuje nowy element w bazie danych.
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'url'	=> 'required',
        ]);

        MenuItem::create($request->all());

        return back();
    }

    /**
     * Usuwa element.
     * @param  MenuItem $item [description]
     * @return [type]         [description]
     */
    public function delete(MenuItem $item)
    {
        if (\Gate::allows('admin')) {
            $item->delete();
        }

        return back();
    }

    /**
     * [updateOrder description].
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function updateOrder(Request $request)
    {
        foreach ($request->order as $item_order) {
            \DB::table('menu_items')
                ->where('id', $item_order['id'])
                ->update(['position' => $item_order['order']]);
        }

        return ['ok'];
    }
}

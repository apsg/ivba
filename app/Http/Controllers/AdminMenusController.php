<?php
namespace App\Http\Controllers;

use App\Domains\Admin\MenuRepository;
use App\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminMenusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $items = MenuItem::topLevel()
            ->orderBy(\DB::raw('menu_id, position'))
            ->get()
            ->groupBy('menu_id');

        return view('admin.menus')->with(compact('items'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'url'   => 'required',
        ]);

        MenuItem::create($request->all());

        return back();
    }

    public function delete(MenuItem $item)
    {
        if (\Gate::allows('admin')) {
            $item->delete();
        }

        return back();
    }

    public function updateOrder(Request $request, MenuRepository $repository)
    {
        foreach ($request->order as $item_order) {
            $repository->update($item_order['id'], $item_order['order']);

            if (!isset($item_order['children'])) {
                continue;
            }

            foreach ($item_order['children'] as $child) {
                $repository->update(
                    $child['id'],
                    $child['order'],
                    $item_order['id']
                );
            }
        }

        return ['ok'];
    }
}

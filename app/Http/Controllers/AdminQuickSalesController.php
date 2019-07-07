<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Requests\Admin\QuickSaleRequest;
use App\QuickSale;

class AdminQuickSalesController extends Controller
{
    public function index()
    {
        $quickSales = QuickSale::all();

        return view('admin.quicksales.index')->with(compact('quickSales'));
    }

    public function create()
    {
        $courses = Course::orderBy('title')
            ->select(['id', 'title'])
            ->get();

        return view('admin.quicksales.create')->with(compact('courses'));
    }

    public function store(QuickSaleRequest $request)
    {
        QuickSale::create($request->except(['_token']));

        return redirect('/admin/quicksales');
    }

    public function destroy(QuickSale $quickSale)
    {
        $quickSale->delete();

        return back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Requests\Admin\QuickSaleRequest;
use App\QuickSale;
use Laracsv\Export;

class AdminQuickSalesController extends Controller
{
    public function index()
    {
        $quickSales = QuickSale::with('course')->get();

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
        flash('Zapisano');

        return redirect('/admin/quicksales');
    }

    public function update(QuickSale $quickSale, QuickSaleRequest $request)
    {
        $quickSale->update($request->except(['_token']));

        flash('Zaktualizowano pomyślnie');

        return back();
    }

    public function destroy(QuickSale $quickSale)
    {
        $quickSale->delete();

        flash('Usunięto');

        return back();
    }

    public function show(QuickSale $quickSale)
    {
        $courses = Course::orderBy('title')
            ->select(['id', 'title'])
            ->get();

        return view('admin.quicksales.show')->with(compact('quickSale', 'courses'));
    }

    public function downloadReport(QuickSale $quickSale)
    {
        $data = $quickSale->confirmed_orders()
            ->get();
//            ->only(['id', 'confirmed_at', 'user.email', 'user.name']);

        $csvExporter = new Export();
        $csvExporter->build($data, ['id', 'confirmed_at', 'user_id', 'user.email', 'user.name', 'user.phone']);

        $csvExporter->download();

        exit();
    }
}

<?php

namespace App\Http\Controllers;

use App\Course;
use App\Domains\Quicksales\Integrations\GetResponseService;
use App\Http\Requests\Admin\QuickSaleRequest;
use App\QuickSale;
use Apsg\Baselinker\Facades\Baselinker;
use Laracsv\Export;

class AdminQuickSalesController extends Controller
{
    public function index()
    {
        $quickSales = QuickSale::with('course')->get();

        return view('admin.quicksales.index')->with(compact('quickSales'));
    }

    public function create(GetResponseService $service)
    {
        $courses = Course::orderBy('title')
            ->select(['id', 'title'])
            ->get();

        $getresponseCampaigns = $service->getCampaigns();

        return view('admin.quicksales.create')->with(compact('courses', 'getresponseCampaigns'));
    }

    public function store(QuickSaleRequest $request)
    {
        QuickSale::create($request->except(['_token']));
        flash('Zapisano');

        return redirect('/admin/quicksales');
    }

    public function update(QuickSale $quickSale, QuickSaleRequest $request)
    {
        $quickSale->update($request->getData());

        flash('Zaktualizowano pomyślnie');

        return back();
    }

    public function destroy(QuickSale $quickSale)
    {
        $quickSale->delete();

        flash('Usunięto');

        return back();
    }

    public function show(QuickSale $quickSale, GetResponseService $service)
    {
        $courses = Course::orderBy('title')
            ->select(['id', 'title'])
            ->get();

        $getresponseCampaigns = $service->getCampaigns();

        return view('admin.quicksales.show')
            ->with(compact('quickSale', 'courses', 'getresponseCampaigns'));
    }

    public function downloadReport(QuickSale $quickSale)
    {
        $data = $quickSale->confirmed_orders()
            ->get();

        $csvExporter = new Export();
        $csvExporter->build($data, [
            'id',
            'confirmed_at',
            'user_id',
            'user.email',
            'user.name',
            'user.phone',
            'user.street',
            'user.city',
            'user.postcode',
        ]);

        $csvExporter->download();

        exit();
    }

    public function createBaselinkerProduct(QuickSale $quickSale)
    {
        $categoryId = Baselinker::categories()->getOrCreate(config('app.name'));

        $productId = Baselinker::products()->addProduct([
            'name'         => $quickSale->name,
            'price_brutto' => $quickSale->price,
            'description'  => $quickSale->description,
            'category_id'  => $categoryId,
        ]);

        return [
            'product_id' => $productId,
        ];
    }
}

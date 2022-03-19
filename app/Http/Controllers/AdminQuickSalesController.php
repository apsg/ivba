<?php
namespace App\Http\Controllers;

use App\Course;
use App\Domains\Quicksales\Integrations\GetResponseService;
use App\Domains\Quicksales\Integrations\MailerliteService;
use App\Http\Requests\Admin\QuickSaleRequest;
use App\QuickSale;
use App\Repositories\QuickSaleRepository;
use Apsg\Baselinker\Facades\Baselinker;
use Laracsv\Export;

class AdminQuickSalesController extends Controller
{
    public function index()
    {
        $quickSales = QuickSale::with('course')->get();

        return view('admin.quicksales.index')->with(compact('quickSales'));
    }

    public function create(MailerliteService $mailerliteService)
    {
        $courses = Course::orderBy('title')
            ->select(['id', 'title'])
            ->get();

        $mailerliteGroups = $mailerliteService->getGroups();

        return view('admin.quicksales.create')
            ->with(compact('courses', 'mailerliteGroups'));
    }

    public function store(QuickSaleRequest $request, QuickSaleRepository $repository)
    {
        /** @var QuickSale $quickSale */
        $quickSale = QuickSale::create($request->except(['_token', 'course_id']));
        $repository->syncCourses($quickSale, $request->input('course_id'));
        $repository->syncCoupons($quickSale, $request->input('coupon_id', []));

        flash('Zapisano');

        return redirect('/admin/quicksales');
    }

    public function update(QuickSale $quickSale, QuickSaleRequest $request, QuickSaleRepository $repository)
    {
        $quickSale->update($request->getData());
        $repository->syncCourses($quickSale, $request->input('course_id'));
        $repository->syncCoupons($quickSale, $request->input('coupon_id', []));

        flash('Zaktualizowano pomyślnie');

        return back();
    }

    public function destroy(QuickSale $quickSale)
    {
        $quickSale->delete();

        flash('Usunięto');

        return back();
    }

    public function show(QuickSale $quickSale, MailerliteService $mailerliteService)
    {
        $courses = Course::orderBy('title')
            ->select(['id', 'title'])
            ->get();

        $mailerliteGroups = $mailerliteService->getGroups();

        return view('admin.quicksales.show')
            ->with(compact('quickSale', 'courses', 'mailerliteGroups'));
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

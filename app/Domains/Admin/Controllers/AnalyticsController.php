<?php
namespace App\Domains\Admin\Controllers;

use App\Domains\Admin\Requests\AnalyticsDataRequest;
use App\Domains\Admin\Services\AnalyticsService;
use App\Http\Controllers\Controller;

class AnalyticsController extends Controller
{
    public function index(AnalyticsDataRequest $request)
    {
        $service = new AnalyticsService($request->start(), $request->end());

        return view('admin.analytics.index')
            ->with([
                'count' => $service->count(),
                'total' => $service->total(),
                'table' => $service->table(),
                'start' => $request->start(),
                'end'   => $request->end(),
            ]);
    }

    public function data(AnalyticsDataRequest $request)
    {
        $service = new AnalyticsService($request->start(), $request->end());

        return [
            'count' => $service->count(),
            'total' => $service->total(),
            'table' => $service->table(),
        ];
    }
}

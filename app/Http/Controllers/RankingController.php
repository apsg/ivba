<?php

namespace App\Http\Controllers;

use App\Services\RankingService;

class RankingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['my']);
    }

    public function index()
    {
        return view('ranking');
    }

    public function my(RankingService $service)
    {
        $user = \Auth::user();

        return response()->json([
            'position_month' => $service->getUserMonthlyPosiotion($user),
            'users_month'    => $service->getTotalUsersThisMonth(),
            'position_total' => $service->getUserPosition($user),
            'users_total'    => $service->getTotalUsers(),
            'points_month'   => $service->getUserPointsThisMonth($user),
            'points_total'   => $service->getUserPoints($user),
        ]);
    }
}

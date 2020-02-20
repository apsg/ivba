<?php

namespace App\Http\Controllers;

use App\Services\RankingService;
use App\Transformers\RankingTransformer;
use Auth;

class RankingController extends Controller
{
    /** @var RankingService */
    protected $service;

    public function __construct(RankingService $service)
    {
        $this->middleware('auth')->only(['my']);
        $this->service = $service;
    }

    public function index()
    {
        return view('ranking');
    }

    public function my()
    {
        $user = Auth::user();

        return response()->json([
            'position_month' => $this->service->getUserMonthlyPosiotion($user),
            'users_month'    => $this->service->getTotalUsersThisMonth(),
            'position_total' => $this->service->getUserPosition($user),
            'users_total'    => $this->service->getTotalUsers(),
            'points_month'   => $this->service->getUserPointsThisMonth($user),
            'points_total'   => $this->service->getUserPoints($user),
        ]);
    }

    public function month()
    {
        $data = $this->service->getThisMonthRanking();

        return fractal($data)
            ->transformWith(new RankingTransformer(Auth::user()))
            ->respond(200);
    }

    public function total()
    {
        $data = $this->service->getRanking();

        return fractal($data)
            ->transformWith(new RankingTransformer(Auth::user()))
            ->respond(200);
    }
}

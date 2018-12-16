<?php

namespace App\Http\Controllers;

use App\User;
use Cache;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $startDate = $request->input('startDate',
            Carbon::now()->startOfMonth()->format('Y-m-d')
        );

        $endDate = $request->input('endDate',
            Carbon::now()->endOfMonth()->format('Y-m-d')
        );

        $lastUsers = Cache::remember('last_users', 10, function () {
            return User::latest()->take(10)->get();
        });

        return view('home')->with(compact('startDate', 'endDate', 'lastUsers'));
    }

    public function admin()
    {
        return redirect('/admin');
    }
}

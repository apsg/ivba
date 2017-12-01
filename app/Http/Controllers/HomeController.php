<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $startDate = $request->input('startDate', 
            \Carbon\Carbon::now()->startOfMonth()->format('Y-m-d')
            );

        $endDate = $request->input('endDate', 
            \Carbon\Carbon::now()->endOfMonth()->format('Y-m-d')
            );
        
        $lastUsers = \Cache::remember('last_users', 10, function(){
                return \App\User::latest()->take(10)->get();
            });

        return view('home')->with(compact('startDate', 'endDate', 'lastUsers'));
    }
}

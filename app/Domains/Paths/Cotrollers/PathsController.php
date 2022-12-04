<?php
namespace App\Domains\Paths\Cotrollers;

use App\Http\Controllers\Controller;

class PathsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('paths.index');
    }
}

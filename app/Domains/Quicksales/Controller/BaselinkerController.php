<?php
namespace App\Domains\Quicksales\Controller;

use App\Domains\Quicksales\Transformers\BaselinkerProductsTranformer;
use App\Http\Controllers\Controller;
use Apsg\Baselinker\Facades\Baselinker;

class BaselinkerController extends Controller
{
    public function index()
    {
        $products = Baselinker::products()->getProductsList();

        return fractal($products, new BaselinkerProductsTranformer());
    }
}
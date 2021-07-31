<?php
namespace App\Domains\Quicksales\Requests;

use App\QuickSale;
use App\Repositories\QuickSaleRepository;
use Illuminate\Foundation\Http\FormRequest;

class BaseQuickSaleRequest extends FormRequest
{
    public function sale() : QuickSale
    {
        return app(QuickSaleRepository::class)->findByHash($this->route('hash'));
    }
}

<?php
namespace App\Domains\Quicksales\Requests;

use App\Http\Requests\HasCouponTrait;

class QuickSaleCouponRequest extends BaseQuickSaleRequest
{
    use HasCouponTrait;

    public function rules()
    {
        return [
            'code' => 'string|nullable',
        ];
    }
}

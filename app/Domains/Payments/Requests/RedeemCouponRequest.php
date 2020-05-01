<?php
namespace App\Domains\Payments\Requests;

use App\Coupon;
use Illuminate\Foundation\Http\FormRequest;

class RedeemCouponRequest extends FormRequest
{
    public function rules()
    {
        return [
            'code' => 'required|string',
        ];
    }

    /** @noinspection PhpIncompatibleReturnTypeInspection */
    public function coupon() : ?Coupon
    {
        return Coupon::where('code', $this->input('code'))
            ->first();
    }
}
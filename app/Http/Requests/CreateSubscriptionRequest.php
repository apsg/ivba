<?php
namespace App\Http\Requests;

use App\Coupon;
use Illuminate\Foundation\Http\FormRequest;

class CreateSubscriptionRequest extends FormRequest
{
    public function rules()
    {
        return [
//            'code' => 'sometimes|string',
        ];
    }

    /**
     * @return Coupon|null
     */
    public function coupon()
    {
        return Coupon::where('code', $this->input('code'))->first();
    }

}
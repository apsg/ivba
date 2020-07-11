<?php
namespace App\Http\Requests\Axios;

use App\Coupon;
use Illuminate\Foundation\Http\FormRequest;

class CheckCouponRequest extends FormRequest
{
    public function rules()
    {
        return [
            'code' => 'required',
        ];
    }

    /**
     * @return Coupon|null
     */
    public function coupon()
    {
        return Coupon::where('code', $this->input('code'))
            ->first();
    }
}

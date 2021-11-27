<?php
namespace App\Http\Requests\Axios;

use App\Coupon;
use Illuminate\Foundation\Http\FormRequest;

class CheckCouponRequest extends FormRequest
{
    /** @var Coupon|null */
    protected $couponModel;

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
        if ($this->couponModel === null) {
            $this->couponModel = Coupon::where('code', $this->input('code'))
                ->first();
        }

        return $this->couponModel;
    }
}

<?php
namespace App\Http\Requests\Admin;

use App\Coupon;
use Illuminate\Foundation\Http\FormRequest;
use InvalidArgumentException;

class GrouponRequest extends FormRequest
{
    public function rules()
    {
        return [
            'type'      => 'required|integer|in:0,1',
            'count'     => 'required|integer|min:1|max:1000',
            'courses'   => 'required_if:type,1|array',
            'courses.*' => 'required_if:type,1|integer|exists:courses,id',
        ];
    }

    public function couponType() : int
    {
        if ($this->input('type') == 0) {
            return Coupon::TYPE_SUBSCRIPTION_PERCENT;
        }

        if ($this->input('type') == 1) {
            return Coupon::TYPE_COURSE_ACCESS;
        }

        throw new InvalidArgumentException('Wrong coupon type selected');
    }
}
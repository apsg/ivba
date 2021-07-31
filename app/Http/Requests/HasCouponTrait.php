<?php
namespace App\Http\Requests;

use App\Coupon;
use App\Domains\Payments\Repositories\CouponRepository;

trait HasCouponTrait
{
    public function couponByCode() : ?Coupon
    {
        if (empty($this->input('code'))) {
            return null;
        }

        return app(CouponRepository::class)
            ->findByCode($this->input('code'), true);
    }

    public function couponById() : ?Coupon
    {
        if (empty($this->input('coupon'))) {
            return null;
        }

        return Coupon::usable()->find($this->input('coupon'));
    }
}

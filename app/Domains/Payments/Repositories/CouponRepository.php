<?php
namespace App\Domains\Payments\Repositories;

use App\Coupon;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class CouponRepository
{
    const ALLOWED_TYPES = [
        Coupon::TYPE_VALUE,
        Coupon::TYPE_PERCENT,
        Coupon::TYPE_SUBSCRIPTION_VALUE,
        Coupon::TYPE_SUBSCRIPTION_PERCENT,
        Coupon::TYPE_COURSE_ACCESS,
    ];

    public function generate(
        int $type,
        int $count = 1,
        float $amount = 100,
        int $uses = 1,
        array $courses = []
    ) : Collection {
        if (!in_array($type, static::ALLOWED_TYPES)) {
            throw new \InvalidArgumentException('Wrong type');
        }

        if ($type === Coupon::TYPE_COURSE_ACCESS && empty($courses)) {
            throw new \InvalidArgumentException('You must specify at least one course for this type of coupon');
        }

        $coupons = collect([]);

        for ($i = 0; $i < $count; $i++) {
            $coupon = Coupon::create([
                'code'      => strtolower(Str::random(8)),
                'type'      => $type,
                'amount'    => $amount,
                'uses_left' => $uses,
            ]);

            $coupon->courses()->attach($courses);

            $coupons->push($coupon);
        }

        return $coupons;
    }

    public function findByCode(string $code, bool $isSearchOnlyUsable = false) : ?Coupon
    {
        $query = Coupon::where('code', '=', $code);

        if ($isSearchOnlyUsable) {
            $query = $query->usable();
        }

        return $query->first();
    }
}
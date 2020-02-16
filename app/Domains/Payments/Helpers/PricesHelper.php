<?php

namespace App\Domains\Payments\Helpers;

use App\Domains\Admin\Models\Setting;

/**
 * Class PricesHelper
 * @package App\Domains\Payments\Helpers\PricesHelper
 */
class PricesHelper
{
    public static function subscription()
    {
        return Setting::get('ivba.subscription_price');
    }

    public static function subscriptionFirst()
    {
        return Setting::get('ivba.subscription_price_first');
    }

    public static function fullAccess()
    {
        return Setting::get('ivba.full_access_price');
    }
}

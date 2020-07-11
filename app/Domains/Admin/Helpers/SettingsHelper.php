<?php
namespace App\Domains\Admin\Helpers;

use App\Domains\Admin\Models\Setting;

class SettingsHelper
{
    const LIST = [
        'ivba.full_access_price'           => 'Cena za pełen dostęp',
        'ivba.subscription_price_first'    => 'Cena pierwszej płatności w abonamencie',
        'ivba.subscription_duration_first' => 'Długość okresu za pierwszą wpłatę w abonamencie (dni) ',
        'ivba.subscription_price'          => 'Cena miesięczna za abonament',
        'ivba.getresponse.list_all'        => 'Lista Getresponse-wszyscy',
        'ivba.getresponse.list_active'     => 'Lista Getresponse-aktywni',
    ];

    public static function get(string $key)
    {
        return Setting::get($key);
    }
}

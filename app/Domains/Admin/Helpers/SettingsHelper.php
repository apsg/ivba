<?php
namespace App\Domains\Admin\Helpers;

use App\Domains\Admin\Models\Setting;

class SettingsHelper
{
    const PATH_SIMPLE = 'is.path_simple';
    const PATH_MEDIUM = 'is.path_medium';
    const PATH_HARD = 'is.path_hard';

    const LIST = [
        'ivba.full_access_price'           => 'Cena za pełen dostęp',
        'ivba.subscription_price_first'    => 'Cena pierwszej płatności w abonamencie',
        'ivba.subscription_duration_first' => 'Długość okresu za pierwszą wpłatę w abonamencie (dni) ',
        'ivba.subscription_price'          => 'Cena miesięczna za abonament',
        'ivba.getresponse.list_all'        => 'Lista Getresponse-wszyscy',
        'ivba.getresponse.list_active'     => 'Lista Getresponse-aktywni',
        'is.rules_link'                    => 'Link do regulaminu (IS)',
        'is.disable_buy'                   => 'Wyłącz możliwość kupna dostępu',
        self::PATH_SIMPLE                  => 'Slug kursu dla ścieżki początkującej',
        self::PATH_MEDIUM                  => 'Slug kursu dla ścieżki średniej',
        self::PATH_HARD                    => 'Slug kursu dla ścieżki eksperckiej',
    ];

    const BOOL = [
        'is.disable_buy',
    ];

    public static function get(string $key)
    {
        return Setting::get($key);
    }

    public static function isBool(string $key): bool
    {
        return in_array($key, self::BOOL);
    }
}

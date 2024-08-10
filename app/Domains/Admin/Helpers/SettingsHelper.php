<?php
namespace App\Domains\Admin\Helpers;

use App\Domains\Admin\Models\Setting;
use App\Domains\Admin\Services\MailerliteDataSource;
use App\Domains\Admin\Services\SettingsSelectDataSource;

class SettingsHelper
{
    const PATH_SIMPLE = 'is.path_simple';
    const PATH_MEDIUM = 'is.path_medium';
    const PATH_HARD = 'is.path_hard';
    const STRIPE_MAILERLITE = 'stripe.mailerlite';
    const POSTS_SOURCE = 'posts.source';
    const CTA_TEXT = 'cta.text';
    const CTA_BUTTON = 'cta.button';
    const CTA_LINK = 'cta.link';
    const CTA_SECONDARY = 'cta.secondary';

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
        self::STRIPE_MAILERLITE            => 'Grupa Mailerlite (ID) dla automatycznych subskrypcji stripe',
        self::POSTS_SOURCE                 => 'Źródło danych dla aktualności',

        self::CTA_TEXT      => 'CTA: tekst górny',
        self::CTA_BUTTON    => 'CTA: tekst przycisku',
        self::CTA_LINK      => 'CTA: link',
        self::CTA_SECONDARY => 'CTA: tekst dolny',
    ];

    const BOOL = [
        'is.disable_buy',
    ];

    const SELECT = [
        self::STRIPE_MAILERLITE => MailerliteDataSource::class,
    ];

    public static function get(string $key)
    {
        return Setting::get($key);
    }

    public static function isBool(string $key): bool
    {
        return in_array($key, self::BOOL);
    }

    public static function isSelect(string $key): bool
    {
        return array_key_exists($key, static::SELECT);
    }

    public static function getSelectItems(string $key): array
    {
        /** @var SettingsSelectDataSource $provider */
        $provider = app(static::SELECT[$key]);

        return $provider->toArray();
    }
}

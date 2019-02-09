<?php
namespace App\Helpers;

use App\Events\SubscriptionAbandonedEvent;
use App\Events\SubscriptionProlongedEvent;
use App\Events\UserRegisteredEvent;

class FollowupsHelper
{
    const EVENT_REGISTERED = 'registered';
    const EVENT_PAYMENT_ABANDON = 'payment_abandon';
    const EVENT_PAYMENT_SUCCESS = 'payment_success';
    const EVENT_AUTO_PAYMENT_SUCCESS = 'auto_payment';
    const EVENT_AUTO_PAYMENT_ERROR = 'auto_payment_error';
    const EVENT_AUTO_PAYMENT_CANCEL = 'auto_payment_cancel';
    const EVENT_ACCESS_GRANTED = 'access_granted';

    const FOLLOWUPS = [
        self::EVENT_REGISTERED           => 'Użytkownik się zarejestrował',
        self::EVENT_PAYMENT_ABANDON      => 'Porzucono subskrypcję',
        self::EVENT_PAYMENT_SUCCESS      => 'Subskrypcja udana',
        self::EVENT_AUTO_PAYMENT_SUCCESS => 'Automatyczna płatność udana',
        self::EVENT_AUTO_PAYMENT_ERROR   => 'Automatyczna płatność - błąd',
        self::EVENT_AUTO_PAYMENT_CANCEL  => 'Automatyczna płatność anulowana',
        self::EVENT_ACCESS_GRANTED       => 'Przyznano nowy dostęp do kategorii',
    ];

    const EVENTS = [
        UserRegisteredEvent::class        => self::EVENT_REGISTERED,
        SubscriptionAbandonedEvent::class => self::EVENT_PAYMENT_ABANDON,
        SubscriptionProlongedEvent::class => self::EVENT_AUTO_PAYMENT_SUCCESS,
    ];

    public static function getName($event)
    {
        return static::EVENTS[$event] ?? null;
    }
}
<?php
namespace App\Helpers;

use App\Email;
use App\Order;
use App\Payment;
use App\Subscription;
use App\User;
use Cache;
use Carbon\Carbon;

class Statistics
{
    const TIME = 60; // ile minut pamiętać wyniki

    /**
     * Ilu mamy zarejestrowanych użytkowników
     */
    public static function countRegisteredUsers()
    {
        return Cache::remember('registered_users', static::TIME, function () {
            return User::count();
        });
    }

    /**
     * Ilu użytkowników zarejestrowało się od początku tygodnia
     */
    public static function countRegisteredUsersThisWeek()
    {
        return Cache::remember('registered_users_this_week', static::TIME, function () {
            $start = Carbon::now()->startOfWeek();

            return User::where('created_at', '>=', $start)->count();
        });
    }

    /**
     * Ilu użytkowników zarejestrowało się w zadanym przedziale
     */
    public static function countRegisteredUsersInRange($start, $end)
    {
        return Cache::remember('registered_users_' . $start . $end, static::TIME, function () use ($start, $end) {
            return User::where('created_at', '>=', $start)
                ->where('created_at', '<=', $end)
                ->count();
        });
    }

    /**
     * Ilu użytkowników ma wykupiony pełen dostęp
     */
    public static function countPaidUsers()
    {
        return Cache::remember('paid_users', static::TIME, function () {
            return User::whereNotNull('full_access_expires')->count();
        });
    }

    /**
     * Ilu użytkowników wykupiło dostęp w tym tygodniu
     */
    public static function countPaidUsersThisWeek()
    {
        return Cache::remember('paid_users_this_week', static::TIME, function () {
            $start = Carbon::now()->startOfWeek();

            return Order::whereNotNull('confirmed_at')
                ->where('confirmed_at', '>=', $start)
                ->where('is_full_access', 1)
                ->count();
        });
    }

    /**
     * Ilu użytkowników wykupiło dostęp w przedziale
     */
    public static function countPaidUsersInRange($start, $end)
    {
        return Cache::remember('paid_users_' . $start . $end, static::TIME, function () use ($start, $end) {
            return Order::whereNotNull('confirmed_at')
                ->where('confirmed_at', '>=', $start)
                ->where('confirmed_at', '<=', $end)
                ->where('is_full_access', 1)
                ->count();
        });
    }

    /**
     * Liczba złożonych zamówień
     */
    public static function countOrders()
    {
        return Cache::remember('orders', static::TIME, function () {
            return Order::count();
        });
    }

    /**
     * Liczba potwierdzonych zamówień
     */
    public static function countConfirmedOrders()
    {
        return Cache::remember('orders_confirmed', static::TIME, function () {
            return Order::whereNotNull('confirmed_at')->count();
        });
    }

    /**
     * Liczba złożonych zamówień w tym tygodniu
     */
    public static function countOrdersThisWeek()
    {
        return Cache::remember('orders_this_week', static::TIME, function () {
            $start = Carbon::now()->startOfWeek();

            return Order::where('created_at', '>=', $start)->count();
        });
    }

    /**
     * Liczba złożonych zamówień w zadanym okresie
     */
    public static function countOrdersInRange($start, $end)
    {
        return Cache::remember('orders_' . $start . $end, static::TIME, function () use ($start, $end) {
            return Order::where('created_at', '>=', $start)
                ->where('created_at', '<=', $end)
                ->count();
        });
    }


    /**
     * Liczba potwierdzonych zamówień w tym tygodniu
     */
    public static function countConfirmedOrdersThisWeek()
    {
        return Cache::remember('orders_confirmed_this_week', static::TIME, function () {
            $start = Carbon::now()->startOfWeek();

            return Order::whereNotNull('confirmed_at')
                ->where('created_at', '>=', $start)
                ->count();
        });
    }

    /**
     * Liczba potwierdzonych zamówień w zadanym okresie
     */
    public static function countConfirmedOrdersInRange($start, $end)
    {
        return Cache::remember('orders_confirmed_' . $start . $end, static::TIME, function () use ($start, $end) {
            return Order::whereNotNull('confirmed_at')
                ->where('created_at', '>=', $start)
                ->where('created_at', '<=', $end)
                ->count();
        });
    }

    /**
     * Zwraca sumę płatności
     */
    public static function sumPayments()
    {
        return Cache::remember('payments_sum', static::TIME, function () {
            return Order::whereNotNull('confirmed_at')
                ->sum('final_total');
        });
    }

    /**
     * Zwraca sumę płatności
     */
    public static function sumPaymentsThisWeek()
    {
        return Cache::remember('payments_sum_this_week', static::TIME, function () {
            $start = Carbon::now()->startOfWeek();

            return Order::whereNotNull('confirmed_at')
                ->where('confirmed_at', '>=', $start)
                ->sum('final_total');
        });
    }


    /**
     * Zwraca sumę płatności w zadanym okresie
     */
    public static function sumPaymentsInRange($start, $end)
    {
        return Cache::remember('payments_sum_' . $start . $end, static::TIME, function () use ($start, $end) {
            return Order::whereNotNull('confirmed_at')
                ->where('confirmed_at', '>=', $start)
                ->where('confirmed_at', '<=', $end)
                ->sum('final_total');
        });
    }

    /**
     * Ile wysłano maili w zadanym okresie
     */
    public static function countEmailsSent($start, $end)
    {
        return Cache::remember('emails_sent_' . $start . $end, static::TIME, function () use ($start, $end) {
            return Email::where('send_at', '>=', $start)
                ->where('send_at', '<=', $end)
                ->count();
        });
    }

    /**
     * Ile wysłano maili w zadanym okresie zostało otwartych
     */
    public static function countEmailsOpened($start, $end)
    {
        return Cache::remember('emails_opened_' . $start . $end, static::TIME, function () use ($start, $end) {
            return Email::where('send_at', '>=', $start)
                ->where('send_at', '<=', $end)
                ->whereNotNull('opened_at')
                ->count();
        });
    }

    /**
     * Jaki procent wysłanych maili został otwarty?
     */
    public static function procEmailsOpened($start, $end)
    {
        $max = static::countEmailsSent($start, $end);
        if ($max > 0) {
            return 100 * (static::countEmailsOpened($start, $end) / $max);
        } else {
            return 0;
        }
    }

    /**
     * Ile wysłano maili w zadanym okresie zostało klikniętych
     */
    public static function countEmailsClicked($start, $end)
    {
        return Cache::remember('emails_clicked_' . $start . $end, static::TIME, function () use ($start, $end) {
            return Email::where('send_at', '>=', $start)
                ->where('send_at', '<=', $end)
                ->whereNotNull('clicked_at')
                ->count();
        });
    }

    /**
     * Jaki procent wysłanych maili został kliknięty?
     */
    public static function procEmailsClicked($start, $end)
    {
        $max = static::countEmailsSent($start, $end);
        if ($max > 0) {
            return 100 * (static::countEmailsClicked($start, $end) / $max);
        } else {
            return 0;
        }
    }

    /**
     * Ile wysłano maili w zadanym okresie zostało klikniętych
     */
    public static function countEmailsUnsubscribed($start, $end)
    {
        return Cache::remember('emails_unsubscribed_' . $start . $end, static::TIME, function () use ($start, $end) {
            return Email::where('send_at', '>=', $start)
                ->where('send_at', '<=', $end)
                ->whereNotNull('unsubscribed_at')
                ->count();
        });
    }

    /**
     * Jaki procent wysłanych maili został wypisany?
     */
    public static function procEmailsUnsubscribed($start, $end)
    {
        $max = static::countEmailsSent($start, $end);
        if ($max > 0) {
            return 100 * static::countEmailsUnsubscribed($start, $end) / $max;
        } else {
            return 0;
        }
    }

    public static function countSubscriptions()
    {
        return Cache::remember(__FUNCTION__, static::TIME, function () {
            return Subscription::active()->count();
        });
    }

    public static function countSubscriptionsInRange($start, $end)
    {
        return Cache::remember(__FUNCTION__ . $start . $end, static::TIME, function () use ($start, $end) {
            return Subscription::active()
                ->whereBetween('valid_until', [$start, $end])
                ->count();
        });
    }

    public static function sumSubscriptionsPayments()
    {
        return Cache::remember(__FUNCTION__, static::TIME, function () {
            return Payment::confirmed()
                ->sum('amount');
        });
    }

    public static function sumSubscriptionsPaymentsInRange($start, $end)
    {
        return Cache::remember(__FUNCTION__, static::TIME, function () use ($start, $end) {
            return Payment::confirmed()
                ->whereBetween('confirmed_at', [$start, $end])
                ->sum('amount');
        });
    }
}
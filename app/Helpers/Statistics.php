<?php

namespace App\Helpers;

use DB;
use Cache;
use Carbon\Carbon;

class Statistics{
	
	const TIME = 60; // ile minut pamiętać wyniki

	/**
	 * Ilu mamy zarejestrowanych użytkowników
	 * @return [type] [description]
	 */
	public static function countRegisteredUsers(){
		return Cache::remember('registered_users', static::TIME, function(){
			return \App\User::count();
		});
	}

	/**
	 * Ilu użytkowników zarejestrowało się od początku tygodnia
	 * @return [type] [description]
	 */
	public static function countRegisteredUsersThisWeek(){
		return Cache::remember('registered_users_this_week', static::TIME, function(){
			$start = Carbon::now()->startOfWeek();
			return \App\User::where('created_at', '>=', $start)->count();
		});
	}

	/**
	 * Ilu użytkowników zarejestrowało się w zadanym przedziale
	 * @param  [type] $start [description]
	 * @param  [type] $end   [description]
	 * @return [type]        [description]
	 */
	public static function countRegisteredUsersInRange($start, $end){
		return Cache::remember('registered_users_'.$start.$end, static::TIME, function() use($start, $end){
			return \App\User::where('created_at', '>=', $start)
				->where('created_at', '<=', $end)
				->count();
		});
	}

	/**
	 * Ilu użytkowników ma wykupiony pełen dostęp
	 * @return [type] [description]
	 */
	public static function countPaidUsers(){
		return Cache::remember('paid_users', static::TIME, function(){
			return \App\User::whereNotNull('full_access_expires')->count();
		});
	}

	/**
	 * Ilu użytkowników wykupiło dostęp w tym tygodniu
	 * @return [type] [description]
	 */
	public static function countPaidUsersThisWeek(){
		return Cache::remember('paid_users_this_week', static::TIME, function(){
			$start = Carbon::now()->startOfWeek();
			return \App\Order::whereNotNull('confirmed_at')
				->where('confirmed_at', '>=', $start)
				->where('is_full_access', 1)
				->count();
		});
	}

	/**
	 * Ilu użytkowników wykupiło dostęp w przedziale
	 * @return [type] [description]
	 */
	public static function countPaidUsersInRange($start, $end){
		return Cache::remember('paid_users_'.$start.$end, static::TIME, function() use($start, $end ) {
			return \App\Order::whereNotNull('confirmed_at')
				->where('confirmed_at', '>=', $start)
				->where('confirmed_at', '<=', $end)
				->where('is_full_access', 1)
				->count();
		});
	}

	/**
	 * Liczba złożonych zamówień
	 * @return [type] [description]
	 */
	public static function countOrders(){
		return Cache::remember('orders', static::TIME, function(){
			return \App\Order::count();
		});
	}

	/**
	 * Liczba potwierdzonych zamówień
	 * @return [type] [description]
	 */
	public static function countConfirmedOrders(){
		return Cache::remember('orders_confirmed', static::TIME, function(){
			return \App\Order::whereNotNull('confirmed_at')->count();
		});
	}

	/**
	 * Liczba złożonych zamówień w tym tygodniu
	 * @return [type] [description]
	 */
	public static function countOrdersThisWeek(){
		return Cache::remember('orders_this_week', static::TIME, function(){
			$start = Carbon::now()->startOfWeek();
			return \App\Order::where('created_at', '>=', $start)->count();
		});
	}

	/**
	 * Liczba złożonych zamówień w zadanym okresie
	 * @return [type] [description]
	 */
	public static function countOrdersInRange($start, $end){
		return Cache::remember('orders_'.$start.$end, static::TIME, function()use($start, $end){
			return \App\Order::where('created_at', '>=', $start)
				->where('created_at', '<=', $end)
				->count();
		});
	}


	/**
	 * Liczba potwierdzonych zamówień w tym tygodniu
	 * @return [type] [description]
	 */
	public static function countConfirmedOrdersThisWeek(){
		return Cache::remember('orders_confirmed_this_week', static::TIME, function(){
			$start = Carbon::now()->startOfWeek();
			return \App\Order::whereNotNull('confirmed_at')
				->where('created_at', '>=', $start)
				->count();
		});
	}

	/**
	 * Liczba potwierdzonych zamówień w zadanym okresie
	 * @return [type] [description]
	 */
	public static function countConfirmedOrdersInRange($start, $end){
		return Cache::remember('orders_confirmed_'.$start.$end, static::TIME, function()use($start, $end){
			return \App\Order::whereNotNull('confirmed_at')
				->where('created_at', '>=', $start)
				->where('created_at', '<=', $end)
				->count();
		});
	}

	/**
	 * Zwraca sumę płatności
	 * @return [type] [description]
	 */
	public static function sumPayments(){
		return Cache::remember('payments_sum', static::TIME, function(){
			return \App\Order::whereNotNull('confirmed_at')
				->sum('final_total');
		});
	}
	
	/**
	 * Zwraca sumę płatności
	 * @return [type] [description]
	 */
	public static function sumPaymentsThisWeek(){
		return Cache::remember('payments_sum_this_week', static::TIME, function(){
			$start = Carbon::now()->startOfWeek();
			return \App\Order::whereNotNull('confirmed_at')
				->where('confirmed_at', '>=', $start)
				->sum('final_total');
		});
	}


	/**
	 * Zwraca sumę płatności w zadanym okresie
	 * @return [type] [description]
	 */
	public static function sumPaymentsInRange($start, $end){
		return Cache::remember('payments_sum_'.$start.$end, static::TIME, function()use($start, $end){
			return \App\Order::whereNotNull('confirmed_at')
				->where('confirmed_at', '>=', $start)
				->where('confirmed_at', '<=', $end)
				->sum('final_total');
		});
	}

	/**
	 * Ile wysłano maili w zadanym okresie
	 * @param  [type] $start [description]
	 * @param  [type] $end   [description]
	 * @return [type]        [description]
	 */
	public static function countEmailsSent($start, $end){
		return Cache::remember('emails_sent_'.$start.$end, static::TIME, function() use($start, $end){
			return \App\Email::where('send_at', '>=', $start)
				->where('send_at', '<=', $end)
				->count();
		});
	}

	/**
	 * Ile wysłano maili w zadanym okresie zostało otwartych
	 * @param  [type] $start [description]
	 * @param  [type] $end   [description]
	 * @return [type]        [description]
	 */
	public static function countEmailsOpened($start, $end){
		return Cache::remember('emails_opened_'.$start.$end, static::TIME, function() use($start, $end){
			return \App\Email::where('send_at', '>=', $start)
				->where('send_at', '<=', $end)
				->whereNotNull('opened_at')
				->count();
		});
	}

	/**
	 * Jaki procent wysłanych maili został otwarty?
	 * @param  [type] $start [description]
	 * @param  [type] $end   [description]
	 * @return [type]        [description]
	 */
	public static function procEmailsOpened($start, $end){
		$max = static::countEmailsSent($start, $end);
		if( $max > 0 ){
			return 100*(static::countEmailsOpened($start, $end) / $max);
		}else
			return 0;
	}

	/**
	 * Ile wysłano maili w zadanym okresie zostało klikniętych
	 * @param  [type] $start [description]
	 * @param  [type] $end   [description]
	 * @return [type]        [description]
	 */
	public static function countEmailsClicked($start, $end){
		return Cache::remember('emails_clicked_'.$start.$end, static::TIME, function() use($start, $end){
			return \App\Email::where('send_at', '>=', $start)
				->where('send_at', '<=', $end)
				->whereNotNull('clicked_at')
				->count();
		});
	}

	/**
	 * Jaki procent wysłanych maili został kliknięty?
	 * @param  [type] $start [description]
	 * @param  [type] $end   [description]
	 * @return [type]        [description]
	 */
	public static function procEmailsClicked($start, $end){
		$max = static::countEmailsSent($start, $end);
		if( $max > 0 ){
			return 100*(static::countEmailsClicked($start, $end) / $max);
		}else
			return 0;
	}
	/**
	 * Ile wysłano maili w zadanym okresie zostało klikniętych
	 * @param  [type] $start [description]
	 * @param  [type] $end   [description]
	 * @return [type]        [description]
	 */
	public static function countEmailsUnsubscribed($start, $end){
		return Cache::remember('emails_unsubscribed_'.$start.$end, static::TIME, function() use($start, $end){
			return \App\Email::where('send_at', '>=', $start)
				->where('send_at', '<=', $end)
				->whereNotNull('unsubscribed_at')
				->count();
		});
	}

	/**
	 * Jaki procent wysłanych maili został wypisany?
	 * @param  [type] $start [description]
	 * @param  [type] $end   [description]
	 * @return [type]        [description]
	 */
	public static function procEmailsUnsubscribed($start, $end){
		$max = static::countEmailsSent($start, $end);
		if( $max > 0 ){
			return 100 * static::countEmailsUnsubscribed($start, $end) / $max;
		}else
			return 0;
	}
}
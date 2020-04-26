<?php 

namespace App\Traits;

use App\Access;
use App\User;

trait Accessable{
	
	/**
	 * Lista wszystkich dostępów dla tego elementu
	 * @return [type] [description]
	 */
	public function access(){
		return $this->morphMany(Access::class, 'accessable');
	}

	/**
	 * Sprawdź, czy dany użytkownik ma dostęp do tego elementu
	 * @param  integer  $user_id [id użytkownika]
	 * @return boolean          [description]
	 */
	public function hasAccess($user_id){

		$user = User::findOrFail($user_id);

		// Użytkownik ma pełen dostęp do wszystkiego - nic innego nas nie obchodzi
		if($user->hasFullAccess())
			return true;

		// dostęp nigdy nie był wykupiony lub wygasł
		if( is_null($user->expires_at) || $user->expires_at->isPast() )
			return false;

		// Czy liczba wykupionych dni jest większa, niż opóźnienie kursu
		return $this->cumulative_delay <= $user->days_bought;

		// return $this->access()
		// 	->valid()
		// 	->where('user_id', $user_id)
		// 	->exists();
	}

}
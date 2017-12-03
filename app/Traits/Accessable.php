<?php 

namespace App\Traits;

trait Accessable{
	
	/**
	 * Lista wszystkich dostępów dla tego elementu
	 * @return [type] [description]
	 */
	public function access(){
		return $this->morphMany(\App\Access::class, 'accessable');
	}

	/**
	 * Sprawdź, czy dany użytkownik ma dostęp do tego elementu
	 * @param  integer  $user_id [id użytkownika]
	 * @return boolean          [description]
	 */
	public function hasAccess($user_id){
		return $this->access()
			->valid()
			->where('user_id', $user_id)
			->exists();
	}

}
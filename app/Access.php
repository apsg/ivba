<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Access extends Model
{

	protected $guarded = [];

	protected $casts = [
		'expires' => 'datetime',
	];
    
	/**
	 * Wszystkie obiekty z dostępami
	 * @return [type] [description]
	 */
	public function accessable(){
		return $this->morphTo();
	}

	/**
	 * Użytkownik, któremu przyznano ten dostęp
	 * @return [type] [description]
	 */
	public function user(){
		return $this->belongsTo(\App\User::class);
	}

	/**
	 * Scope dla dostępów, które nie wygasły
	 * @param  [type] $query [description]
	 * @return [type]        [description]
	 */
	public function scopeValid($query){
		$query->where('expires', '>', \Carbon\Carbon::now() );
	}

	/**
	 * Przyznaj użytkownikowi dostęp do elementu na X dni
	 * @param  integer 	$user_id [description]
	 * @param  model 	$item    [description]
	 * @param  integer 	$days    [description]
	 * @return [type]          [description]
	 */
	public static function grant($user_id, $item, $days){

		if($access = \App\Access::where([
			'user_id' => $user_id,
			'accessable_type' => get_class($item),
			'accessable_id' => $item->id])->first() ){
			// jeśli dostęp istnieje, ale wygasł, aktywujemy
			if($access->expires->isPast()){
				$access->update([
					'expires' => \Carbon\Carbon::now()->addDays($days)
					]);
				return $access;
			}else{
				// jeśli dostęp istnieje - przedłużamy
				$access->expires = $access->expires->addDays($days);
				$access->save();
				return $access;
			}
		}
		else
			return static::create([
				'user_id' => $user_id,
				'accessable_type' => get_class($item),
				'accessable_id' => $item->id,
				'expires' => \Carbon\Carbon::now()->addDays($days),
			]);
	}

}

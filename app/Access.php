<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Access
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $accessable_type
 * @property int|null $accessable_id
 * @property \Illuminate\Support\Carbon $expires
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $accessable
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Access newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Access newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Access query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Access valid()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Access whereAccessableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Access whereAccessableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Access whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Access whereExpires($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Access whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Access whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Access whereUserId($value)
 * @mixin \Eloquent
 */
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

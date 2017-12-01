<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model{

	protected $guarded = [];

	public $view = 'admin.partials.item';	

	public static function boot(){
		parent::boot();

		/**
		 * Podczas usuwania zasobu "odłącz" go wpierw od 
		 * wszystkich lekcji.
		 */
		static::deleting(function($model){
			$model->lesson()->detach();
		});
	}

	/**
	 * Lekcja, do której należy ten obiekt
	 * @return [type] [description]
	 */
	public function lesson(){
		return $this->morphToMany(\App\Lesson::class, 'items');
	}

}
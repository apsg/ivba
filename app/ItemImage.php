<?php

namespace App;

use App\Item;
use Illuminate\Database\Eloquent\Model;

class ItemImage extends Item
{
	public $view = 'admin.partials.item_image';	

	/**
	 * Obraz przypięty do tego widoku
	 * @return [type] [description]
	 */
	public function image(){
		return $this->belongsTo(\App\Image::class);
	}

}

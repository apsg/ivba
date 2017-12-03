<?php

namespace App;

use App\Item;
use Illuminate\Database\Eloquent\Model;

class ItemMovie extends Item
{
	public $view = 'admin.partials.item_movie';	
    
    /**
     * Obiekt wideo związany z tym elementem
     * @return [type] [description]
     */
	public function video(){
		return $this->belongsTo(\App\Video::class);
	}

}

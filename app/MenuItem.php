<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = [ 'menu_id', 'position', 'title', 'url' ];


    /**
     * Wygeneruj menu o określonym id
     * @param  [type] $menu_id [description]
     * @return [type]          [description]
     */
    public static function make( $menu_id, $order = 'desc' ){
    	$items = static::where('menu_id', $menu_id)
            ->orderBy('position', $order)
            ->get();
    	
    	return $items->map(function($item){
    		return "<a href='"
    			.( filter_var($item->url, FILTER_VALIDATE_URL) ? $item->url : url($item->url) ) 
    			."' ". ($item->is_new_window ? "target='_blank'>" : ">") 
    			. $item->title . "</a>";
    	})->implode('');
    }

}

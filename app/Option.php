<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $guarded = [];

    /**
     * Pobierz określoną wartość. Jeśli jej nie ma - utwórz.
     * @param  [type] $key [description]
     * @return [type]      [description]
     */
    public static function get($key){
    	$option = static::where('key', $key)->first();
    	if($option){
    		return $option;
    	}else{
    		return static::create([
    			'key' => $key,
    			'value' => ''
    			]);
    	}
    }

    /**
     * Zapisuje i zwraca wartość opcji o określonym kluczu
     * @param [type] $key   [description]
     * @param [type] $value [description]
     */
    public static function set($key, $value){
    	$option = static::get($key);
    	$option->value = $value;
    	$option->save();
    	return $option;
    }
}

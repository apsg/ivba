<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $guarded = [];

    /**
     * Użytkownik, który dodał ocenę.
     * @return [type] [description]
     */
    public function user(){
    	return $this->belongsTo(\App\User::class);
    }

    /**
     * Kurs, do którego dodano ocenę.
     * @return [type] [description]
     */
    public function course(){
    	return $this->belongsTo(\App\Course::class);
    }
}

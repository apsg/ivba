<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $guarded = [];

    /**
     * Kurs, do którego przypisano ten certyfikat.
     * @return [type] [description]
     */
    public function course(){
    	return $this->belongsTo(\App\Course::class);
    }
    
}

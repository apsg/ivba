<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccessDay extends Model
{
    protected $guarded = [];

    protected $casts = [
    	'date' => 'date',
    ];

    /**
     * Uzytkownik
     * @return [type] [description]
     */
    public function user(){
    	return $this->belongsTo(\App\User::class);
    }

    /**
     * Scope: dzisiaj
     * @param  [type] $query [description]
     * @return [type]        [description]
     */
    public function scopeCurrent($query){
    	$query->where('date', \Carbon\Carbon::now()->format('Y-m-d'));
    }

    /**
     * Scope: Poprzednie dni
     * @param  [type] $query [description]
     * @return [type]        [description]
     */
    public function scopePast($query){
    	$query->where('date', '<=', \Carbon\Carbon::now()->format('Y-m-d'));
    }

}

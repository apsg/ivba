<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCertificate extends Model
{
    protected $guarded = [];

    /**
     * Użytkownik, dla którego wystawiono ten certyfikat
     * @return [type] [description]
     */
    public function user(){
    	return $this->belongsTo(\App\User::class);
    }

    /**
     * Odniesienie do certyfikatu
     * @return [type] [description]
     */
    public function certificate(){
    	return $this->belongsTo(\App\Certificate::class);
    }

    /**
     * Kurs, do którego był przypisany ten certyfikat.
     * @return [type] [description]
     */
    public function course(){
    	return $this->belongsTo(\App\Course::class);
    }

    /**
     * Link pobierania tego certyfikatu
     * @return [type] [description]
     */
    public function getDownloadUrl(){
        return url('/certificate/'.$this->id.'/download');
    }

}

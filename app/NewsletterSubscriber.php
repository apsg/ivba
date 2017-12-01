<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsletterSubscriber extends Model
{
	use SoftDeletes;

    protected $guarded = [];

    /**
     * Maile wysyłane do tego subskrybenta
     * @return [type] [description]
     */
    public function emails(){
    	return $this->morphMany(\App\Email::class, 'to');
    }

    /**
     * [add description]
     * @param [type] $email [description]
     */
    public static function add( $email, $name = null ){

        if( $subscriber = static::where('email', $email)->first() ){
            return $subscriber;
        }
    	
    	if( $subscriber = static::withTrashed()->where('email', $email)->first() ){
    		$subscriber->restore();
            \App\Newsletter::due()->get()->each->planFor( $subscriber );
    		return $subscriber;
    	}else{

    		$subscriber = static::create([
    			'email' => $email,
    			'name'  => $name
    			]);

            \App\Newsletter::due()->get()->each->planFor( $subscriber );
            return $subscriber;
    	}
    }

    /**
     * Dla spójności z user - usuwanie z list mailingowych
     * @return [type] [description]
     */
    public function unsubscribe(){
        $this->delete();
        flash('Wypisano Cię z newslettera.');
    }
}

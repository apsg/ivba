<?php

namespace App;

use App\NewsletterSubscriber;
use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    protected $guarded = [];

    protected $casts = [
        'send_at' => 'datetime',
    ];

    /**
     * Emaile zaplanowane dla tego newslettera
     * @return [type] [description]
     */
    public function emails(){
    	return $this->hasMany(\App\Email::class);
    }

    /**
     * Zwraca newslettery, które są zaplanowane na przyszłość
     * @return [type] [description]
     */
    public function scopeDue($query){
        $query->where('send_at', '>', \Carbon\Carbon::now());
    }

    /**
     * Zaplanuj emaile do wysyłki.
     * @return [type] [description]
     */
    public function scheduleEmails(){

        $this->emails->each->delete();

    	$subscribers = \App\NewsletterSubscriber::all();

    	foreach ($subscribers as $subscriber) {
    		$subscriber->emails()->create([
    				'from'  => config('mail.from.address'),
    				'title' => $this->title, 
    				'body'	=> $this->body,
    				'send_at' => $this->send_at,
    				'type'  => \App\Email::NEWSLETTER,
    				'unsubscribe_code' => uniqid(),
                    'attachment' => $this->attachment,
                    'newsletter_id' => $this->id,
    			]);
    	}
    }

    /**
     * Zaplanuj wysyłkę tego newslettera dla (nowego) subskrybenta
     * @param  \App\NewsletterSubscriber $subscriber [description]
     * @return [type]                                [description]
     */
    public function planFor( \App\NewsletterSubscriber $subscriber ){
        $subscriber->emails()->create([
                'from'  => config('mail.from.address'),
                'title' => $this->title, 
                'body'  => $this->body,
                'send_at' => $this->send_at,
                'type'  => \App\Email::NEWSLETTER,
                'unsubscribe_code' => uniqid(),
                'attachment' => $this->attachment,
                'newsletter_id' => $this->id,
            ]);
    }

    /**
     * Zwraca liczbę otwartych maili
     * @return [type] [description]
     */
    public function getOpenedAttribute(){
        return $this->emails()->whereNotNull('opened_at')->count();
    }

    /**
     * Zwraca liczbę kliknięć w linki z maili
     * @return [type] [description]
     */
    public function getClickedAttribute(){
        return $this->emails()->whereNotNull('clicked_at')->count();
    }

    /**
     * Zwraca liczbę wypisań po tym newsletterze
     * @return [type] [description]
     */
    public function getUnsubscribedAttribute(){
        return $this->emails()->whereNotNull('unsubscribed_at')->count();
    }


}

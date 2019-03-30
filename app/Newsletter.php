<?php

namespace App;

use App\NewsletterSubscriber;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Newsletter
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $body
 * @property \Illuminate\Support\Carbon $send_at
 * @property string|null $attachment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Email[] $emails
 * @property-read \[type] $clicked
 * @property-read \[type] $opened
 * @property-read \[type] $unsubscribed
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Newsletter due()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Newsletter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Newsletter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Newsletter query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Newsletter whereAttachment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Newsletter whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Newsletter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Newsletter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Newsletter whereSendAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Newsletter whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Newsletter whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Newsletter whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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

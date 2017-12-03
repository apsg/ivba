<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Followup extends Model
{
    protected $guarded = [];

    protected $casts = [
    	'send_at' => 'datetime',
    ];

    /**
     * Treść, pod który ten followup jest podpięty
     * @return [type] [description]
     */
    public function followupContent(){
    	return $this->belongsTo(\App\FollowupContent::class);
    }

    /**
     * Użytkownik przypisany d tego followupa
     * @return [type] [description]
     */
    public function user(){
    	return $this->belongsTo(\App\User::class);
    }

    /**
     * Wyślij ten followup
     * @return [type] [description]
     */
    public function send(){
    	$this->user->emails()->create([
    		'from' 	=> config('mail.from.address'),
    		'title' => $this->followupContent->title,
    		'body'  => $this->followupContent->body,
    		'send_at' => $this->send_at,
    		'type'  => 2,
    		'unsubscribe_code' => uniqid(),
            'attachment' => $this->followupContent->attachment,
    		]);

    	$this->is_sent = true;
    	$this->save();
    }
}

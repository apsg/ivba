<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
    	'user_id',
    	'question_id',
    	'answer',
    	'is_correct',
    	'points'
    ];


    protected $casts = [
    	'answer' => 'array',
    ];

    /**
     * Użytkownik, do którego należy ta odpowiedź.
     * @return [type] [description]
     */
    public function user(){
    	return $this->belongsTo(\App\User::class);
    }

    /**
     * Na jakie pytanie to jest odpowiedź?
     * @return [type] [description]
     */
    public function question(){
    	return $this->belongsTo(\App\Question::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionOption extends Model
{
    protected $guarded = [];

    /**
     * Do którego pytania należy ta odpowiedź.
     * @return [type] [description]
     */
    public function question(){
    	return $this->belongsTo(\App\Question::class);
    }
    
}

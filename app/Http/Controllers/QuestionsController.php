<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }

    /**
     * Zapisuje i sprawdza poprawność odpowiedzi.
     * @param  Question $question [description]
     * @param  Request  $request  [description]
     * @return [type]             [description]
     */
    public function checkAnswer( Question $question, Request $request ){

    	$correct = $question->check( $request->answer );

    	\App\Answer::firstOrCreate([
    		'user_id' 		=> \Auth::user()->id,
    		'question_id' 	=> $question->id,
    	])
    	->update([
    		'answer'		=> $request->answer,
    		'is_correct'	=> $correct,
    		'points'		=> $correct ? $question->points : 0,
    	]);

    	return back();
    }

}

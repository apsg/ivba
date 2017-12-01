<?php

namespace App\Http\Controllers;

use App\Quiz;
use App\Course;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }

	/**
	 * Pokaż test
	 * @param  Course $course [description]
	 * @param  Quiz   $quiz   [description]
	 * @return [type]         [description]
	 */
	public function showQuiz(Course $course, Quiz $quiz){

		$user = \Auth::user();
		
		if($user->hasFinishedQuiz($quiz->id)){
			$quiz = $user->quizzes()->where('quiz_id', $quiz->id)->first();
			return view('learn.quiz_finished')->with(compact('course', 'quiz'));
		}

		if(!$user->hasStartedQuiz($quiz->id)){
			return view('learn.quiz_prestart')->with(compact('course', 'quiz'));
		}

		$question = $quiz->nextQuestion( $user );

		if($question)
			return view('learn.quiz_question')->with(compact('course', 'quiz', 'question'));
		else{
			$quiz->finish();
			\App\Proof::createFinishedQuiz($quiz);
			return back();
		}

	}

	/**
	 * Rozpocznij test
	 * @param  Quiz   $quiz [description]
	 * @return [type]       [description]
	 */
	public function start(Course $course, Quiz $quiz){

		\Auth::user()->quizzes()->attach( $quiz );

		return redirect( $quiz->url() );
	}


}

<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Course;
use App\Proof;
use App\Quiz;
use Auth;

class QuizController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->only('reset');
    }

    /**
     * Pokaż test
     */
    public function showQuiz(Course $course, Quiz $quiz)
    {
        $user = Auth::user();

        if ($user->hasFinishedQuiz($quiz->id)) {
            $quiz = $user->quizzes()->where('quiz_id', $quiz->id)->first();

            return view('learn.quiz_finished')->with(compact('course', 'quiz'));
        }

        if (!$user->hasStartedQuiz($quiz->id)) {
            return view('learn.quiz_prestart')->with(compact('course', 'quiz'));
        }

        $question = $quiz->nextQuestion($user);

        if ($question) {
            return view('learn.quiz_question')->with(compact('course', 'quiz', 'question'));
        } else {
            $quiz->finish();
            Proof::createFinishedQuiz($user, $quiz);

            return back();
        }
    }

    /**
     * Rozpocznij test
     */
    public function start(Course $course, Quiz $quiz)
    {
        Auth::user()->quizzes()->attach($quiz);

        return redirect($quiz->url());
    }

    public function reset(Course $course, Quiz $quiz)
    {
        Answer::whereIn('question_id', $quiz->questions->pluck('id'))
            ->where('user_id', Auth::user()->id)
            ->delete();

        Auth::user()->quizzes()->detach($quiz->id);

        return redirect($quiz->url());
    }

}

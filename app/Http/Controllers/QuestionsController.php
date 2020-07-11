<?php
namespace App\Http\Controllers;

use App\Question;
use App\Repositories\AnswerRepository;
use Auth;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Zapisuje i sprawdza poprawność odpowiedzi.
     */
    public function checkAnswer(Question $question, Request $request, AnswerRepository $repository)
    {
        $repository->checkUser(Auth::user(), $question, $request->answer);

        return back();
    }
}

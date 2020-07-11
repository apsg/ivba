<?php

namespace App\Http\Controllers;

use App\Question;
use App\QuestionOption;
use Illuminate\Http\Request;

class AdminQuestionOptionsController extends Controller
{
    public function __contruct()
    {
        $this->middleware('admin');
    }

    /**
     * Zapisz nową odpowiedź w bazie i przypnij do pytania.
     * @param  Question $question [description]
     * @param  Request  $request  [description]
     * @return [type]             [description]
     */
    public function store(Question $question, Request $request)
    {
        $this->validate($request, [
            'title'	=> 'required',
        ]);

        $option = $question->options()->create($request->all());

        if ($request->ajax()) {
            return ['html' => view('admin.quizzes.question_option')->with(compact('option'))->render()];
        }

        return back()->with(['open' => $question->id]);
    }

    /**
     * Usuń tę opcję.
     * @param  QuestionOption $option [description]
     * @return [type]                 [description]
     */
    public function delete(QuestionOption $option, Request $request)
    {
        $option->delete();

        if ($request->ajax()) {
            return ['ok'];
        }

        return back();
    }
}

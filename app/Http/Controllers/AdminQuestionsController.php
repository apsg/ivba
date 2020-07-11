<?php

namespace App\Http\Controllers;

use App\Question;
use App\Quiz;
use Illuminate\Http\Request;

class AdminQuestionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Dodaj nowe pytanie do testu.
     * @param Quiz    $quiz [description]
     * @param Request $request [description]
     * @return [type]           [description]
     */
    public function store(Quiz $quiz, Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'type'  => 'required|numeric|in:1,2,3',
        ]);

        $question = Question::create([
            'title'   => $request->title,
            'type'    => $request->type,
            'quiz_id' => $quiz->id,
        ]);

        flash('Dodano');

        return back()->with(['open' => $question->id]);
    }

    /**
     * Zaktualizuj dane pytania.
     * @param Question $question [description]
     * @param Request  $request [description]
     * @return [type]             [description]
     */
    public function patch(Question $question, Request $request)
    {
        $question->update($request->all());
        flash('Zapisano');

        return back()->with(['open' => $question->id]);
    }

    /**
     * Usuwa pytanie.
     * @param Question $question [description]
     * @return [type]             [description]
     */
    public function delete(Question $question)
    {
        $question->delete();
        flash('Pytanie usunięte');

        return back();
    }
}

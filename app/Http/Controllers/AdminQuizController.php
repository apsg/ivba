<?php

namespace App\Http\Controllers;

use App\Quiz;
use Illuminate\Http\Request;

class AdminQuizController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Pokaż spis testów.
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function index(Request $request)
    {
        $quizzes = \App\Quiz::with('course')->get();
        $courses = \App\Course::all();

        return view('admin.quizzes.index')->with(compact('quizzes', 'courses'));
    }

    /**
     * Zapisz nowy test.
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'		=> 'required',
            'course_id'	=> 'required|exists:courses,id',
            'pass_threshold' => 'required|numeric|min:0|max:100',
        ]);

        $quiz = \App\Quiz::create($request->all());

        return redirect('/admin/quizzes/' . $quiz->id);
    }

    /**
     * Pokaż quiz.
     * @param  Quiz    $quiz    [description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function show(Quiz $quiz, Request $request)
    {
        $courses = \App\Course::all();

        return view('admin.quizzes.show')->with(compact('quiz', 'courses'));
    }

    /**
     * Usuń dany test.
     * @param  Quiz   $quiz [description]
     * @return [type]       [description]
     */
    public function delete(Quiz $quiz)
    {
        $quiz->delete();

        return back();
    }

    /**
     * Zaktualizuj dane testu.
     * @param  Quiz    $quiz    [description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function patch(Quiz $quiz, Request $request)
    {
        $this->validate($request, [
            'name'           => 'required',
            'course_id'      => 'required|exists:courses,id',
            'pass_threshold' => 'required|numeric|min:0|max:100',
            'is_random'      => 'boolean',
        ]);

        $fields = $request->all();

        if (! isset($fields['is_random'])) {
            $fields['is_random'] = false;
        }

        $quiz->update($fields);

        flash('Zaktualizowano pomyślnie');

        return back();
    }

    /**
     * Zaktualizuj kolejność pytań dodanych do tego testu.
     * @param  Quiz    $quiz    [description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function updateOrder(Quiz $quiz, Request $request)
    {
        if (! empty($request->order)) {
            foreach ($request->order as $o) {
                \App\Question::findOrFail($o['question_id'])->update([
                    'position' => $o['position'],
                ]);
            }
        }

        return ['OK'];
    }

    /**
     * Pokaż statystyki dla danego testu.
     * @param  Quiz    $quiz    [description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function statistics(Quiz $quiz, Request $request)
    {
        $avg = $quiz->users->avg('pivot.points');
        $passability = $quiz->users->where('pivot.is_pass', true)->count();
        $passability_p = 100 * $passability / $quiz->users->count();

        $ids = $quiz->questions->pluck('id');
        $stats = \DB::table('answers')
            ->select(\DB::raw('question_id, avg(is_correct) as a'))
            ->whereIn('question_id', $ids)
            ->groupBy('question_id')
            ->orderBy('a', 'asc')
            ->get();

        if ($stats->count() > 0) {
            $hardest = \App\Question::find($stats->first()->question_id);
            $hardest->stats = $stats->first()->a;
            $easiest = \App\Question::find($stats->last()->question_id);
            $easiest->stats = $stats->last()->a;
        }

        return view('admin.quizzes.statistics')->with(compact('quiz', 'avg', 'passability', 'passability_p', 'hardest', 'easiest'));
    }
}

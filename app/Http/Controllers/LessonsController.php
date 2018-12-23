<?php
namespace App\Http\Controllers;

use App\Lesson;
use App\Transformers\FrontpageLessonTransformer;

class LessonsController extends Controller
{
    public function show(Lesson $lesson)
    {
        return view('pages.lesson')->with(compact('lesson'));
    }

    public function random($number)
    {
        $lessons = Lesson::inRandomOrder()->take($number)->get();

        return fractal()
            ->collection($lessons, new FrontpageLessonTransformer())
            ->toArray();
    }
}

<?php
namespace App\Http\Controllers;

use App\Course;
use App\Transformers\CoursesTransformer;
use Auth;
use Illuminate\Support\Collection;

class CoursesController extends Controller
{
    /**
     * Pokaż stronę kursów.
     */
    public function index()
    {
        return view('pages.courses');
    }

    public function list()
    {
        /** @var Collection $courses */
        $courses = collect([]);
        $current = null;

        if (Auth::check() && Auth::user()->hasFullAccess()) {
            $courses = Course::orderBy('position', 'asc')->get();
        } else {
            $current = Auth::user()->current_day ?? null;
            $courses = Course::orderBy('position', 'asc')->get();
        }

        return fractal()->collection($courses, new CoursesTransformer($current))
            ->toArray();
    }

    /**
     * [show description].
     * @return [type] [description]
     */
    public function show(Course $course)
    {
        return view('pages.course')->with(compact('course'));
    }

    public function redirect()
    {
        return redirect('/courses');
    }
}

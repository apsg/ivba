<?php

namespace App\Http\Controllers;

use App\Course;
use Auth;

class CoursesController extends Controller
{

    /**
     * Pokaż stronę kursów
     * @return [type] [description]
     */
    public function index()
    {
        $courses = null;
        $next = null;
        $next_course = null;

        if (Auth::check()) {
            if (Auth::user()->hasFullAccess()) {

                $courses = Course::orderBy('position', 'asc')->paginate(12);
                $next_courses = collect([]);

            } else {

                $current = Auth::user()->current_day;

                $courses = Course::where('cumulative_delay', '<=', $current)
                    ->orderBy('position', 'asc')->paginate(12);

                $next_courses = Course::where('cumulative_delay', '>', $current)
                    ->orderBy('position', 'asc')
                    ->get();
            }

        } else {
            $courses = [];
            $next_courses = collect([]);
        }

        return view('pages.courses')->with(compact('courses', 'next', 'next_courses'));
    }

    /**
     * [show description]
     * @return [type] [description]
     */
    public function show(Course $course)
    {
        return view('pages.course')->with(compact('course'));
    }

}

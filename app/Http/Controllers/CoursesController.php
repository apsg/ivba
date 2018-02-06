<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

class CoursesController extends Controller
{

	/**
	 * Pokaż stronę kursów
	 * @return [type] [description]
	 */
    public function index(){

        $courses = null;
        $next = null;

        if(\Auth::check()){
            if(\Auth::user()->hasFullAccess()){

                $courses = Course::orderBy('position', 'asc')->paginate(12);

            }else{

                $current = \Auth::user()->current_day;

            	$courses = Course::where('cumulative_delay', '<=', $current)
                ->orderBy('position', 'asc')->paginate(12);

                $next_course = Course::where('cumulative_delay', '>', $current)
                    ->orderBy('position', 'asc')
                    ->first();

                if($next_course){
                    $next = $next_course->cumulative_delay - $current;
                }
            }

        }
        else
            $courses = [];


    	return view('pages.courses')->with(compact('courses', 'next'));
    }

    /**
     * [show description]
     * @return [type] [description]
     */
    public function show(Course $course){
    	return view('pages.course')->with(compact('course'));
    }

}

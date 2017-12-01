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
    	$courses = \App\Course::orderBy('created_at', 'desc')->paginate(12);
    	return view('pages.courses')->with(compact('courses'));
    }

    /**
     * [show description]
     * @return [type] [description]
     */
    public function show(Course $course){
    	return view('pages.course')->with(compact('course'));
    }

}

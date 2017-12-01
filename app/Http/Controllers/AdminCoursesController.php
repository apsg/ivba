<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use App\Http\Requests\CourseRequest;

class AdminCoursesController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    	$this->middleware('admin');
    }

    /**
     * Listuj wszystkie kursy
     * @return [type] [description]
     */
    public function index(){
    	$courses = Course::all();
    	return view('admin.courses')->with(compact('courses'));
    }

    /**
     * Formularz dodawania nowego kursu
     * @return [type] [description]
     */
    public function create(){
        return view('admin.courses.new');
    }

    /**
     * Dodaj nowy kurs do bazy
     * @param  CourseRequest $request [description]
     * @return [type]                 [description]
     */
    public function store(CourseRequest $request){
        $fields = $request->all();

        if(empty($fields['slug'])){
            $fields['slug'] = str_slug($fields['title']);
        }

        $fields['user_id'] = auth()->user()->id;

        $course = Course::create($fields);

        if($request->ajax()){
            return $course;
        }

        return redirect('/admin/courses/'.$course->slug)->with('message', 'Kurs dodany!');

    }

    /**
     * Pokaż szczegóły danego kursu
     * @param  Course $course [description]
     * @return [type]         [description]
     */
    public function show(Course $course){
        return view('admin.courses.course')->with(compact('course'));
    }

    /**
     * Zaktualizuj dane kursu
     * @param  Course        $course  [description]
     * @param  CourseRequest $request [description]
     * @return [type]                 [description]
     */
    public function update(Course $course, CourseRequest $request){
        
        $fields = $request->all();

        if(empty($fields['slug'])){
            $fields['slug'] = str_slug($fields['title']);
        }
        
        $course->update($fields);

        return back()->with('message', 'Kurs zapisany!');;

    }

    /**
     * Zsynchronizuj dodane lekcje do kursu
     * @param  Course  $course  [description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function updateLessonOrder(Course $course, Request $request){

        $position = [];

        if(!empty($request->order)){
            foreach($request->order as $o){
                $position[ $o['lesson_id'] ] = ['position' => $o['position']];
            }
        }

        $course->lessons()->sync( $position );

        return ['OK'];
    }

}

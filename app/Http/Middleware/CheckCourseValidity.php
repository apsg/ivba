<?php

namespace App\Http\Middleware;

use Closure;

class CheckCourseValidity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $course = $request->route('course');
        $lesson = $request->route('lesson');

        if($course){
            // Czy użytkownik ma dostęp do kursu?
            if(\Gate::denies('access-course', $course)){
                return redirect('/')->with(['msg' => 'Nie masz dostępu do tego kursu']);
            }

            if($lesson){
                // Czy ta lekcja należy do kursu?
                $courses = $lesson->courses()->pluck('course_id')->all();

                if(!in_array($course->id, $courses)){
                    return redirect($course->learnUrl());
                }

                // Czy użytkownik ma dostęp do lekcji?
                if(\Gate::denies('access-lesson', $lesson)){
                    return redirect($course->learnUrl())->with(['msg' => 'Nie masz dostępu do tej lekcji']);
                }
            }
        }

        return $next($request);
    }
}

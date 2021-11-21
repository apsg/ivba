<?php
namespace App\Http\Middleware;

use App\Course;
use App\Helpers\GateHelper;
use App\Lesson;
use Closure;
use Illuminate\Support\Facades\Gate;

class CheckCourseValidity
{
    public function handle($request, Closure $next)
    {
        /** @var Course $course */
        $course = $request->route('course');

        /** @var Lesson $lesson */
        $lesson = $request->route('lesson');

        if ($course) {
            // Czy użytkownik ma dostęp do kursu?
            if (Gate::denies(GateHelper::ACCESS_COURSE, $course)) {
                return redirect('/')->withErrors(['msg' => 'Nie masz dostępu do tego kursu']);
            }

            if ($lesson) {
                // Czy ta lekcja należy do kursu?
                $courses = $lesson->courses()->pluck('course_id')->all();

                if (!in_array($course->id, $courses)) {
                    return redirect($course->learnUrl());
                }

                // Czy użytkownik ma dostęp do lekcji?
                if (Gate::denies(GateHelper::ACCESS_LESSON, $lesson)) {
                    return redirect($course->learnUrl())->withErrors(['msg' => 'Nie masz dostępu do tej lekcji']);
                }
            }
        }

        return $next($request);
    }
}

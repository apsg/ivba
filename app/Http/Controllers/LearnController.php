<?php

namespace App\Http\Controllers;

use App\Course;
use App\Helpers\GateHelper;
use App\Lesson;
use App\Proof;
use App\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class LearnController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('validity');
    }

    /**
     * Pokaż widok kursu.
     * @param  Course $course [description]
     * @param  Lesson $lesson [description]
     * @return [type]         [description]
     */
    public function showCourse(Course $course, Lesson $lesson, Request $request)
    {
        if (! empty($lesson->slug) && Gate::denies('access-lesson', $lesson)) {
            flash('Nie masz dostępu do tej lekcji')->warning();

            return redirect(! is_null($course) ? $course->link() : $lesson->previewLink());
        }

        // Jeśli nie wybrano lekcji - przekieruj do pierwszej.
        if (empty($lesson->slug)) {
            $lesson = $course->visibleLessons(Auth::user())->first();

            if (empty($lesson)) {
                return back()->withErrors(['Do tego kursu nie dodano jeszcze żadnej lekcji. Poczekaj na jego uzupełnienie lub skontaktuj się z obsługą.']);
            }

            return redirect('learn/course/' . $course->slug . '/lesson/' . $lesson->slug);
        }

        $this->assignToUser($course, $lesson);

        return view('learn')->with(compact('course', 'lesson'));
    }

    /**
     * Pokaż lekcję.
     */
    public function showLesson(Lesson $lesson)
    {
        $this->assignToUser(null, $lesson);
        $course = null;

        return view('learn')->with(compact('lesson', 'course'));
    }

    /**
     * Przypisz kurs i lekcję do użytkownika.
     */
    protected function assignToUser(Course $course = null, Lesson $lesson = null)
    {
        if (! empty($course) && ! Auth::user()->hasStartedCourse($course->id)) {
            Auth::user()->courses()->attach($course);
        }

        if (! Auth::user()->hasStartedLesson($lesson->id)) {
            Auth::user()->lessons()->attach($lesson, [
                'course_id' => $course->id ?? null,
            ]);
        }
    }

    /**
     * Zakończ lekcję i przejdź do następnej.
     */
    public function finishLesson(Course $course, Lesson $lesson)
    {
        $user = Auth::user();
        if (! $user->hasFinishedLesson($lesson->id)) {
            Proof::createFinishedLesson($user, $lesson);
        }

        $lesson->finish($course->id);

        if (! isset($course->id)) {
            return back();
        }

        return redirect($course->nextLessonLink($lesson->id));
    }

    /**
     * Pokaż ekran podsumowania kursu.
     */
    public function finishedCourse(Course $course)
    {
        if (! Auth::user()->hasFinishedCourse($course->id)) {
            return redirect($course->next());
        }

        $rating = Rating::where('user_id', Auth::user()->id)
            ->where('course_id', $course->id)
            ->first();

        return view('learn.finish')->with(compact('course', 'rating'));
    }

    /**
     * Dodaj ocenę do kursu.
     * @param  Course  $course [description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function rate(Course $course, Request $request)
    {
        if (Gate::denies(GateHelper::ACCESS_COURSE, $course)) {
            return response()->json('no access', 403);
        }

        $this->validate($request, [
            'rating' => 'required|numeric|min:1|max:5',
        ]);

        $rating = Rating::firstOrCreate([
            'user_id'   => Auth::user()->id,
            'course_id' => $course->id,
        ])->update([
            'rating' => $request->rating,
        ]);

        return ['OK'];
    }
}

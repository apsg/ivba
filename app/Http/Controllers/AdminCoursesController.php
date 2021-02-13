<?php

namespace App\Http\Controllers;

use App\Course;
use App\Domains\Courses\Repositories\CoursesRepository;
use App\Http\Requests\Admin\Courses\ListCoursesRequest;
use App\Http\Requests\Admin\Courses\UpdateDelayRequest;
use App\Http\Requests\CourseRequest;
use Illuminate\Http\Request;

class AdminCoursesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Listuj wszystkie kursy.
     * @return [type] [description]
     */
    public function index()
    {
        $courses = Course::all();

        return view('admin.courses')->with(compact('courses'));
    }

    /**
     * Formularz dodawania nowego kursu.
     * @return [type] [description]
     */
    public function create()
    {
        return view('admin.courses.new');
    }

    /**
     * Dodaj nowy kurs do bazy.
     * @param CourseRequest $request [description]
     * @return [type]                 [description]
     */
    public function store(CourseRequest $request)
    {
        $course = Course::create($request->fields() + [
                'user_id' => auth()->user()->id,
            ]);

        if ($request->ajax()) {
            return $course;
        }

        return redirect('/admin/courses/' . $course->slug)->with('message', 'Kurs dodany!');
    }

    /**
     * Pokaż szczegóły danego kursu.
     * @param Course $course [description]
     * @return [type]         [description]
     */
    public function show(Course $course)
    {
        return view('admin.courses.course')->with(compact('course'));
    }

    /**
     * Zaktualizuj dane kursu.
     * @param Course        $course [description]
     * @param CourseRequest $request [description]
     * @return [type]                 [description]
     */
    public function update(Course $course, CourseRequest $request)
    {
        $course->update($request->fields());

        return back()->with('message', 'Kurs zapisany!');
    }

    /**
     * Zsynchronizuj dodane lekcje do kursu.
     * @param Course  $course [description]
     * @param Request $request [description]
     * @return [type]           [description]
     */
    public function updateLessonOrder(Course $course, Request $request)
    {
        $position = [];

        if (!empty($request->order)) {
            foreach ($request->order as $o) {
                $position[$o['lesson_id']] = ['position' => $o['position']];
            }
        }

        $course->lessons()->sync($position);

        return ['OK'];
    }

    /**
     * Aktualizuje kolejność kursów.
     * @param Request $request [description]
     * @return [type]           [description]
     */
    public function updateOrder(Request $request)
    {
        if (!empty($request->order)) {
            foreach ($request->order as $order) {
                Course::findOrFail($order['course_id'])
                    ->update(['position' => $order['position']]);
            }
        }

        Course::reorder();

        return ['ok'];
    }

    public function delete(Course $course)
    {
        $course->lessons()->detach();
        $course->delete();

        return redirect('/admin/courses');
    }

    public function list(ListCoursesRequest $request)
    {
        return Course::search($request->input('s'))->get();
    }

    public function updateLessonDelay(Course $course, UpdateDelayRequest $request)
    {
        $lesson = $course->lessons()
            ->withPivot(['delay'])
            ->where('lesson_id', $request->input('lesson_id'))
            ->firstOrFail();

        $lesson->pivot->delay = $request->input('delay', 0);
        $lesson->pivot->save();

        return ['ok'];
    }

    public function duplicate(Course $course, CoursesRepository $repository)
    {
        $repository->duplicate($course);

        flash('Zduplikowano kurs');

        return back();
    }
}

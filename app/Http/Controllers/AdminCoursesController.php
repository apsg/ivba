<?php
namespace App\Http\Controllers;

use App\Course;
use App\Domains\Courses\Models\Author;
use App\Domains\Courses\Models\Group;
use App\Domains\Courses\Models\Tag;
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

    public function index()
    {
        $courses = Course::orderBy('position')->get();
        $groups = Group::with('courses')->orderBy('order')->get();

        if (request()->wantsJson()) {
            return $courses;
        }

        return view('admin.courses')->with(compact('courses', 'groups'));
    }

    public function create()
    {
        return view('admin.courses.new');
    }

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

    public function show(Course $course)
    {
        $tags = Tag::query()->orderBy('name')->get();
        $authors = Author::query()->orderBy('name')->get();

        return view('admin.courses.course')->with(compact('course', 'tags', 'authors'));
    }

    public function update(Course $course, CourseRequest $request)
    {
        $course->update($request->fields());

        flash('Kurs zapisany');

        return redirect(route('admin.course.edit', $course->slug));
    }

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

    public function updateOrder(Request $request)
    {
        if (!empty($request->order)) {
            foreach ($request->order as $order) {
                Course::findOrFail($order['course_id'])
                    ->update([
                        'position' => $order['position'],
                        'group_id' => null,
                    ]);
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

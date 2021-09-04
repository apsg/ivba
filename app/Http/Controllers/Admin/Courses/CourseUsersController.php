<?php
namespace App\Http\Controllers\Admin\Courses;

use App\Course;
use App\Http\Controllers\Controller;
use App\User;
use Yajra\DataTables\Facades\DataTables;

class CourseUsersController extends Controller
{
    public function index(Course $course)
    {
        return view('admin.courses.users')->with(compact('course'));
    }

    public function getData(Course $course)
    {
        $query = $course->users()->select(['users.*', 'course_user.finished_at', 'course_user.created_at as start_at']);

        return DataTables::of($query)
            ->addColumn('options', function (User $item) use ($course) {
                return '<a href="#" class="btn btn-ivba btn-sm logbook-open" data-user="' . $item->id . '" data-course="' . $course->id . '"><i class="fa fa-pencil"></i> LogBook </a>';
            })
            ->rawColumns(['options'])
            ->make(true);
    }
}

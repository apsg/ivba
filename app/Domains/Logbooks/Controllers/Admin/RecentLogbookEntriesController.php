<?php
namespace App\Domains\Logbooks\Controllers\Admin;

use App\Course;
use App\Domains\Logbooks\Models\LogbookEntry;
use App\Http\Controllers\Controller;
use App\User;
use Yajra\DataTables\Facades\DataTables;

class RecentLogbookEntriesController extends Controller
{
    public function index(Course $course)
    {
        return view('admin.courses.recent_logbooks')->with(compact('course'));
    }

    public function getData(Course $course)
    {
        $query = LogbookEntry::whereIn('course_id', $course->logbooks->pluck('id'))
            ->with('user', 'logbook');

        return DataTables::of($query)
            ->addColumn('options', function (LogbookEntry $item) use ($course) {
                return '<a href="#" class="btn btn-ivba btn-sm logbook-open" data-user="' . $item->user_id . '" data-course="' . $course->id . '"><i class="fa fa-pencil"></i> Zobacz wszystkie wpisy </a>';
            })
            ->rawColumns(['options'])
            ->make(true);
    }
}

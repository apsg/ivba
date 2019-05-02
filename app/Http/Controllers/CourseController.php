<?php

namespace App\Http\Controllers;

use App\Course;
use App\Services\CourseProgressService;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function progress(Course $course, CourseProgressService $service)
    {
        $user = \Auth::user();
        $total = $service->total($course);
        $finished = $service->finished($user, $course);
        $progress = $service->progress($user, $course);

        return response()->json(compact('total', 'finished', 'progress'));
    }
}

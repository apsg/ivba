<?php
namespace App\Http\Controllers;

use App\Course;
use App\Helpers\ProgressHelper;
use App\Services\CourseProgressService;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function progress(Course $course, CourseProgressService $service)
    {
        /** @var User $user */
        $user = Auth::user();

        return Cache::remember(ProgressHelper::cacheKey($user, $course),
            60,
            function () use ($user, $service, $course) {
                $total = $service->total($course);
                $finished = $service->finished($user, $course);
                $progress = $service->progress($user, $course);

                return response()->json(compact('total', 'finished', 'progress'));
            });
    }
}

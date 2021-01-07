<?php
namespace App\Http\Controllers;

use App\Course;
use App\Repositories\AccessRepository;
use App\Transformers\CoursesTransformer;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class CoursesController extends Controller
{
    /**
     * Pokaż stronę kursów.
     */
    public function index()
    {
        return view('pages.courses');
    }

    public function list(AccessRepository $accessRepository)
    {
        /** @var Collection $courses */
        $courses = collect([]);
        $current = null;

        $accessIds = $accessRepository->getCourseAccessIdsForUser(Auth::user());

        if (Auth::check() && Auth::user()->hasFullAccess()) {
            $courses = Course::withoutSpecialExcept($accessIds)
                ->orderBy('position', 'asc')
                ->get();
        } else {
            $current = Auth::user()->current_day ?? null;
            $courses = Course::withoutSpecialExcept($accessIds)
                ->orderBy('position', 'asc')
                ->get();
        }

        return fractal()
            ->collection($courses, new CoursesTransformer($current))
            ->toArray();
    }

    /**
     * [show description].
     * @return [type] [description]
     */
    public function show(Course $course)
    {
        return view('pages.course')->with(compact('course'));
    }

    public function redirect()
    {
        return redirect('/courses');
    }
}

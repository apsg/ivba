<?php
namespace App\Http\Controllers;

use App\Course;
use App\Domains\Courses\Http\Requests\CourseListRequest;
use App\Domains\Courses\Http\Transformers\GroupWithAccessTransformer;
use App\Domains\Courses\Models\Group;
use App\Repositories\AccessRepository;
use App\Transformers\CoursesTransformer;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Spatie\Fractalistic\ArraySerializer;

class CoursesController extends Controller
{
    public function index(Group $group = null)
    {
        return view('pages.courses')->with(compact('group'));
    }

    public function list(CourseListRequest $request, AccessRepository $accessRepository)
    {
        /** @var Collection $courses */
        $courses = collect([]);
        $current = null;

        $accessIds = $accessRepository->getCourseAccessIdsForUser(Auth::user());

        if ($request->input('group') !== null){
            $group = Group::findOrFail($request->input('group'));
            return [
                'courses' => [],
                'groups'  => fractal()
                    ->collection([$group])
                    ->transformWith(new GroupWithAccessTransformer($current, Auth::user(), $accessIds))
                    ->serializeWith(new ArraySerializer())
                    ->toArray(),
            ];
        }

        if (Auth::check() && Auth::user()->hasFullAccess()) {
            $courses = Course::withoutSpecialExcept($accessIds)
                ->withoutPaths()
                ->withoutGroups()
                ->orderBy('position', 'asc');
        } else {
            $current = Auth::user()->current_day ?? null;
            $courses = Course::withoutSpecialExcept($accessIds)
                ->withoutPaths()
                ->withoutGroups()
                ->orderBy('position', 'asc');
        }

        $courses = $courses->get();

        $groups = Group::orderBy('order')->get();

        return [
            'courses' => fractal()
                ->collection($courses)
                ->transformWith(new CoursesTransformer($current, Auth::user()))
                ->serializeWith(new ArraySerializer())
                ->toArray(),
            'groups'  => fractal()
                ->collection($groups)
                ->transformWith(new GroupWithAccessTransformer($current, Auth::user(), $accessIds))
                ->serializeWith(new ArraySerializer())
                ->toArray(),
        ];
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

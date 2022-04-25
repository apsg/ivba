<?php
namespace App\Domains\Api\Controllers;

use App\Domains\Api\Events\CourseAccessGrantedEvent;
use App\Domains\Api\Requests\GrantAccessRequest;
use App\Domains\Courses\Services\CoursesService;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Response;

class ExternalAccessController extends Controller
{
    public function grant(GrantAccessRequest $request, UserRepository $userRepository, CoursesService $coursesService)
    {
        $user = $userRepository->findByEmailOrCreate($request->input('email'));

        $coursesService->attachUserToCourse($user, $request->course());
        event(new CourseAccessGrantedEvent($user, $request->course()));

        return response('ok', Response::HTTP_CREATED);
    }
}

<?php
namespace App\Domains\Api\Controllers;

use App\Domains\Api\Events\CourseAccessGrantedEvent;
use App\Domains\Api\Requests\GrantAccessRequest;
use App\Domains\Courses\Services\CoursesService;
use App\Events\FullAccessGrantedEvent;
use App\Http\Controllers\Controller;
use App\Repositories\AccessRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Response;

class ExternalAccessController extends Controller
{
    public function grant(
        GrantAccessRequest $request,
        UserRepository $userRepository,
        CoursesService $coursesService,
        AccessRepository $accessRepository
    ) {
        $user = $userRepository->findByEmailOrCreate($request->input('email'));

        if ($request->isFullAccess()) {
            $accessRepository->grantFullAccess($user, 365);
            event(new FullAccessGrantedEvent($user));
        } else {
            $coursesService->attachUserToCourse($user, $request->course());
            event(new CourseAccessGrantedEvent($user, $request->course()));
        }

        return response('ok', Response::HTTP_CREATED);
    }
}

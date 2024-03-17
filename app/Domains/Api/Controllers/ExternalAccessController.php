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
use Illuminate\Support\Facades\Log;

class ExternalAccessController extends Controller
{
    public function grant(
        GrantAccessRequest $request,
        UserRepository $userRepository,
        CoursesService $coursesService,
        AccessRepository $accessRepository
    ) {
        Log::info(__CLASS__, $request->all());

        $user = $userRepository->findByEmailOrCreate($request->input('email'));

        if ($request->isLifetimeAccess()) {
            $accessRepository->grantFullAccess($user, 25*365);
            event(new FullAccessGrantedEvent($user));
        } elseif ($request->isFullAccess()) {
            $accessRepository->grantFullAccess($user, 365);
            event(new FullAccessGrantedEvent($user));
        } else {
            $coursesService->attachUserToCourse($user, $request->course());
            event(new CourseAccessGrantedEvent($user, $request->course()));
        }

        return response('ok', Response::HTTP_CREATED);
    }
}

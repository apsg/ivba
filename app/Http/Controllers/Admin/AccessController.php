<?php
namespace App\Http\Controllers\Admin;

use App\Access;
use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Courses\StoreAccessRequest;
use App\Repositories\AccessRepository;
use App\User;

class AccessController extends Controller
{
    public function index(User $user)
    {
        return $this->listAccess($user);
    }

    public function store(StoreAccessRequest $request, AccessRepository $repository)
    {
        $repository->grant($request->selectedUser(), $request->course());

        return $this->listAccess($request->selectedUser());
    }

    public function revoke(StoreAccessRequest $request, AccessRepository $repository)
    {
        $repository->revoke($request->selectedUser(), $request->course());

        return $this->listAccess($request->selectedUser());
    }

    public function destroy(Access $access)
    {
        $access->delete();

        return $this->listAccess($access->user);
    }

    private function listAccess(User $user)
    {
        return $user->accesses()
            ->where('accessable_type', Course::class)
            ->with('accessable')
            ->get()
            ->filter(function (Access $access) { return $access->accessable !== null; });
    }
}

<?php
namespace App\Domains\Courses\Http\Controllers;

use App\Domains\Courses\Http\Requests\StoreGroupRequest;
use App\Domains\Courses\Models\Group;
use App\Domains\Courses\Repositories\GroupsRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class CourseGroupsController extends Controller
{
    public function store(StoreGroupRequest $request, GroupsRepository $repository): RedirectResponse
    {
        $repository->create($request->input('name'));

        return back();
    }

    public function destroy(Group $group): RedirectResponse
    {
        $group->delete();

        return back();
    }

    public function up(Group $group, GroupsRepository $repository): RedirectResponse
    {
        $repository->up($group);

        return back();
    }

    public function down(Group $group, GroupsRepository $repository): RedirectResponse
    {
        $repository->down($group);

        return back();
    }
}

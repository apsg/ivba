<?php
namespace App\Domains\Courses\Repositories;

use App\Course;
use App\Domains\Courses\Models\Group;
use Illuminate\Support\Arr;

class GroupsRepository
{
    public function create(string $name): Group
    {
        return Group::create([
            'name'  => $name,
            'order' => (int) Group::max('order') + 1,
        ]);
    }

    public function up(Group $group): void
    {
        /** @var Group $before */
        $before = Group::where('order', '<', $group->order)
            ->orderBy('order', 'desc')
            ->first();

        if ($before === null) {
            $group->update([
                'order' => 0,
            ]);
        }

        $before->update([
            'order' => $group->order,
        ]);
        $group->update([
            'order' => $group->order - 1,
        ]);
    }

    public function down(Group $group): void
    {

        /** @var Group $after */
        $after = Group::where('order', '>', $group->order)
            ->orderBy('order', 'asc')
            ->first();

        if ($after === null) {
            return;
        }

        $after->update([
            'order' => $group->order,
        ]);
        $group->update([
            'order' => $group->order + 1,
        ]);
    }

    public function updateOrder(Group $group, array $order = []): void
    {
        foreach ($order as $item) {
            $course = Course::find(Arr::get($item, 'course_id'));
            if ($course === null) {
                continue;
            }

            $course->update([
                'group_id' => $group->id,
                'position' => Arr::get($item, 'position', 0),
            ]);
        }
    }
}

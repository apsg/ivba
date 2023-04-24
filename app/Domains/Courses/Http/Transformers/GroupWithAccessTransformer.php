<?php

namespace App\Domains\Courses\Http\Transformers;

use App\Domains\Courses\Models\Group;
use App\Transformers\CoursesTransformer;
use App\User;
use League\Fractal\Resource\Collection;
use League\Fractal\TransformerAbstract;

class GroupWithAccessTransformer extends TransformerAbstract
{
    /** @var int|null */
    protected $currentDay = null;
    protected ?User $user = null;
    protected array $accessIds = [];

    protected array $defaultIncludes = ['courses'];
    protected array $availableIncludes = ['courses'];

    public function __construct($currentDay = null, User $user = null, array $accessIds = [])
    {
        $this->currentDay = $currentDay;
        $this->user = $user;
        $this->accessIds = $accessIds;
    }

    public function transform(Group $group): array
    {
        return [
            'id'   => $group->id,
            'name' => $group->name,
        ];
    }

    public function includeCourses(Group $group): Collection
    {
        return $this->collection(
            $group->courses()->withoutSpecialExcept($this->accessIds)->withoutPaths()->get(),
            new CoursesTransformer($this->currentDay, $this->user)
        );
    }
}

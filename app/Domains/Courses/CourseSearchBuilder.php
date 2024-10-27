<?php
namespace App\Domains\Courses;

use App\Course;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class CourseSearchBuilder
{
    protected array $accessIds = [];
    protected ?string $search;
    protected ?string $sort;
    protected ?int $groupId;

    public function __construct(array $accessIds = [])
    {
        $this->accessIds = $accessIds;
    }

    public function setSearch(?string $search): CourseSearchBuilder
    {
        $this->search = $search;

        return $this;
    }

    public function setSort(?string $sort): CourseSearchBuilder
    {
        $this->sort = $sort;

        return $this;
    }

    public function forGroup(?int $groupId): CourseSearchBuilder
    {
        $this->groupId = $groupId;

        return $this;
    }

    /** @return Course[] */
    public function get(): Collection
    {
        $builder = Course::query()
            ->with('tags', 'author', 'lessons');

        if (!empty($this->groupId)) {
            $builder = $builder->whereHas('groups', function ($query) {
                $query->where('groups.id', $this->groupId);
            });
        }

        $builder = $this->applySort($builder);
        $builder = $this->applySearch($builder);

        return $builder->get();
    }

    private function applySort(Builder $builder): Builder
    {
        if ($this->sort === 'new') {
            $builder->whereHas('tags', function ($query) {
                $query->where('name', 'like', '%Nowość%');
            });
        }

        if ($this->sort === 'cheapest') {
            $builder->orderBy('price', 'asc');
        }

        if ($this->sort === 'expensive') {
            $builder->orderBy('price', 'desc');
        }

        if ($this->sort === 'promotion') {
            $builder->whereHas('tags', function ($query) {
                $query->where('name', 'like', '%promocja%');
            });
        }

        if ($this->sort === 'bestseller') {
            $builder->whereHas('tags', function ($query) {
                $query->where('name', 'like', '%bestseller%');
            });
        }

        return $builder;
    }

    private function applySearch(Builder $builder)
    {
        if (empty($this->search)) {
            return $builder;
        }

        return $builder->where(function (Builder $builder) {
            $builder->where('title', 'like', '%' . $this->search . '%')
                ->orWhere('description', 'like', '%' . $this->search . '%')
                ->orWhere('things', 'like', '%' . $this->search . '%')
                ->orWhere('topics', 'like', '%' . $this->search . '%');
        });
    }
}

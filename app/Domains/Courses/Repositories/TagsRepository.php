<?php
namespace App\Domains\Courses\Repositories;

use App\Domains\Courses\Models\Tag;

class TagsRepository
{
    public function create(string $name, string $color = null, bool $isHidden = false): Tag
    {
        if (empty($color)) {
            $color = $this->randomColor();
        }

        return Tag::create([
            'name'      => $name,
            'color'     => $color,
            'is_hidden' => $isHidden,
        ]);
    }

    protected function randomColor(): string
    {
        return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
    }
}

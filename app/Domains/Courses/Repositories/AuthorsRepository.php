<?php
namespace App\Domains\Courses\Repositories;

use App\Domains\Courses\Models\Author;

class AuthorsRepository
{
    public function create(
        string $name,
        string $image,
        bool $isInternal,
        string $description = null,
        string $bio = null
    ): Author {
        return Author::create([
            'name'        => $name,
            'image'       => $image,
            'is_internal'  => $isInternal,
            'description' => $description,
            'bio'         => $bio,
        ]);
    }
}

<?php
namespace App\Domains\Posts\Repositories;

use App\Domains\Posts\Models\Post;
use Illuminate\Support\Str;

class PostsRepository
{
    public function create(array $attributes) : Post
    {
        if (isset($attributes['slug'])) {
            $attributes['slug'] = Str::slug($attributes['slug']);
        } else {
            $attributes['slug'] = Str::slug($attributes['title']);
        }

        return Post::create($attributes);
    }
}

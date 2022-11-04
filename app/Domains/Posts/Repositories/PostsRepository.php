<?php
namespace App\Domains\Posts\Repositories;

use App\Domains\Posts\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PostsRepository
{
    public function create(array $attributes): Post
    {
        if (isset($attributes['slug'])) {
            $attributes['slug'] = Str::slug($attributes['slug']);
        } else {
            $attributes['slug'] = Str::slug($attributes['title']);
        }

        $attributes['published_at'] = Carbon::now();
        $attributes['excerpt'] = Str::words(strip_tags($attributes['body']));

        return Post::create($attributes);
    }
}

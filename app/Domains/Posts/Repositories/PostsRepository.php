<?php
namespace App\Domains\Posts\Repositories;

use App\Domains\Posts\Actions\ClearPostDisplaysAction;
use App\Domains\Posts\Models\Post;
use Carbon\Carbon;

class PostsRepository
{
    public function create(string $title, string $body, string $ctaUrl = null, int $imageId = null): Post
    {
        $attributes['published_at'] = Carbon::now();

        $post = Post::create([
            'title'    => $title,
            'body'     => $body,
            'cta_url'  => $ctaUrl,
            'image_id' => $imageId,
        ]);

        (new ClearPostDisplaysAction())->execute();

        return $post;
    }
}

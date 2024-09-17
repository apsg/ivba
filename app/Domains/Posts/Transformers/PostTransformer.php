<?php
namespace App\Domains\Posts\Transformers;

use App\Domains\Posts\Models\Post;
use League\Fractal\TransformerAbstract;

class PostTransformer extends TransformerAbstract
{
    public function transform(Post $post): array
    {
        return [
            'id'           => $post->id,
            'title'        => $post->title,
            'body'         => $post->body,
            'published_at' => $post->published_at->diffForHumans(),
            'img'          => $post->image->thumb(600, 300),
            'cta_url'      => $post->cta_url,
        ];
    }
}

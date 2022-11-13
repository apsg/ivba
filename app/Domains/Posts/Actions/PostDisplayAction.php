<?php
namespace App\Domains\Posts\Actions;

use App\Domains\Posts\Models\Post;
use App\Domains\Posts\Models\PostDisplay;
use App\User;

class PostDisplayAction
{
    public function execute(User $user, Post $post): void
    {
        PostDisplay::firstOrCreate([
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);
    }
}

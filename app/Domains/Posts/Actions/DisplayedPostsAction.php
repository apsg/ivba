<?php
namespace App\Domains\Posts\Actions;

use App\User;

class DisplayedPostsAction
{
    public function execute(User $user): void
    {
        if ($user->has_seen_posts) {
            return;
        }

        $user->update([
            'has_seen_posts' => true,
        ]);
    }
}

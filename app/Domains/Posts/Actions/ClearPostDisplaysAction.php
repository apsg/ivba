<?php
namespace App\Domains\Posts\Actions;

use App\User;

class ClearPostDisplaysAction
{
    public function execute()
    {
        User::query()->update([
            'has_seen_posts' => false,
        ]);
    }
}

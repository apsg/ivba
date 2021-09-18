<?php
namespace App\Domains\Logbooks\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LogbookCommentPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return $user->isadmin;
    }

    public function delete(User $user)
    {
        return $user->isadmin;
    }
}

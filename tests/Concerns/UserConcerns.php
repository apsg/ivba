<?php
namespace Tests\Concerns;

use App\User;
use Carbon\Carbon;

trait UserConcerns
{
    public function createUser() : User
    {
        return factory(User::class)->create();
    }

    public function createAdmin() : User
    {
        return factory(User::class)->create([
            'isadmin' => true,
        ]);
    }

    public function grantFullAccess(User $user) : User
    {
        $user->update([
            'full_access_expires' => Carbon::now()->addMonth(),
        ]);

        return $user;
    }
}

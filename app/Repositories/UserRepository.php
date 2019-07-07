<?php
namespace App\Repositories;

use App\User;

class UserRepository
{
    public function findByEmail(string $email) : ?User
    {
        return User::where('email', '=', $email)
            ->first();
    }

    public function createAndSend(array $attributes = []) : User
    {
        $user = User::create($attributes);

        // TODO send password reset link

        return $user;
    }
}

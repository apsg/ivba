<?php
namespace App\Repositories;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;

class UserRepository
{
    public function findByEmail(string $email) : ?User
    {
        return User::where('email', '=', $email)
            ->first();
    }

    public function createAndSend(array $attributes = []) : User
    {
        $user = User::create(array_merge(
            [
                'name' => '',
            ],
            [
                'password' => uniqid(),
            ],
            array_filter($attributes)
        ));

        $this->resetPassword($user->fresh());

        return $user;
    }

    public function resetPassword(User $user) : bool
    {
        Password::broker()
            ->sendResetLink([
                'email' => $user->email,
            ]);

        DB::table('passwords')->insert([
            'email'    => $user->email,
            'password' => $user->password,
        ]);

        return true;
    }
}

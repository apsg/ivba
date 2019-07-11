<?php
namespace App\Helpers;

use App\Repositories\UserRepository;

class PasswordReset
{
    public static function send()
    {
        if (\Auth::check()) {

            $user = \Auth::user();

            app(UserRepository::class)->resetPassword($user);
        }
    }
}

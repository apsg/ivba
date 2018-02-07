<?php

namespace App\Helpers;

class PasswordReset{
	
	public static function send(){

		if(\Auth::check()){

			$user = \Auth::user();

	        $c = new \App\Http\Controllers\Auth\ForgotPasswordController;
	        $c->broker()->sendResetLink([
                'email' => $user->email,
	        ]);

	        \DB::table('passwords')->insert([
                'email'     => $user->email,
                'password'  => $user->password,
            ]);

	    }

	}
}
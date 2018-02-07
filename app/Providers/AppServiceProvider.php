<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        \Carbon\Carbon::setLocale('pl');

        Validator::extend('different_password', function($attribute, $value, $parameters, $validator){


            $passwords = \DB::table('passwords')
                ->select('password')
                ->where('email', $validator->getData()['email'])
                ->orderBy('created_at', 'desc')
                ->take(4)
                ->get();

            foreach($passwords as $password){
                if(\Hash::check($value, $password->password))
                    return false;
            }

            return true;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

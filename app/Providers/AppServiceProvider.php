<?php
namespace App\Providers;

use App\Email;
use App\Observers\EmailObserver;
use App\Observers\QuickSaleObserver;
use App\QuickSale;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

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
        Carbon::setLocale('pl');

        Validator::extend('different_password', function ($attribute, $value, $parameters, $validator) {
            $passwords = \DB::table('passwords')
                ->select('password')
                ->where('email', $validator->getData()['email'])
                ->orderBy('created_at', 'desc')
                ->take(4)
                ->get();

            foreach ($passwords as $password) {
                if (\Hash::check($value, $password->password)) {
                    return false;
                }
            }

            return true;
        });

        Email::observe(EmailObserver::class);
        QuickSale::observe(QuickSaleObserver::class);
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

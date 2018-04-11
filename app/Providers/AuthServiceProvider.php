<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /*
        Czy dany użytkownik jest adminem?
         */
        Gate::define('admin', function($user){
            return \Auth::check() && $user->isadmin;
        });

        /*
        Czy dany użytkownik ma dostęp do tego kursu?
         */
        Gate::define('access-course', function($user, $course){
            return \Auth::check() && ($user->hasFullAccess() || $course->hasAccess($user->id) );
        });

        /*
        Czy dany użytkownik ma dostęp do tej lekcji?
         */
        Gate::define('access-lesson', function($user, $lesson){
            return \Auth::check() && (
                $user->hasFullAccess()
                || $lesson->hasCourseAccess($user->id)
                || $lesson->hasAccess($user->id)
            );
        });


        /**
         * Czy dany użytkownik ma dostęp do lekcji lub kursu?
         */
        Gate::define('access', function($user, $item){

            if(\Auth::check() && $user->hasFullAccess() )
                return true;

            if(get_class($item) == 'App\Course')
                return $item->hasAccess($user->id) ;

            if(get_class($item) == 'App\Lesson')
                return $item->hasAccess($user->id) || $item->hasCourseAccess($user->id);

            return false;
        });

        /**
         * Czy użytkownik może podejść ponownie do testu?
         */
        Gate::define('retake-quiz', function($user, $quiz){
            return ! $user->quizzes()->where('quiz_id', $quiz->id)->exists()
                || \Carbon\Carbon::parse( $quiz->pivot->finished_date )
                    ->diffInDays( \Carbon\Carbon::now() ) > 14;
        });

        /**
         * Czy użytkownik może wykupić pełen dostęp?
         */
        Gate::define('can-buy-subscription', function($user){
            return !empty($user->first_name) 
                && !empty($user->last_name)
                && !empty($user->address);
        });

    }
}

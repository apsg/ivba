<?php
namespace App\Providers;

use App\Course;
use App\Lesson;
use App\Payment;
use App\Policies\CoursePolicy;
use App\Policies\LessonPolicy;
use App\Policies\PaymentPolicy;
use App\Policies\UserCertificatePolicy;
use App\Quiz;
use App\User;
use App\UserCertificate;
use Auth;
use Carbon\Carbon;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     */
    protected $policies = [
        Payment::class         => PaymentPolicy::class,
        UserCertificate::class => UserCertificatePolicy::class,
        Course::class          => CoursePolicy::class,
        Lesson::class          => LessonPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();

        /*
        Czy dany użytkownik jest adminem?
         */
        Gate::define('admin', function ($user) {
            return Auth::check() && $user->isadmin;
        });

        /*
        Czy dany użytkownik ma dostęp do tego kursu?
         */
        Gate::define('access-course', function (User $user, Course $course) {
            return Gate::check('access', $course);
        });

        /*
        Czy dany użytkownik ma dostęp do tej lekcji?
         */
        Gate::define('access-lesson', function (User $user, Lesson $lesson) {
            return Gate::check('access', $lesson);
        });


        /**
         * Czy użytkownik może podejść ponownie do testu?
         */
        Gate::define('retake-quiz', function (User $user, Quiz $quiz) {
            if ($user->cannot('access', $quiz->course)) {
                return false;
            }

            $quiz = $user->quizzes()
                ->withPivot('finished_date')
                ->where('quiz_id', $quiz->id)
                ->first();

            if ($quiz === null) {
                return true;
            }

            return Carbon::parse($quiz->pivot->finished_date)->diffInDays() > 14;
        });

        /**
         * Czy użytkownik może wykupić pełen dostęp?
         */
        Gate::define('can-buy-subscription', function (User $user) {
            return !empty($user->first_name)
                && !empty($user->last_name)
                && !empty($user->address);
        });

        /**
         * Czy użytkownik ma wykupiony pełen dostęp lub abonament?
         */
        Gate::define('active', function (User $user) {
            return $user->hasFullAccess() || $user->hasActiveSubscription();
        });
    }
}

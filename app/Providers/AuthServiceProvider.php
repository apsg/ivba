<?php
namespace App\Providers;

use App\Course;
use App\Domains\Admin\Helpers\SettingsHelper;
use App\Domains\Logbooks\Models\LogbookComment;
use App\Domains\Logbooks\Policies\LogbookCommentPolicy;
use App\Helpers\GateHelper;
use App\Lesson;
use App\Payment;
use App\Policies\CoursePolicy;
use App\Policies\LessonPolicy;
use App\Policies\PaymentPolicy;
use App\Policies\UserCertificatePolicy;
use App\Quiz;
use App\User;
use App\UserCertificate;
use Illuminate\Support\Facades\Auth;
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
        LogbookComment::class  => LogbookCommentPolicy::class,
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
        Gate::define(GateHelper::ADMIN, function ($user) {
            return Auth::check() && $user->isadmin;
        });

        /*
        Czy dany użytkownik ma dostęp do tego kursu?
         */
        Gate::define(GateHelper::ACCESS_COURSE, function (User $user, Course $course) {
            return Gate::check('access', $course);
        });

        /*
        Czy dany użytkownik ma dostęp do tej lekcji?
         */
        Gate::define(GateHelper::ACCESS_LESSON, function (User $user, Lesson $lesson) {
            return Gate::check('access', $lesson);
        });

        /*
         * Czy użytkownik może podejść ponownie do testu?
         */
        Gate::define(GateHelper::RETAKE_QUIZ, function (User $user, Quiz $quiz) {
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

            return Carbon::parse($quiz->pivot->finished_date)->diffInDays() > Quiz::RETAKE_QUIZ_IN_DAYS;
        });

        /*
         * Czy użytkownik może wykupić pełen dostęp?
         */
        Gate::define(GateHelper::CAN_BUY_SUBSCRIPTION, function (User $user) {
            return (!empty($user->name) || !empty($user->company_name))
                && !empty($user->address);
        });

        /*
         * Czy użytkownik ma wykupiony pełen dostęp lub abonament?
         */
        Gate::define(GateHelper::ACTIVE, function (User $user) {
            return $user->hasFullAccess() || $user->hasActiveSubscription();
        });

        /*
         * Czy użytkownik może wygenerować prośbę o fakturę?
         */
        Gate::define(GateHelper::REQUEST_INVOICE, function (User $user) {
            if ($user->company_name === null || $user->taxid === null || $user->address === null) {
                return false;
            }

            return true;
        });

        Gate::define(GateHelper::BUY_ENABLED, function () {
            return !SettingsHelper::get('is.disable_buy');
        });
    }
}

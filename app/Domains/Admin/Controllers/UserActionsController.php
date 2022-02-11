<?php
namespace App\Domains\Admin\Controllers;

use App\Events\FullAccessGrantedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AccessRequest;
use App\Notifications\RandomPasswordGenerated;
use App\Quiz;
use App\Repositories\SubscriptionRepository;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserActionsController extends Controller
{
    public function grantFullAccess(User $user, AccessRequest $request)
    {
        if ($user->full_access_expires === null || $user->full_access_expires->isPast()) {
            $user->update([
                'full_access_expires' => Carbon::now()->addMonths($request->duration),
            ]);

            event(new FullAccessGrantedEvent($user));
        } else {
            $user->update([
                'full_access_expires' => $user->full_access_expires->addMonths($request->duration),
            ]);
        }

        flash('Przyznano lub przedłużono pełen dostęp');

        return back();
    }

    public function grantSubscriptionAccess(User $user, AccessRequest $request, SubscriptionRepository $repository)
    {
        if ($user->hasFullAccess()) {
            flash('Nie można uruchomić subskrupcji użytkownikowi, który posiada aktywny pełen dostęp.');

            return back();
        }

        $subscription = $user->subscription ?? $repository->create($user);

        $days = Carbon::parse($subscription->valid_until)->addMonths($request->duration)->diffInDays();

        $repository->grantAccessDays($subscription, $days);

        flash('Przyznano dostęp subskrypcyjny');

        return back();
    }

    public function cancelFullAccess(User $user)
    {
        $user->update([
            'full_access_expires' => null,
        ]);

        flash('Anulowano');

        return back();
    }

    public function sendPassword(User $user)
    {
        $password = str_random(8);

        $user->password = Hash::make($password);
        $user->save();

        $user->notify(new RandomPasswordGenerated($password));

        flash('Hasło wysłane');

        return back();
    }

    public function resetQuizzes(User $user)
    {
        DB::table('quiz_user')
            ->where('user_id', $user->id)
            ->where('is_pass', false)
            ->update([
                'finished_date' => Carbon::now()->subDays(Quiz::RETAKE_QUIZ_IN_DAYS + 1),
            ]);

        flash('Zresetowano');

        return back();
    }
}

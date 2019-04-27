<?php
namespace App\Http\Controllers;

use App\Events\FullAccessGrantedEvent;
use App\Http\Requests\Admin\AccessRequest;
use App\Notifications\RandomPasswordGenerated;
use App\Repositories\SubscriptionRepository;
use App\Services\PartnerProgramService;
use App\Services\RankingService;
use App\User;
use Carbon\Carbon;
use DataTables;
use Gate;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        $this->middleware('auth');
    }

    /**
     * Pokaż listę użytkowników
     */
    public function index()
    {
        $users = User::where('isadmin', false)
            ->orderBy('name', 'asc')
            ->get();

        return view('admin.users')->with(compact('users'));
    }

    /**
     * Usuwanie użytkownika
     */
    public function delete(User $user)
    {
        if (Gate::allows('admin')) {
            $user->delete();

            return redirect('/admin/user');
        }
        flash('Nie masz uprawnień, by to zrobić');

        return back();
    }

    public function sendPassword(User $user)
    {
        $password = str_random(8);

        $user->password = Hash::make($password);
        $user->save();

        $user->notify(new RandomPasswordGenerated($password));

        return back();
    }

    public function getData(Request $request)
    {
        $model = User::query()->with('subscription');

        return DataTables::of($model)
            ->addColumn('options', function (User $item) {
                return '<a href="' . $item->deleteLink() . '" class="btn btn-warning" onclick="return confirm(\'Na pewno chcesz usunąć?\');"><i class="fa fa-trash"></i> Usuń</a>
                    <a href="' . $item->editLink() . '" class="btn btn-default"><i class="fa fa-edit"></i> Edytuj</a>';
            })
            ->addColumn('subscription', function (User $item) {
                $subscription = $item->subscription;

                if ($subscription === null) {
                    return null;
                }

                return "Ważna do: " . $subscription->valid_until . PHP_EOL
                    . "Aktywna: " . ($subscription->is_active ? "Tak" : "Nie") . PHP_EOL
                    . 'Kwota: ' . $subscription->amount . ' PLN';
            })
            ->rawColumns(['options'])
            ->make(true);
    }

    /**
     * Pokaż podgląd edycji użytkownika
     * @param User $user [description]
     * @return [type]       [description]
     */
    public function edit(User $user)
    {
        return view('admin.users.edit')->with(compact('user'));
    }

    /**
     * Zaktualizuj użytkownika
     * @param User    $user [description]
     * @param Request $request [description]
     * @return [type]           [description]
     */
    public function patch(User $user, Request $request)
    {
        $this->validate($request, [
            'name'  => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
        ]);

        $user->update($request->only(['name', 'email']));

        flash('Zaktualizowano pomyślnie');

        return back();

    }

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

    public function ranking($type, RankingService $service)
    {
        $ranking = [];

        if ($type == 'all') {
            $ranking = $service->getRanking();
        }

        if ($type == 'month') {
            $ranking = $service->getThisMonthRanking();
        }

        return view('admin.ranking')->with(compact('type', 'ranking'));
    }

    public function partner(PartnerProgramService $service)
    {
        $partners = $service->all();

        return view('admin.users.partner')->with(compact('partners'));
    }
}

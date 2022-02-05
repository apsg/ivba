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
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Laracsv\Export;

class AdminUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        $this->middleware('auth');
    }

    /**
     * Pokaż listę użytkowników.
     */
    public function index()
    {
        $users = User::where('isadmin', false)
            ->orderBy('name', 'asc')
            ->get();

        return view('admin.users')->with(compact('users'));
    }

    /**
     * Usuwanie użytkownika.
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

                return 'Ważna do: ' . $subscription->valid_until . PHP_EOL
                    . 'Aktywna: ' . ($subscription->is_active ? 'Tak' : 'Nie') . PHP_EOL
                    . 'Kwota: ' . $subscription->amount . ' PLN';
            })
            ->rawColumns(['options'])
            ->make(true);
    }

    /**
     * Pokaż podgląd edycji użytkownika.
     * @param User $user [description]
     * @return [type]       [description]
     */
    public function edit(User $user)
    {
        return view('admin.users.edit')->with(compact('user'));
    }

    /**
     * Zaktualizuj użytkownika.
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

    public function expiredReport()
    {
        // TODO disable debugbar here

        $users = User::expired()
            ->with('subscription')
            ->orderBy('created_at')
            ->get();
        $exporter = new Export();
        $exporter->beforeEach(function (User $user) {
            $user->type = $user->full_access_expires !== null ? 'Pełen dostęp' : 'Subskrypcja';
            $user->expired = $user->full_access_expires ?? $user->subscription->cancelled_at ?? null;
        });
        $exporter->build($users, [
            'email',
            'full_name'  => 'Imię',
            'created_at' => 'Utworzony',
            'expired'    => 'Wygasł',
            'type'       => 'Typ',
        ]);

        return $exporter->download();
    }
}

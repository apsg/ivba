<?php
namespace App\Http\Controllers;

use App\Http\Requests\Admin\UpdateUserRequest;
use App\Services\PartnerProgramService;
use App\Services\RankingService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Laracsv\Export;
use Yajra\DataTables\Facades\DataTables;

class AdminUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::where('isadmin', false)
            ->orderBy('name', 'asc')
            ->get();

        return view('admin.users')->with(compact('users'));
    }

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

    public function edit(User $user)
    {
        return view('admin.users.edit')->with(compact('user'));
    }

    public function patch(User $user, UpdateUserRequest $request)
    {
        $user->update($request->validated());

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

<?php
namespace App\Http\Controllers;

use App\Notifications\RandomPasswordGenerated;
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
     * @return [type] [description]
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
     * @param  User $user [description]
     * @return [type]       [description]
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


    /**
     * [sendPassword description]
     * @param  User $user [description]
     * @return [type]       [description]
     */
    public function sendPassword(User $user)
    {

        $password = str_random(8);

        $user->password = Hash::make($password);
        $user->save();

        $user->notify(new RandomPasswordGenerated($password));

        return back();
    }


    /**
     * Zwraca dane dla dataTables
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getData(Request $request)
    {
        $model = User::query();

        return DataTables::of($model)
            ->addColumn('options', function ($item) {
                return '<a href="' . $item->sendPasswordLink() . '" class="btn btn-info"><i class="fa fa-envelope-o"></i> Wyślij losowe hasło</a>
                    <a href="' . $item->deleteLink() . '" class="btn btn-warning" onclick="return confirm(\'Na pewno chcesz usunąć?\');"><i class="fa fa-trash"></i> Usuń</a>
                    <a href="' . $item->editLink() . '" class="btn btn-default"><i class="fa fa-edit"></i> Edytuj</a>
                    <a href="' . $item->grantFullAccessLink() . '" class="btn btn-ivba confirm"><i class="fa fa-key"></i> Przyznaj pełen dostęp na rok</a>';
            })
            ->rawColumns(['options'])
            ->make(true);
    }

    /**
     * Pokaż podgląd edycji użytkownika
     * @param  User $user [description]
     * @return [type]       [description]
     */
    public function edit(User $user)
    {
        return view('admin.users.edit')->with(compact('user'));
    }

    /**
     * Zaktualizuj użytkownika
     * @param  User    $user [description]
     * @param  Request $request [description]
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

    public function grantFullAccess(User $user)
    {
        if ($user->full_access_expires === null || $user->full_access_expires->isPast()) {
            $user->update([
                'full_access_expires' => Carbon::now()->addYear(),
            ]);
        } else {
            $user->update([
                'full_access_expires' => $user->full_access_expires->addYear(),
            ]);
        }

        flash('Przyznano lub przedłużono pełen dostęp na rok');

        return back();
    }
}

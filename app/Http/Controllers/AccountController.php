<?php

namespace App\Http\Controllers;

use App\Helpers\PasswordReset;
use App\Payment;
use Auth;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Pokaż dane konta
     * @return [type] [description]
     */
    public function show()
    {
        $user = Auth::user();

        $payments = Payment::forUser($user)->orderBy('created_at', 'desc')->get();

        return view('account')->with(compact('user', 'payments'));
    }

    /**
     * Zaktualizuj dane użytkownika
     * @return [type] [description]
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $user->update($request->only('name'));

        return redirect('account');
    }

    /**
     * Zmień hasło
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function changePassword(Request $request)
    {
        PasswordReset::send();

        Auth::logout();

        flash('Link do resetu hasła został pomyślnie wysłany. Nastąpiło automatyczne wylogowanie.');

        return redirect('/');
    }

    /**
     * Zaktualizuj dane użytkownika.
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function patch(Request $request)
    {

        $request->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'address'    => 'required',
        ]);

        Auth::user()
            ->update(
                $request->only('first_name', 'last_name', 'address')
            );

        return back()->with(['status' => 'Zaktualizowano']);
    }


}

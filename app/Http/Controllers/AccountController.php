<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }

    /**
     * Pokaż dane konta
     * @return [type] [description]
     */
    public function show(){
    	$user = \Auth::user();
            
    	return view('account')->with(compact('user'));
    }

    /**
     * Zaktualizuj dane użytkownika
     * @return [type] [description]
     */
    public function update(Request $request){
    	$user = \Auth::user();

    	$user->update($request->only('name'));

    	return redirect('account');
    }

    /**
     * Zmień hasło
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function changePassword(Request $request){        
        
        $c = new \App\Http\Controllers\Auth\ForgotPasswordController;
        $c->broker()->sendResetLink([
                'email' => \Auth::user()->email
                ]);

        \Auth::logout();

        flash('Link do resetu hasła został pomyślnie wysłany. Nastąpiło automatyczne wylogowanie.');
        return redirect('/');
    }

}

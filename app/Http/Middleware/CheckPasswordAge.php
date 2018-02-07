<?php

namespace App\Http\Middleware;

use Closure;

class CheckPasswordAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(\Auth::check() && \Auth::user()->changed_password_at->diffInDays() >= 90 ){

            $c = new \App\Http\Controllers\Auth\ForgotPasswordController;
            $c->broker()->sendResetLink([
                'email' => \Auth::user()->email
                ]);

            \Auth::logout();
            return redirect('/')->withErrors(['Hasło nie było zmieniane od 90 dni. Na Twój adres mailowy wysłaliśmy link do resetu hasła. Nie będzie można się zalogować dopóki nie zmienisz hasła.']);
        }

        return $next($request);
    }
}

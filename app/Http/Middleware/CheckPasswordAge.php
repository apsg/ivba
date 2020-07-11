<?php

namespace App\Http\Middleware;

use App\Helpers\PasswordReset;
use Auth;
use Closure;

class CheckPasswordAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (env('APP_ENV') === 'production'
            && Auth::check()
            && Auth::user()->changed_password_at->diffInDays() >= 90) {
            PasswordReset::send();

            Auth::logout();

            return redirect('/')
                ->withErrors(['Hasło nie było zmieniane od 90 dni. Na Twój adres mailowy wysłaliśmy link do resetu hasła. Nie będzie można się zalogować dopóki nie zmienisz hasła.']);
        }

        return $next($request);
    }
}

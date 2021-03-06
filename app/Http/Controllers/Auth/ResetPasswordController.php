<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => [
                'required',
                'confirmed',
                new \App\Rules\PasswordRule,
//                'different_password',
            ],
        ];
    }

    /**
     * Komunikaty błędów.
     * @return [type] [description]
     */
    protected function validationErrorMessages()
    {
        return [
            'email.required'              => 'Email jest wymagany',
            'email.email'                 => 'To nie jest poprawny adres email',
            'password.different_password' => 'Hasło musi być inne, niż 4 ostatnie hasła',
        ];
    }
}

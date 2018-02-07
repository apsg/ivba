<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/welcome';

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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => [
                'required',
                'string',
                'min:8',
                new \App\Rules\PasswordRule,
                'confirmed',
            ],
            'g-recaptcha-response' => 'required|captcha',
            'rules' => 'required',
        ],
        [
            'name' => 'Nazwa użytkownika jest wymagana',
            'email.required' => 'Wymagane jest podanie poprawnego adresu email',
            'email.unique' => 'Na podany email już zarejestrowano konto.',
            'password.min' => 'Hasło musi mieć minimum 8 znaków',
            'password' => 'Podaj prawidłowe hasło. Hasło musi składać się z minimum 8 znaków, w tym przynajmniej: 1 cyfry, 1 wielkiej litery, 1 znaku specjalnego',
            'g-recaptcha-response.required' => 'Zaznacz, czy jesteś człowiekiem',
            'rules.required' => 'Musisz zaakceptować regulamin',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        \App\Proof::createRegistered($user);

        return $user;
    }
}

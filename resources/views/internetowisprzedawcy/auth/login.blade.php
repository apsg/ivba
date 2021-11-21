@extends('layouts.login')

@section('content')
    <div class="login-logo">
        <a href="{{ url('/') }}">
            <img src="{{ asset('/images/internetowisprzedawcy/logo.png') }}" class="img-responsive" alt="">
        </a>
    </div>
    <div class="head-block py-5 text-gray font-secondary">
        <h1>Logowanie</h1>
    </div>
    <div class="w-75 ml-auto mr-auto">
        <div class="cnt-block bg-white rounded-50 p-5">
            <form class="form-outer" role="form" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <div class="mt-4 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input id="email" type="email" class="ml-auto mr-auto form-control" name="email"
                           value="{{ old('email') }}"
                           required autofocus placeholder="ADRES EMAIL" style="max-width: 600px">

                    @if ($errors->has('email'))
                        <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="mt-4 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input id="password" type="password" class="ml-auto mr-auto form-control" name="password" required
                           placeholder="HASŁO" style="max-width: 600px">
                    @if ($errors->has('password'))
                        <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="button-outer mt-4">
                    <button class="btn btn-ivba font-size-20 font-primary">
                        Zaloguj <i class="fa fa-caret-right"></i>
                    </button>
                    <br/>
                    <div class="text-left">
                        <a href="{{ url()->previous() }}" class="text-gray">
                            <i class="fa fa-caret-left"></i> Wróć
                        </a>
                    </div>
                    <br/>
                    <a href="{{ route('password.request') }}" class="forgot text-secondary mt-3 text-gray">
                        Zapomniane hasło? Kliknij tutaj
                    </a>
                </div>
            </form>
        </div>

        <a href="{{ url('/register') }}"
           class="btn btn-outline-secondary register mt-5">
            Nie masz konta? Zobacz korzyści z posiadania
        </a>
    </div>
@endsection

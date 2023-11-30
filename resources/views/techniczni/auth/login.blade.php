@extends('layouts.login')

@section('content')
    <div class="login-logo">
        <a href="{{ url('/') }}">
            <img src="{{ url('/images/techniczni/logo_glowne.svg') }}"
                 class="img-responsive" alt="">
        </a>
    </div>
    <div class="head-block my-3">
        <h3>Logowanie</h3>
    </div>
    <div class="cnt-block">

        <form class="form-outer" role="form" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                       required autofocus placeholder="adres email" style="min-width: 300px">

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <input id="password" type="password" class="form-control" name="password" required
                       placeholder="hasło">
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="button-outer">
                <button class="btn btn-green px-4 py-2">Zaloguj</button>
                <br/>
                <a href="{{ route('password.request') }}" class="forgot text-secondary"><i
                            class="fa fa-question-circle-o"></i> Zapomniane hasło?
                </a>
                <hr/>
                <div class="or hidden-xs">Nie masz konta?</div>
                <a href="{{ url('/register') }}" class="btn btn-green-outline register px-4 py-2">
                    Zarejestruj
                </a>
            </div>
        </form>
    </div>

@endsection

@extends('layouts.login')

@section('content')
    <div>
        <h2 class="text-center pb-5" style="text-transform: none; font-weight: lighter; font-size: 2rem;">
            Wybierz miejsce logowania
        </h2>
        <div class="d-flex justify-content-between align-middle">
            <div>
                <img src="{{ asset('/images/internetowisprzedawcy/logo.png') }}" />
            </div>
            <div class="mb-5">
                <a class="btn btn-p30-red btn-lg p-3"
                   style="border-radius: 7px; box-shadow: 0px 10px 30px #E7323B48;"
                   href="https://internetowisprzedawcy.pl">
                    Dowiedz się więcej
                    <i class="fa fa-search ml-3"></i>
                </a>
            </div>
        </div>
        <div class="text-left">
            <p style="font-size: 16px;"><span style="color:#00A9A7">✓</span> Pełny dostęp do zaawansowanych <a href="https://internetowisprzedawcy.pl/courses">kursów z E-commerce</a></p>
            <p style="font-size: 16px;"><span style="color:#00A9A7">✓</span> Dedykowane miejsce na bieżące aktualności i porady o sprzedaży w Internecie</p>
            <p style="font-size: 16px;"><span style="color:#00A9A7">✓</span> Ćwiczenia, schematy i cykliczne raporty z postępów w wdrażaniu rozwiązań</p>
            <p style="font-size: 16px;"><span style="color:#00A9A7">✓</span> Dedykowane forum integrujące społeczność Internetowych sprzedawców</p>
        </div>

    </div>

    <hr class="my-5"/>

    <div class="login-logo"><a href="{{ url('/') }}"><img src="{{ asset('/images/projekt30/p30-logo.png') }}"
                                                          class="img-responsive" alt=""></a></div>
    <div class="head-block my-3">
        <h1>LOGOWANIE</h1>
    </div>
    <div class="cnt-block">

        <form class="form-outer" role="form" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                       required autofocus placeholder="adres email">

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
                <button class="btn btn-ivba">Zaloguj <span class="icon-more-icon"></span></button>
                <br/>
                <a href="{{ route('password.request') }}" class="forgot text-secondary"><i
                            class="fa fa-question-circle-o"></i> Zapomniane hasło?
                </a>
                <hr/>
                <div class="or hidden-xs">Nie masz konta?</div>
                <a href="{{ url('/register') }}" class="btn btn-secondary register">Zarejestruj <span
                            class="icon-more-icon"></span></a>
            </div>
        </form>
    </div>

@endsection

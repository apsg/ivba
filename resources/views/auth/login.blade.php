@extends('layouts.login')

@section('content')
                <div class="login-logo"><a href="{{ url('/') }}"><img src="{{ url('/images/v2/inauka.png') }}"
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
                            <br />
                            <a href="{{ route('password.request') }}" class="forgot text-secondary"><i class="fa fa-question-circle-o"></i> Zapomniane hasło?
                            </a>
                            <hr />
                            <div class="or hidden-xs">Nie masz konta?</div>
                            <a href="{{ url('/register') }}" class="btn btn-primary register">Zarejestruj <span
                                        class="icon-more-icon"></span></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection

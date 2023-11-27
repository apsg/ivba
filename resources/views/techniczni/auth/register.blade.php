@extends('layouts.login')

@section('content')
    <form id="formularz" class="form-signin" role="form" method="POST" action="{{ route('register') }}">

        <a class="mb-4 logo" href="{{ url('/') }}">
            <img src="{{ url('/images/techniczni/logo_glowne.svg') }}"
                 class="img-responsive" alt="">
        </a>
        <h1 class="h3 mb-3 font-weight-normal">Zarejestruj nowe konto</h1>
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="control-label">Nazwa użytkownika</label>

            <div class="col-md-12">
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"
                       required autofocus>

                @if ($errors->has('name'))
                    <span class="help-block">
                            <strong class="text-danger">{{ $errors->first('name') }}</strong>
                        </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="control-label">Adres email</label>

            <div class="col-md-12">
                <input id="email" type="email" class="form-control" name="email"
                       value="{{ old('email') }}" required>

                @if ($errors->has('email'))
                    <span class="help-block">
                            <strong class="text-danger">{{ $errors->first('email') }}</strong>
                        </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <div class="alert alert-info">
                Dbamy o bezpieczeństwo Twoich danych hasło powinno zawierać: 1 dużą literę, 1 cyfrę, 1 znak
                specjalny i składać się z minimum 8 znaków.
            </div>
            <label for="password" class="control-label">Hasło</label>

            <div class="col-md-12">


                <input id="password" type="password" class="form-control" name="password" required>

                @if ($errors->has('password'))
                    <span class="help-block">
                            <strong class="text-danger">{{ $errors->first('password') }}</strong>
                        </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="password-confirm" class="control-label">Powtórz hasło</label>

            <div class="col-md-12">
                <input id="password-confirm" type="password" class="form-control"
                       name="password_confirmation" required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12 pl-5">
                {!! NoCaptcha::display() !!}
            </div>

            <div class="button-outer col-md-12">
                <input type="checkbox" name="rules" id="regulamin" style="width:auto; height: auto;">
                <label for="regulamin">Akceptuję <a target="_blank" href="{{ url('regulamin') }}">Regulamin
                        strony {{ config('app.name') }}</a></label>
                @if ($errors->has('rules'))
                    <span class="help-block">
                            <strong class="text-danger">{{ $errors->first('rules') }}</strong>
                        </span>
                @endif
                <br/>
                <button id="register" class="btn btn-ivba">Zarejestruj mnie <span
                            class="icon-more-icon"></span></button>
            </div>
        </div>
    </form>

@endsection

@push('scripts')
    {!! NoCaptcha::renderJs() !!}

    <script type="text/javascript">
        $(document).ready(function () {
            console.log('działam');

            $("#register").click(function (e) {
                console.log('click');
                if (!document.getElementById('regulamin').checked) {
                    e.preventDefault();
                    alert('Musisz zaakceptować regulamin, by zarejestrować się na tej stronie.');
                }
            });

            $("#formularz").submit(function (e) {

                if (!document.getElementById('regulamin').checked) {
                    e.preventDefault();
                    alert('Musisz zaakceptować regulamin, by zarejestrować się na tej stronie.');
                }
            });
        });
    </script>

@endpush

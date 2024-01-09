@extends('layouts.login')

@section('content')
    <!-- Start Register -->
    <section class="login-wrapper register">
        <div class="inner">
            <div class="regiter-inner">
                <div class="login-logo"><a class="mb-4 logo" href="{{ url('/') }}">
                        <img src="{{ url('/images/techniczni/logo_glowne.svg') }}" class="img-responsive" alt="">
                    </a></div>
                <div class="head-block">
                    <h1>Wyślij email z nowym hasłem</h1>
                </div>
                <div class="cnt-block">
                    @if ($errors->any())
                        <section>
                            <div class=" alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </section>
                    @endif
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Adres E-Mail</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" name="email"
                                       value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-ivba">
                                    Wyślij link resetu hasła
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection

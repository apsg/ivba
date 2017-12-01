@extends('layouts.login')

@section('content')

<!-- Start Register -->
<section class="login-wrapper register">
  <div class="inner">
    <div class="regiter-inner">
      <div class="login-logo"> <a href="{{ url('/') }}"><img src="images/logo.png" class="img-responsive" alt=""></a> </div>
      <div class="head-block">
        <h1>Zarejestruj nowe konto</h1>
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
        <form id="formularz" class="form-outer" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">Nazwa użytkownika</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">Adres email</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">Hasło</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="password-confirm" class="col-md-4 control-label">Powtórz hasło</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    {!! app('captcha')->display() !!}
                </div>
              
                <div class="button-outer col-md-6">
                    <input type="checkbox" name="rules" id="regulamin" >
                    <label for="regulamin">Akceptuję <a target="_blank" href="{{ url('regulamin') }}">Regulamin strony iExcel.pl</a></label>
                    @if ($errors->has('rules'))
                        <span class="help-block">
                            <strong>{{ $errors->first('rules') }}</strong>
                        </span>
                    @endif
                    <button id="register" class="btn btn-primary">Zarejestruj mnie <span class="icon-more-icon"></span></button>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</section>

@endsection

@push('scripts')

<script type="text/javascript">
    $(document).ready(function(){
        console.log('działam');

        $("#register").click(function(e){
            console.log('click');
            if( ! document.getElementById('regulamin').checked ){
                e.preventDefault();
                alert('Musisz zaakceptować regulamin, by zarejestrować się na tej stronie.');
            }
        });

        $("#formularz").submit(function(e){

            if( ! document.getElementById('regulamin').checked ){
                e.preventDefault();
                alert('Musisz zaakceptować regulamin, by zarejestrować się na tej stronie.');
            }
        });
    });
</script>

@endpush
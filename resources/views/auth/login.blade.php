@extends('layouts.login')

@section('content')


<!-- Start Login -->
<section class="login-wrapper">
  <div class="inner">
    <div class="login">
      <div class="login-logo"> <a href="{{ url('/') }}"><img src="{{ url('/images/iVBA_minilogo.png') }}" class="img-responsive" alt=""></a> </div>
      <div class="head-block">
        <h1>LOGOWANIE</h1>
      </div>
      <div class="cnt-block">
            
        <form class="form-outer" role="form" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="adres email">

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <input id="password" type="password" class="form-control" name="password" required placeholder="hasło">
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

          <div class="button-outer">
            <button class="btn btn-success">Zaloguj <span class="icon-more-icon"></span></button>
            <div class="or hidden-xs">lub</div>
            <a href="{{ url('/register') }}" class="btn btn-primary register">Zarejestruj <span class="icon-more-icon"></span></a>
          </div>
          <div class="remember">
            <div class="check">
              <input type="checkbox" id="test1" />
              <label for="test1">Zapamiętaj mnie</label>
            </div>
            <a href="{{ route('password.request') }}" class="forgot"><span>?</span>Zapomniane hasło? </a> </div>
        </form>
      </div>
      {{-- <div class="login-footer">
        <ul class="follow-us clearfix">
          <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
          <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
          <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
          <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
          <li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
          <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
        </ul>
      </div> --}}
    </div>
  </div>
</section>

@endsection

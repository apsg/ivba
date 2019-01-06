<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') {{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <header class="header mb-3">
        <nav class="navbar navbar-expand-sm navbar-orange bg-orange">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('images/v2/inauka.png') }}">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-inauka"
                        aria-controls="navbar-inauka" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars fa-2x text-white"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbar-inauka">
                    <ul class="nav navbar-nav ml-auto">

                        @foreach($menu as $item)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url($item->url) }}"
                                   @if($item->is_new_window) target="_blank" @endif>{{ $item->title }}</a>
                            </li>
                        @endforeach


                    <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}"><i class="fa fa-sign-in"></i>
                                    Zaloguj</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}"><i class="fa fa-wpforms"></i>
                                    Zarejestruj</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="dropdown"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-user"></i> {{ Auth::user()->name }}</a>
                                <div class="dropdown-menu" aria-labelledby="dropdown">
                                    <a href="{{ url('account') }}" class="dropdown-item"><i class="fa fa-user"></i> Moje
                                        konto</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out"></i>
                                        Wyloguj
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </a>
                                </div>
                            </li>

                            @if(Auth::user()->isadmin)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/admin')}}"><i class="fa fa-cogs"></i>
                                        Administracja</a>
                                </li>
                            @endif

                            @include('partials.cart_link')

                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        @if(Request::is('/'))
            <div class="container pb-3 promo">
                <h1 class="mt-5 mb-5">Czego się dziś nauczysz?</h1>
            </div>
            <categories></categories>
        @endif
    </header>
    <div class="container">
        @include('flash::message')
        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    @yield('content')

    <footer class="pt-3 pb-3 mt-3 text-white">
        <div class="container py-3">
            <div class="row">
                <div class="col-md-12 text-center">
                    <a href="#">
                        <img src="{{ asset('/images/v2/f_ikona.png') }}"/>
                    </a>
                    <a href="#">
                        <img src="{{ asset('/images/v2/twitter_ikona_stopka.png') }}"/>
                    </a>
                    <a href="#">
                        <img src="{{ asset('/images/v2/google+_ikona.png') }}"/>
                    </a>
                </div>
            </div>
        </div>
        <div class="container py-3 ">
            <div class="row">
                <div class="col-md-4">
                    <a href="{{url('/')}}" class="py-3">
                        <img src="{{ asset('/images/v2/logo_stopka.png') }}">
                    </a>

                    <p>&copy; {{ Carbon\Carbon::now()->year }} ITBT</p>
                </div>
                <div class="col-md-8">
                    <div class="row mb-3">
                        <div class="col-md-3 text-right">
                            <h3 class="footer-header">Informacje</h3>
                        </div>
                        <div class="col-md-9 footer-menu">
                            {!! App\MenuItem::make(2, 'asc') !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 text-right">
                            <h3 class="footer-header">Wsparcie</h3>
                        </div>
                        <div class="col-md-9 footer-menu">
                            {!! App\MenuItem::make(3, 'asc') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>

@stack('modals')

@include('partials.show_proof')
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript">
    window.baseUrl = '{{ url('/') }}';
</script>
{!! NoCaptcha::renderJs() !!}
@foreach(\App\Script::all() as $script)
    {!! $script->script !!}
@endforeach

@stack('scripts')
</body>
</html>

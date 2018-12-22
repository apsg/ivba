<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <header class="header">
        <nav class="navbar navbar-expand-lg navbar-orange bg-orange">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('images/v2/inauka.png') }}">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-inauka"
                        aria-controls="navbar-inauka" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
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
                                <a class="nav-link" href="{{ route('login') }}">Zaloguj</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Zarejestruj</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="dropdown"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-user"></i> {{ Auth::user()->name }}</a>
                                <div class="dropdown-menu" aria-labelledby="dropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Wyloguj
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </a>
                                </div>
                            </li>

                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        @if(Request::is('/'))
            <div class="container pb-3 promo">
                <h1>Czego się dziś nauczysz?</h1>
            </div>
        @endif
    </header>

    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

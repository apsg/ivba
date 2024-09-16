<!doctype html>
<html lang="pl" data-bs-theme="auto">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') {{ config('app.name', 'Laravel') }}</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/carousel/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Sora:wght@100..800&display=swap"
          rel="stylesheet">

    <!-- Favicons -->
    <meta name="theme-color" content="#712cf9">
    <link href="{{ multisite_css() }}" rel="stylesheet">

</head>
<body>
<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
    <symbol id="check2" viewBox="0 0 16 16">
        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
    </symbol>
    <symbol id="circle-half" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
    </symbol>
    <symbol id="moon-stars-fill" viewBox="0 0 16 16">
        <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
        <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
    </symbol>
    <symbol id="sun-fill" viewBox="0 0 16 16">
        <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
    </symbol>
</svg>

<div id="app">
    <overlay :news="{{ json_encode($news) }}"></overlay>
    <header data-bs-theme="dark">
        <div class="">
            @include('layouts._cta')

            <nav class="navbar navbar-expand-md navbar-dark bg-dark color-white">
                <div class="container">
                    <a class="navbar-brand subtitle-2" style="font-weight: 900"
                       href="{{ url('/') }}">
                        <img src="{{ url('/images/inauka2/logo.svg') }}" height="60"/>
                        iNauka.pl
                    </a>

                    <div class="d-flex align-items-center account-menu">

                        <div class="collapse navbar-collapse" id="navbarCollapse">
                            <div>&nbsp;</div>
                            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                                @foreach($menu as $item)
                                    @if($item->url != '/buy_access'
                                    || Auth::guest()
                                    || !Auth::user()->hasFullAccess()
                                    || !Auth::user()->hasActiveSubscription())
                                        @if($item->isDropdown())
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                                                   role="button"
                                                   data-bs-toggle="dropdown" aria-expanded="false">
                                                    {{ $item->title }}
                                                </a>
                                                <ul class="dropdown-menu mb-3" aria-labelledby="navbarDropdown">
                                                    @foreach($item->children as $child)
                                                        <li>
                                                            <a
                                                                    class="dropdown-item"
                                                                    href="{{ url($child->url) }}">                                                        {{ $child->title }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @else
                                            <li class="nav-item">
                                                <a
                                                        class="nav-link" aria-current="page"
                                                        href="{{ url($item->url) }}"
                                                        @if($item->is_new_window) target="_blank" @endif

                                                >
                                                    {{ $item->title }}
                                                </a>
                                            </li>
                                        @endif
                                    @endif
                                @endforeach
                                @guest()
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">Zaloguj</a>
                                    </li>
                                    <li class="nav-item">
                                        <div class="d-flex align-items-center">
                                            <i class="icon-arrow-right white mx-2 mx-md-0"></i>
                                            <a class="nav-link" href="{{ route('register') }}">Zarejestruj</a>
                                        </div>
                                    </li>
                                @endguest
                            </ul>
                        </div>
                        @auth
                            <div class="dropdown dropdown-account">
                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown"
                                        aria-expanded="false"
                                        style="max-width: 200px;"
                                >
                                    <img
                                            style="border-radius: 50%"
                                            src="{{ "https://www.gravatar.com/avatar/" . hash( "sha256", strtolower( trim( Auth::user()->email ) ) ) . "?d=" . urlencode( url('/images/inauka2/account.svg') ) . "&s=40" }}"/>
                                    {{ Auth::user()->name }}
                                    @if(Auth::user()->points_total > 0)
                                        <div class="points-nav px-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10.667" height="14.278"
                                                 viewBox="0 0 10.667 14.278">
                                                <path id="Shape"
                                                      d="M5.333,14.278A5.339,5.339,0,0,1,0,8.945,9.21,9.21,0,0,1,2.154,3.019l-.021.24a2.428,2.428,0,0,0,2.42,2.486A2.308,2.308,0,0,0,6.826,3.259c0-.542-1.348-1.2-2.538-1.773C3.291,1,2.428.582,2.491.31,2.539.1,3.151,0,4.364,0c.531,0,1.194.02,1.969.058a11.36,11.36,0,0,1,4.334,8.887A5.339,5.339,0,0,1,5.333,14.278ZM7.947,6.385a5.1,5.1,0,0,1-3.081,1.72,2.076,2.076,0,0,0-1.873,2.08A2.123,2.123,0,0,0,5.14,12.279a3.2,3.2,0,0,0,3.2-3.2A9.288,9.288,0,0,0,7.947,6.385Z"
                                                      fill="#ff6841"/>
                                            </svg>

                                            {{ Auth::user()->points_total }}
                                        </div>
                                    @endif

                                    <img src="{{ url('/images/inauka2/down.svg') }}"/>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('account.show') }}">Konto</a></li>
                                    <li><a class="dropdown-item" href="{{ route('account.mycourses') }}">Moje kursy</a>
                                    </li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="post">
                                            @csrf
                                            <button type="submit" class="dropdown-item">
                                                Wyloguj
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                            <a href="#" class="px-3" onclick="document.getElementById('overlay').classList.remove('hidden')">
                                <img src="{{ url('/images/inauka2/bell.svg') }}"/>
                            </a>
                        @endauth

                        <button class="navbar-toggler color-red"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#navbarCollapse"
                                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                                 fill="currentColor">
                                <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')

        <!-- FOOTER -->
        <footer class="container">
            <p class="float-end"><a href="#">Back to top</a></p>
            <p>&copy; 2017–2024 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
        </footer>
    </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
<script src="{{ multisite_js() }}"></script>
<script type="text/javascript" src="https://embed.cloudflarestream.com/embed/sdk.latest.js"></script>
<script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>

</body>
</html>

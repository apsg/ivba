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
                        <img src="{{ url('/images/inauka2/logo_bialy.svg') }}" height="60"/>
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
                            <a href="#" class="px-3"
                               onclick="document.getElementById('overlay').classList.remove('hidden')">
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

    <main class="bg-white">
        @yield('content')

        <!-- FOOTER -->
        <footer class="text-center text-lg-start p-5 bg-graphite">
            <section class="">
                <div class="container text-start mt-5">
                    <!-- Grid row -->
                    <div class="row mt-3">
                        <!-- Grid column -->
                        <div class="col-md-5 col-lg-4 col-xl-3 mx-auto mb-4">
                            <!-- Content -->
                            <h6 class="text-uppercase fw-bold mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     width="276" height="80" viewBox="0 0 276 80">
                                    <defs>
                                        <clipPath id="clip-path">
                                            <rect id="Rectangle_640" data-name="Rectangle 640" width="246.381"
                                                  height="68.934" fill="none"/>
                                        </clipPath>
                                    </defs>
                                    <g id="Group_805" data-name="Group 805" transform="translate(-194 -8663)">
                                        <rect id="Rectangle_641" data-name="Rectangle 641" width="276" height="80"
                                              transform="translate(194 8663)" fill="none"/>
                                        <g id="Group_804" data-name="Group 804" transform="translate(209 8669)">
                                            <path id="Path_4417" data-name="Path 4417"
                                                  d="M83,0,66.2,6.713,49.8.14V7.809L66.2,14.382,83,7.641Z"
                                                  transform="translate(-35.81)" fill="#fff"/>
                                            <path id="Path_4418" data-name="Path 4418"
                                                  d="M39.692,46.8l14.579-5.815.084,11.658.14,21.152L30.281,83.482,7.3,74.3,7.191,59.774l-.056-7.5L7.051,41.29,20.843,46.8l9.439,3.764ZM54.243,33.481,30.31,43.032l-23.287-9.3L0,30.925l.056,7.556L.281,71.488l.056,7.556L7.36,81.853l13.511,5.393L30.31,91.01l9.41-3.764,14.86-5.927,6.966-2.781-.056-7.5L61.265,38.2l-.056-7.5Z"
                                                  transform="translate(0 -22.076)" fill="#fff"/>
                                            <path id="Path_4419" data-name="Path 4419"
                                                  d="M103.388,128.6l-7.95,4.747L88.5,137.537V119.7Z"
                                                  transform="translate(-63.64 -86.076)" fill="#fff"/>
                                            <g id="Group_803" data-name="Group 803" transform="translate(0 0)">
                                                <g id="Group_802" data-name="Group 802" clip-path="url(#clip-path)">
                                                    <path id="Path_4420" data-name="Path 4420"
                                                          d="M297.33,78.768A3.049,3.049,0,1,0,297.3,72.7a3.114,3.114,0,0,0-2.416.843,3.445,3.445,0,0,0,0,4.382,3.223,3.223,0,0,0,2.444.843"
                                                          transform="translate(-211.486 -52.278)" fill="#fff"/>
                                                    <path id="Path_4421" data-name="Path 4421"
                                                          d="M288.4,99.5v4.438h2.332v14.045h6.1V99.5H288.4Z"
                                                          transform="translate(-207.387 -71.55)" fill="#fff"/>
                                                    <path id="Path_4422" data-name="Path 4422"
                                                          d="M354.121,97.867h-.478L345.5,78.4H335.3v24.411h5.759V83.344h.506l8.118,19.467h10.281V78.4h-5.843Z"
                                                          transform="translate(-241.113 -56.377)" fill="#fff"/>
                                                    <path id="Path_4423" data-name="Path 4423"
                                                          d="M448.231,99.143A12.4,12.4,0,0,0,443.4,98.3c-.674,0-1.4,0-2.191.028s-1.545.056-2.3.112c-.73.056-1.376.084-1.91.14v5.084c.758-.056,1.6-.084,2.5-.14.927-.056,1.8-.084,2.612-.112s1.461-.028,1.882-.028a2.44,2.44,0,0,1,1.91.618,2.631,2.631,0,0,1,.59,1.826h-2.921a15.165,15.165,0,0,0-4.438.59A6.377,6.377,0,0,0,436.1,108.3a5.017,5.017,0,0,0-1.1,3.371,5.819,5.819,0,0,0,.843,3.174,5.555,5.555,0,0,0,2.359,2.023,8,8,0,0,0,3.455.7,6.738,6.738,0,0,0,3.258-.7,5.327,5.327,0,0,0,2.079-2.023,7.46,7.46,0,0,0,.506-1.18v3.455h4.8V105.913a7.547,7.547,0,0,0-1.067-4.242,6.234,6.234,0,0,0-3.006-2.528m-2.191,13.09a2.414,2.414,0,0,1-1.011.983,3.346,3.346,0,0,1-1.433.281,2.7,2.7,0,0,1-1.91-.618,2.34,2.34,0,0,1,0-3.287,2.652,2.652,0,0,1,1.91-.618h2.921v1.292a4.911,4.911,0,0,1-.478,1.966"
                                                          transform="translate(-312.807 -70.687)" fill="#fff"/>
                                                    <path id="Path_4424" data-name="Path 4424"
                                                          d="M521.445,110.387a2.824,2.824,0,0,1-.758,2.079,2.712,2.712,0,0,1-1.995.758,2.6,2.6,0,0,1-1.966-.758,2.81,2.81,0,0,1-.73-1.994V99.6h-6.1v10.7c0,2.837.562,4.944,1.713,6.292a5.989,5.989,0,0,0,4.86,2.051h.281a6.417,6.417,0,0,0,3.483-.9,5.513,5.513,0,0,0,2.135-2.753c.14-.393.281-.843.393-1.292v4.354h4.8V99.6h-6.124Z"
                                                          transform="translate(-366.667 -71.622)" fill="#fff"/>
                                                    <path id="Path_4425" data-name="Path 4425"
                                                          d="M607.364,84.327h-6.349l-6.32,8.624V78.4h-6.1v24.411h6.1V94.187h1.573l5.45,8.624h6.77l-6.966-10.59Z"
                                                          transform="translate(-423.26 -56.377)" fill="#fff"/>
                                                    <path id="Path_4426" data-name="Path 4426"
                                                          d="M674.33,99.143A12.4,12.4,0,0,0,669.5,98.3c-.674,0-1.4,0-2.191.028s-1.545.056-2.3.112c-.73.056-1.376.084-1.91.14v5.084c.759-.056,1.6-.084,2.5-.14.927-.056,1.8-.084,2.613-.112s1.461-.028,1.882-.028A2.44,2.44,0,0,1,672,104a2.631,2.631,0,0,1,.59,1.826h-2.922a15.164,15.164,0,0,0-4.438.59A6.378,6.378,0,0,0,662.2,108.3a5.017,5.017,0,0,0-1.1,3.371,5.82,5.82,0,0,0,.843,3.174,5.556,5.556,0,0,0,2.36,2.023,8,8,0,0,0,3.455.7,6.739,6.739,0,0,0,3.258-.7,5.327,5.327,0,0,0,2.079-2.023,7.471,7.471,0,0,0,.506-1.18v3.455h4.8V105.913a7.546,7.546,0,0,0-1.068-4.242,6.108,6.108,0,0,0-3.006-2.528m-2.191,13.09a2.415,2.415,0,0,1-1.011.983,3.347,3.347,0,0,1-1.433.281,2.7,2.7,0,0,1-1.91-.618,2.34,2.34,0,0,1,0-3.287,2.652,2.652,0,0,1,1.91-.618h2.921v1.292a4.484,4.484,0,0,1-.478,1.966"
                                                          transform="translate(-475.394 -70.687)" fill="#fff"/>
                                                    <rect id="Rectangle_639" data-name="Rectangle 639" width="6.545"
                                                          height="6.629" transform="translate(206.24 39.804)"
                                                          fill="#fff"/>
                                                    <path id="Path_4427" data-name="Path 4427"
                                                          d="M788.262,100.312a7.491,7.491,0,0,0-2.64-1.938,8.521,8.521,0,0,0-3.455-.674,7.75,7.75,0,0,0-3.9.983,7.088,7.088,0,0,0-2.7,2.893,9.687,9.687,0,0,0-.562,1.348V98.234h-4.8V123.4h6.1v-8.82a5.88,5.88,0,0,0,2.135,1.854,8.2,8.2,0,0,0,3.792.843,8.427,8.427,0,0,0,3.568-.7,7.06,7.06,0,0,0,2.612-1.994,9.078,9.078,0,0,0,1.6-3.006,12.439,12.439,0,0,0,.534-3.764V107a11.329,11.329,0,0,0-.59-3.736,8.984,8.984,0,0,0-1.685-2.949m-4.326,9.607a3.931,3.931,0,0,1-1.433,1.714,3.668,3.668,0,0,1-2.135.618,4.5,4.5,0,0,1-1.966-.478,4.044,4.044,0,0,1-1.6-1.4,3.83,3.83,0,0,1-.646-2.219v-1.124a4.355,4.355,0,0,1,.59-2.332,4.047,4.047,0,0,1,1.545-1.461,4.264,4.264,0,0,1,2.051-.506,3.8,3.8,0,0,1,2.135.59,4.274,4.274,0,0,1,1.433,1.629,5.754,5.754,0,0,1,.506,2.5,5.481,5.481,0,0,1-.477,2.472"
                                                          transform="translate(-553.848 -70.256)" fill="#fff"/>
                                                    <path id="Path_4428" data-name="Path 4428"
                                                          d="M850.179,78.4H848.1v4.41h2.079v20h6.068V78.4Z"
                                                          transform="translate(-609.865 -56.377)" fill="#fff"/>
                                                </g>
                                            </g>
                                        </g>
                                    </g>
                                </svg>

                            </h6>
                            <p class="h6-headline text-white">
                                © 2024 ITBT
                            </p>
                            <p class="h6-headline text-white">
                                kontakt: hello@inauka.pl
                            </p>
                            <div class="d-flex flex-row gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     width="40" height="40" viewBox="0 0 40 40">
                                    <defs>
                                        <clipPath id="clip-path">
                                            <rect id="Rectangle_642" data-name="Rectangle 642" width="40" height="40"
                                                  fill="#fafafa"/>
                                        </clipPath>
                                    </defs>
                                    <g id="Group_806" data-name="Group 806" clip-path="url(#clip-path)">
                                        <path id="Path_4429" data-name="Path 4429"
                                              d="M19.974,0A19.974,19.974,0,1,0,39.948,19.974,19.974,19.974,0,0,0,19.974,0M30.087,18.131a9.874,9.874,0,0,1-5.774-1.853L24.3,24.2a7.214,7.214,0,1,1-6.256-7.156V20.93A3.406,3.406,0,1,0,20.486,24.2V8.531h4a5.6,5.6,0,0,0,5.6,5.6h0Z"
                                              transform="translate(0 0.052)" fill="#fafafa"/>
                                    </g>
                                </svg>

                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     width="40" height="40" viewBox="0 0 40 40">
                                    <defs>
                                        <clipPath id="clip-path">
                                            <rect id="Rectangle_643" data-name="Rectangle 643" width="40" height="40"
                                                  transform="translate(-0.36 -0.36)" fill="#f7f7f7"/>
                                        </clipPath>
                                    </defs>
                                    <g id="Group_808" data-name="Group 808" transform="translate(0.36 0.36)"
                                       clip-path="url(#clip-path)">
                                        <path id="Path_4430" data-name="Path 4430"
                                              d="M19.64,0a19.64,19.64,0,1,0,19.64,19.64A19.64,19.64,0,0,0,19.64,0m5.186,11.771a9.89,9.89,0,0,0-2.8.134c-1.309.483-1.34,1.614-1.34,2.692v2.2h4L24.1,21.009H20.685V31.4H16.166v-10.4H12.409V16.8h3.757V13.227A5.105,5.105,0,0,1,20.813,7.91a15.949,15.949,0,0,1,4.013.329Z"
                                              fill="#f7f7f7"/>
                                    </g>
                                </svg>

                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     width="40" height="40" viewBox="0 0 40 40">
                                    <defs>
                                        <clipPath id="clip-path">
                                            <rect id="Rectangle_644" data-name="Rectangle 644" width="40" height="40"
                                                  fill="#fafafa"/>
                                        </clipPath>
                                    </defs>
                                    <g id="Group_810" data-name="Group 810" clip-path="url(#clip-path)">
                                        <path id="Path_4431" data-name="Path 4431"
                                              d="M160.59,147.525h-9.181a3.884,3.884,0,0,0-3.884,3.884h0v9.181a3.884,3.884,0,0,0,3.884,3.884h9.181a3.884,3.884,0,0,0,3.884-3.884v-9.181a3.884,3.884,0,0,0-3.884-3.884ZM156,161.343A5.343,5.343,0,1,1,161.343,156,5.343,5.343,0,0,1,156,161.343m5.566-9.595a1.271,1.271,0,1,1,1.271-1.271h0a1.271,1.271,0,0,1-1.271,1.271"
                                              transform="translate(-136 -136)" fill="#fafafa"/>
                                        <path id="Path_4432" data-name="Path 4432"
                                              d="M215.018,211.545a3.473,3.473,0,1,0,3.473,3.473,3.473,3.473,0,0,0-3.473-3.473"
                                              transform="translate(-195.018 -195.018)" fill="#fafafa"/>
                                        <path id="Path_4433" data-name="Path 4433"
                                              d="M20,0A20,20,0,1,0,40,20,20,20,0,0,0,20,0M30.417,24.414a6,6,0,0,1-6,6H15.586a6,6,0,0,1-6-6V15.586a6,6,0,0,1,6-6h8.828a6,6,0,0,1,6,6Z"
                                              fill="#fafafa"/>
                                    </g>
                                </svg>

                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     width="40" height="40" viewBox="0 0 40 40">
                                    <defs>
                                        <clipPath id="clip-path">
                                            <rect id="Rectangle_645" data-name="Rectangle 645" width="40" height="40"
                                                  fill="#fafafa"/>
                                        </clipPath>
                                    </defs>
                                    <g id="Group_812" data-name="Group 812" clip-path="url(#clip-path)">
                                        <path id="Path_4434" data-name="Path 4434"
                                              d="M20,0A20,20,0,1,0,40,20,20,20,0,0,0,20,0M13.6,29.9V10.1L31.088,20.168Z"
                                              fill="#fafafa"/>
                                    </g>
                                </svg>
                            </div>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                            <!-- Links -->
                            <h6 class="color-red h6-headline">
                                Informacje
                            </h6>
                            <div class="d-flex flex-column footer-menu gap-2">
                                {!! \App\Helpers\MenuHelper::make(2) !!} }}
                            </div>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-4 col-lg-3 col-xl-4 mx-auto mb-md-0 mb-4">
                            <!-- Links -->
                            <h6 class="color-red h6-headline">
                                Wsparcie
                            </h6>
                            <div class="d-flex flex-column footer-menu gap-2">
                                {!! \App\Helpers\MenuHelper::make(3) !!}
                            </div>
                        </div>
                        <!-- Grid column -->
                    </div>
                    <!-- Grid row -->
                </div>
            </section>

            <div class="container mt-5">
                <div class="px-md-5 h6-headline" style="color: #FFFFFF80">
                    IT&Business Training Mateusz Grabowski <br>
                    ul. Zygmunta Starego 1/3, 44-100 Gliwice | NIP: 6312273946 | REGON: 240829920
                </div>
            </div>
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

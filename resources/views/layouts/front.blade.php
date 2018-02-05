<!DOCTYPE html>
<html lang="pl">
<head>
    <title>@yield('title') iVBA - kurs VBA on-line</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no"/>
    <link rel="stylesheet" type="text/css" href="{{ url('/css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/css/front.css') }}">

    <link rel="icon" href="{{ url('images/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ url('css/grid.css') }}">
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <link rel="stylesheet" href="{{ url('css/mailform.css') }}"/>
    <link rel="stylesheet" href="{{ url('css/jquery.fancybox.css') }}"/>


<!-- Bootstrap -->
{{-- <link href="{{ url('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"> --}}
<!-- Select2 -->
{{-- <link href="{{ url('assets/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css"> --}}
<!-- Font Awesome -->
<link href="{{ url('assets/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
<!-- Magnific Popup -->
{{-- <link href="{{ url('assets/magnific-popup/css/magnific-popup.css') }}" rel="stylesheet" type="text/css"> --}}
<!-- Iconmoon -->
<link href="{{ url('assets/iconmoon/css/iconmoon.css') }}" rel="stylesheet" type="text/css">
<!-- Owl Carousel -->
{{-- <link href="{{ url('assets/owl-carousel/css/owl.carousel.min.css') }}" rel="stylesheet" type="text/css"> --}}

</head>
<body>
<div class="page">
    <!--========================================================
                              HEADER
    =========================================================-->

    <div class="nav-front" >
        <div class=" container">
            <div class="pull-right">
            @auth
                @if(Gate::allows('admin'))
                    <a class="btn btn-basic btn-sm" href="{{ url('admin') }}">Zaplecze administracyjne</a>
                @endif

                <a class="btn-sm btn-basic btn" href="{{ url('account') }}">Twoje konto</a>

                <a class="btn btn-basic btn-sm" href="{{ url('cart') }}"><i class="fa fa-cart"></i> Koszyk</a>
    
                <form style="display: inline-block;" action="{{ url('logout') }}" method="post">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-basic btn-sm">Wyloguj</button>
                </form>
            @else
                <a class="btn btn-basic btn-sm" href="{{ url('/register') }}">Zarejestruj się</a>

                <a class="btn btn-basic btn-sm" href="{{ url('/login') }}">Zaloguj się</a>
            @endauth
            </div>
        </div>
    </div>


    @if(isset($is_front))
    <header class="page vide wow fadeIn" data-vide-bg="video/video-bg" data-wow-duration='5s'>

        <span class="overlay"> 
            <span class ="menu"> 
            </span>
        </span>

        <div class="container">
            <div class="row">
                <div class="col-md-4 col-xs-12 col-sm-6">
                    <div class="banner">
                        <a href="{{ url('/') }}"><img src="{{ url('images/iVBA_minilogo.png') }}"></a>
                    </div>
                </div>
                <div class="col-md-8 col-xs-12 col-sm-8">
                    <span class ="menu"> 
                        {!! \App\MenuItem::make(1) !!}
                    </span>
                </div>
                <div class="col-md-offset-2 col-sm-12 col-md-8 col-xs-12 ">
                    
                    <h2>Zacznij uczyć się z nami
                        VBA dla Excela.</h2>

                    <p>Gwarantujemy, że nawet nie informatyka nauczymy programować w VBA albo zwrócimy pieniądze:) </p>
                    <a class="btn-ivba" href="{{ url('/register') }}">Zapisz się</a> 
                    <p><a href="{{ url('/about') }}">Dowiedz się więcej</a> </p>
                </div>
            </div>
        </div>
    </header>
    @else
    <header class="small vide wow fadeIn" data-vide-bg="video/video-bg" data-wow-duration='5s'>
        <span class="overlay">         </span>

        <div class="container">
            <div class="row" style="margin-top: 0px !important;">
                <div class="col-sm-6 col-md-4 col-xs-12 ">
                    <div class="">
                        <a href="{{ url('/') }}"><img src="{{ url('images/iVBA_minilogo.png') }}"></a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-8 col-xs-12 ">
                    <span class ="menu"> 
                        {!! \App\MenuItem::make(1) !!}
                    </span>
                </div>

            </div>
        </div>
    </header>
    @endif
    <!--========================================================
                              CONTENT
    =========================================================-->
    <main>
        <section class="well bg-primary">
            <div class="container">
                
                @include('flash::message')

                @if ($errors->any())
                <section>
                    <div class="container alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </section>
                @endif

                @yield('content')
            </div>
        </section>
    </main>

    <!--========================================================
                              FOOTER
    =========================================================-->
    <footer class="bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 footer-menu">
                    <strong>INFORMACJE:</strong>
                    {!! \App\MenuItem::make(2) !!}
                </div>
                <div class="col-sm-12 footer-menu">
                    <strong>WSPARCIE:</strong>
                    {!! \App\MenuItem::make(3) !!}
                </div>
            </div>
            <div class="row">
                <div class=" col-sm-offset-2 col-md-offset-2 col-sm-8  col-md-8 col-xs-12 ">

                    <div class="copyright">
                        <h1><a href="./">iVBA</a></h1> © <span id="copyright-year"></span> Wszystie prawa zastrzeżone
                    </div>
                    <ul class="inline-list">
                        <li><a href="#" class="fa-facebook"></a></li>
                        <li><a href="#" class="fa-twitter"></a></li>
                        <li><a href="#" class="fa-google-plus"></a></li>
                    </ul>
                    <!-- {%FOOTER_LINK} -->
                </div>
            </div>
        </div>
    </footer>
</div>


@stack('modals')

@include('partials.show_proof')


<!-- Scroll to top --> 
<a href="#" class="scroll-top"><i class="fa fa-chevron-up" aria-hidden="true"></i></a> 

<script type="text/javascript" src="{{ url('js/app.js') }}"></script>

<!-- Select2 JS --> 
<script type="text/javascript" src="{{ url('assets/select2/js/select2.min.js') }}"></script> 
<!-- Match Height JS --> 
{{-- <script type="text/javascript" src="{{ url('assets/matchHeight/js/matchHeight-min.js') }}"></script>  --}}
<!-- Bxslider JS --> 
{{-- <script type="text/javascript" src="{{ url('assets/bxslider/js/bxslider.min.js') }}"></script>  --}}
<!-- Waypoints JS --> 
{{-- <script type="text/javascript" src="{{ url('assets/waypoints/js/waypoints.min.js') }}"></script>  --}}
<!-- Counter Up JS --> 
{{-- <script type="text/javascript" src="{{ url('assets/counterup/js/counterup.min.js') }}"></script>  --}}
<!-- Magnific Popup JS --> 
{{-- <script type="text/javascript" src="{{ url('assets/magnific-popup/js/magnific-popup.min.js') }}"></script>  --}}
<!-- Owl Carousal JS --> 
{{-- <script type="text/javascript" src="{{ url('assets/owl-carousel/js/owl.carousel.min.js') }}"></script>  --}}

<script type="text/javascript" src="{{ url('/js/script.js') }}"></script>
<script type="text/javascript" src="{{ url('/js/front.js') }}"></script>

@foreach(\App\Script::all() as $script)
    {!! $script->script !!}
@endforeach

@stack('scripts')

</body>
</html>
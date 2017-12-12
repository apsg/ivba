<!DOCTYPE html>
<html lang="pl">
<head>
    <title>@yield('title') iVBA - kurs VBA on-line</title>
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
{{-- <link href="{{ url('assets/iconmoon/css/iconmoon.css') }}" rel="stylesheet" type="text/css"> --}}
<!-- Owl Carousel -->
{{-- <link href="{{ url('assets/owl-carousel/css/owl.carousel.min.css') }}" rel="stylesheet" type="text/css"> --}}

</head>
<body>
<div class="page">
    <!--========================================================
                              HEADER
    =========================================================-->
    @if(isset($is_front))
    <header class="page vide wow fadeIn" data-vide-bg="video/video-bg" data-wow-duration='5s'>
        <span class="overlay"> 
            <span class ="menu"> 
                {!! \App\MenuItem::make(1) !!}
            </span>
        </span>

        <div class="container">
            <div class="row">
            
                <div class="  col-md-offset-2 col-sm-12 col-md-8 col-xs-12 ">
                    <div class="banner">
                        <a href="{{ url('/') }}"><img src="{{ url('images/iVBA_minilogo.png') }}"></a>
                    </div>
                    <h2>Zacznij uczyć się z nami
                        VBA dla Excela.</h2>

                    <p>Gwarantujemy, że nawet nie informatyka nauczymy programować w VBA albo zwrócimy pieniądze:) </p>
                    <a class="btn" href="#">Zapisz się</a> 
                    <p><a href="#">Dowiedz się więcej</a> </p>
                </div>
            </div>
        </div>
    </header>
    @else
    <header class="small vide wow fadeIn" data-vide-bg="video/video-bg" data-wow-duration='5s'>
        <span class="overlay"> 
            <span class ="menu"> 
                {!! \App\MenuItem::make(1) !!}
            </span>
        </span>

        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-8 col-xs-12 ">
                    <div class="">
                        <a href="{{ url('/') }}"><img src="{{ url('images/iVBA_minilogo.png') }}"></a>
                    </div>
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
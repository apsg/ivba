<!doctype html>
<html lang="pl">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0; maximum-scale=1">
<meta name="description" content="@yield('seo_description', 'iExcel - platforma do nauki Excela | Ćwieczenia z MS Excel')">
<link rel="shortcut icon" type="image/x-icon" href="{{url('images/iexcel_32x32.png')}}">
<title>@yield('title', '') | iExcel - platforma do nauki Excela | Ćwieczenia z MS Excel</title>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="{{ url('/css/app.css') }}">

<!-- Bootstrap -->
<link href="{{ url('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
<!-- Select2 -->
<link href="{{ url('assets/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css">
<!-- Font Awesome -->
<link href="{{ url('assets/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
<!-- Magnific Popup -->
<link href="{{ url('assets/magnific-popup/css/magnific-popup.css') }}" rel="stylesheet" type="text/css">
<!-- Iconmoon -->
<link href="{{ url('assets/iconmoon/css/iconmoon.css') }}" rel="stylesheet" type="text/css">
<!-- Owl Carousel -->
<link href="{{ url('assets/owl-carousel/css/owl.carousel.min.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ url('/css/front.css') }}">
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->

    <link rel="icon" href="{{ url('/images/iexcel_32x32.png') }}" sizes="32x32">
    <link rel="icon" href="{{ url('/images/iexcel_192x192.png') }}" sizes="192x192">
    <link rel="apple-touch-icon-precomposed" href="{{ url('/images/iexcel_180x180.png') }}">

</head>
<body>
<!-- Start Preloader -->
<div id="loading">
  <div class="element">
    <div class="sk-folding-cube">
      <div class="sk-cube1 sk-cube"></div>
      <div class="sk-cube2 sk-cube"></div>
      <div class="sk-cube4 sk-cube"></div>
      <div class="sk-cube3 sk-cube"></div>
    </div>
  </div>
</div>
<!-- End Preloader -->
<!-- Start Header -->
<header> 
  <!-- Start Header top Bar -->
  <div class="header-top">
    <div class="container clearfix">
      <ul class="follow-us hidden-xs">
        <li><a href="https://www.facebook.com/wideokursy/"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
        <li><a href="https://www.youtube.com/channel/UCC5LbbtBFGyGuBxsUVe-trg"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
      </ul>
      <div class="right-block clearfix">
        <ul class="top-nav hidden-xs">
            @if(Gate::allows('admin'))
                <li><a href="{{ '/admin' }}">Zaplecze administracyjne</a></li>
            @endif

          @if(!Auth::check())
            <li><a href="{{ url('/register') }}">Zarejestruj</a></li>
          @else
            <li><a href="{{ url('/account') }}">Twoje konto</a></li>
            <li><a href="{{ url('/cart') }}">Koszyk</a></li>
          @endif
        </ul>
        <div class="lang-wrapper">
          <div class="select-lang2">&nbsp;
            {{-- <select class="custom_select">
              <option value="en">English</option>
              <option value="fr">French</option>
              <option value="de">German</option>
            </select> --}}
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Header top Bar --> 
  <!-- Start Header Middle -->
  <div class="container header-middle">
    <div class="row"> <span class="col-xs-6 col-sm-3"><a href="{{ url('/') }}"><img src="{{ url('images/logo.png') }}" class="img-responsive" alt=""></a></span>
      <div class="col-xs-6 col-sm-3"></div>
      <div class="col-xs-6 col-sm-9">
        <div class="contact clearfix">
          <ul class="hidden-xs">
            <li> <span>Napisz</span> <a href="mailto:info@iexcel.pl"><i class="fa fa-envelope"></i> info@iexcel.pl</a> </li>
            <li> <span>Masz pytania?</span> <i class="fa fa-phone"></i> (32) 724-14-29 </li>
          </ul>
            <div style="display: inline-block;">
            @if(Auth::check())
                <div style="display: inline-block;"><form action="{{ url('logout') }}" method="post">
                    {{ csrf_field() }}
                    <button class="btn btn-default">Wyloguj</button>
                </form></div>
            @else
                <a href="{{ url('/register') }}" class="btn register-button">Zarejestruj <span class="icon-more-icon"></span></a> 
                <br />
                <span class="login-info">MASZ JUŻ KONTO? <a href="{{ url('/login') }}">ZALOGUJ SIĘ</a></span>
            @endif
            </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Header Middle --> 
  <!-- Start Navigation -->
  <nav class="navbar navbar-inverse">
    <div class="container">
      <div class="navbar-header">
        <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> <span class="sr-only">Przełącz nawigację</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      </div>
      <div class="navbar-collapse collapse" id="navbar">
        <form class="navbar-form navbar-right" action="{{ url('search') }}" method="POST">
            {{ csrf_field() }}
            <input name="search" type="text" placeholder="Szukaj..." class="form-control">
            <button class="search-btn"><span class="icon-search-icon"></span></button>
        </form>

            @include('partials.menu')

      </div>
    </div>
  </nav>
  <!-- End Navigation --> 
</header>
<!-- End Header --> 

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

<!-- Start Footer -->

<footer class="footer"> 
  <!-- Start Footer Top -->
  <div class="container">
    <div class="row row1">
      <div class="col-sm-9 clearfix">
        <div class="foot-nav">
          <h3>Informacje</h3>
          <ul>
            {!! \App\MenuItem::make(2) !!}
            {{-- <li><a href="{{ url('/regulamin') }}">Regulamin</a></li>
            <li><a href="{{ url('/about') }}">Jak to działa</a></li>
            <li><a href="http://blog.iexcel.pl" target="_blank">Blog</a></li>
            <li><a href="{{ url('comments') }}">Komentarze o nas</a></li> --}}
          </ul>
        </div>
        <div class="foot-nav">
          <h3>Wsparcie</h3>
          <ul>
            {!! \App\MenuItem::make(3) !!}
            {{-- <li><a href="{{ url('account') }}">Twoje konto i kursy</a></li>
            <li><a href="{{ url('faq') }}">FAQ</a></li>
            <li><a href="{{ url('activate_coupon') }}">Aktywacja kuponu</a></li> --}}
          </ul>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="footer-logo hidden-xs"><a href="index.html"><img src="images/logo.png" class="img-responsive" alt=""></a></div>
        <p>© 2017 <span>iExcel</span>. </p>

        <p class="info"><i class="fa fa-phone"></i><a href="tel:327241429">(32) 724 14 29</a> | <i class="fa fa-envelope"></i><a href="mailto:info@iexcel.pl">info@iexcel.pl</a></p>

        <p class="info">
            <a href="http://excelw30dni.pl">www.excelw30dni.pl</a> |
            <a href="http://ivba.pl">www.ivba.pl</a> |
            <a href="http://eduexcel.pl">www.eduexcel.pl</a>
        </p>
      </div>
    </div>
  </div>
  <!-- End Footer Top --> 
  <!-- Start Footer Bottom -->
  <div class="bottom">
    <div class="container">
      <div class="row">
        <div class="col-sm-4">
          <div class="connect-us">
            <h3>Znajdziesz nas na:</h3>
            <ul class="follow-us clearfix">
              <li><a target="_blank" href="https://www.facebook.com/wideokursy/"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
              <li><a target="_blank" href="https://www.youtube.com/channel/UCC5LbbtBFGyGuBxsUVe-trg"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
            </ul>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="subscribe">
            <h3>Zapisz się do newslettera</h3>
            <div class="input-wrapper clearfix">
                <form action="{{ url('/newsletter/subscribe') }}" method="POST">
                    {{ csrf_field() }}
                    <input name="email" type="text" placeholder="wpisz swój adres email">
                    <button><span class="icon-mail-icon"></span></button>
                </form>
            </div>
          </div>
        </div>
        <div class="col-sm-4">
            <p>Nauka MS Excela on-line<br>IT&amp;Business Training<br>ul. Zygmunta Starego 1/3<br>44-100 Gliwice</p>
            <p>NIP: 631-227-39-46</p>
        </div>
      </div>
    </div>
  </div>
  <!-- End Footer Bottom --> 
</footer>
<!-- End Footer --> 

@stack('modals')

@include('partials.show_proof')


<!-- Scroll to top --> 
<a href="#" class="scroll-top"><i class="fa fa-chevron-up" aria-hidden="true"></i></a> 

<script type="text/javascript" src="{{ url('js/app.js') }}"></script>

<!-- Select2 JS --> 
<script type="text/javascript" src="{{ url('assets/select2/js/select2.min.js') }}"></script> 
<!-- Match Height JS --> 
<script type="text/javascript" src="{{ url('assets/matchHeight/js/matchHeight-min.js') }}"></script> 
<!-- Bxslider JS --> 
<script type="text/javascript" src="{{ url('assets/bxslider/js/bxslider.min.js') }}"></script> 
<!-- Waypoints JS --> 
<script type="text/javascript" src="{{ url('assets/waypoints/js/waypoints.min.js') }}"></script> 
<!-- Counter Up JS --> 
<script type="text/javascript" src="{{ url('assets/counterup/js/counterup.min.js') }}"></script> 
<!-- Magnific Popup JS --> 
<script type="text/javascript" src="{{ url('assets/magnific-popup/js/magnific-popup.min.js') }}"></script> 
<!-- Owl Carousal JS --> 
<script type="text/javascript" src="{{ url('assets/owl-carousel/js/owl.carousel.min.js') }}"></script> 

<script type="text/javascript" src="{{ url('/js/front.js') }}"></script>

@foreach(\App\Script::all() as $script)
    {!! $script->script !!}
@endforeach

@stack('scripts')

</body>
</html>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="{{ $lesson->seo_description ?? $course->seo_description ?? "" }}">
    <meta name="author" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="../../favicon.ico">

    <title>@yield('title', 'iExcel')</title>

    <link rel="stylesheet" type="text/css" href="{{ url('/css/app.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Amiko:400,600,700&amp;subset=latin-ext" rel="stylesheet">
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

    <!-- Bootstrap core CSS -->
    {{-- <link href="../../dist/css/bootstrap.min.css" rel="stylesheet"> --}}

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    {{-- <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet"> --}}

    <!-- Custom styles for this template -->
    {{-- <link href="dashboard.css" rel="stylesheet"> --}}

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    {{-- <script src="../../assets/js/ie-emulation-modes-warning.js"></script> --}}

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body class="learn">

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ url('/images/logo.png') }}"></a> 
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                
                @yield('navbar')

            </ul>

        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar" >
            
            @yield('sidebar')

        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" >
            
            @yield('content')

        </div>
      </div>
    </div>

@stack('modals')

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

@stack('scripts')
  </body>
</html>

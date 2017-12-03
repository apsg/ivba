<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0; maximum-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" type="image/x-icon" href="{{ url('images/favicon.ico') }}">
<title>@section('title') | iExcel - platforma do nauki Excela</title>
<!-- Reset CSS -->
<link href="{{ url('/css/app.css') }}" rel="stylesheet" type="text/css">
<!-- Font Awesome -->
<link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<!-- Iconmoon -->
<link href="assets/iconmoon/css/iconmoon.css" rel="stylesheet" type="text/css">
<!-- Custom Style -->
<link href="{{ url('/css/front.css') }}" rel="stylesheet" type="text/css">

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
<body class="fill-bg">
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

@yield('content')


<!-- End Login --> 

<script type="text/javascript" src="{{ url('js/app.js') }}"></script>
<script type="text/javascript" src="assets/select2/js/select2.min.js"></script> 
<script type="text/javascript" src="{{ url('/js/front.js') }}"></script>

@stack('scripts')

</body>
</html>
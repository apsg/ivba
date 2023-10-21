<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0; maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Zaloguj się | {{ config('app.name') }}</title>

    <link rel="apple-touch-icon" sizes="180x180" href="/images/techniczni/fav/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/techniczni/fav/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/techniczni/fav/favicon-16x16.png">
    <link rel="manifest" href="/images/techniczni/fav/site.webmanifest">


    <!-- Reset CSS -->
    <link href="{{ url('/css/app.css') }}" rel="stylesheet" type="text/css">
    <!-- Font Awesome -->
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Iconmoon -->
    <link href="assets/iconmoon/css/iconmoon.css" rel="stylesheet" type="text/css">
    <!-- Custom Style -->
{{--    <link href="{{ url('/css/front.css') }}" rel="stylesheet" type="text/css">--}}
    <link href="{{ url('/css/app.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ multisite_css() }}" rel="stylesheet">


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.min.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <style>
        html,
        body {
            height: 100%;
            font-family: "Manrope";
        }

        body {
            display: -ms-flexbox;
            display: -webkit-box;
            display: flex;
            -ms-flex-align: center;
            -ms-flex-pack: center;
            -webkit-box-align: center;
            align-items: center;
            -webkit-box-pack: center;
            justify-content: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }
    </style>
</head>
<body class="text-center bg-gray-dark">
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
<div id="app">

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
</div>

<!-- End Login -->

<script type="text/javascript" src="{{ url('js/app.js') }}"></script>
<script type="text/javascript" src="assets/select2/js/select2.min.js"></script>
<script type="text/javascript" src="{{ url('/js/front.js') }}"></script>

@stack('scripts')

</body>
</html>

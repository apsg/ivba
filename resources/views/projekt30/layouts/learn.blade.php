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

    <link rel="icon" href="{{ url('/favicon.ico') }}">

    <title>@yield('title', config('app.name'))</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ multisite_css() }}">
</head>

<body class="learn">
<div id="app">
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{ url('/') }}">
            <img src="{{ asset('/images/projekt30/p30-logo.png') }}">
        </a>

        <div class="navbar-nav px-3 flex-row">
            @yield('navbar')
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">

                    @yield('sidebar')

                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

                @yield('content')

            </main>
        </div>
    </div>

    @stack('modals')
</div>

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
<script type="text/javascript" src="https://embed.cloudflarestream.com/embed/sdk.latest.js"></script>

<script type="text/javascript" src="{{ url('/js/front.js') }}"></script>
<script src="{{ multisite_js() }}"></script>

@stack('scripts')
</body>
</html>

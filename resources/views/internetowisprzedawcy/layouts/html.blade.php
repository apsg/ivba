<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') {{ config('app.name', 'Laravel') }}</title>

    <link rel="shortcut icon" href="{{ asset('images/internetowisprzedawcy/logo-favicon.png') }}"/>

    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Krona+One&family=Poppins:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap"
          rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/inauka_custom.css') }}" rel="stylesheet">
    <link href="{{ multisite_css() }}" rel="stylesheet">
</head>

@yield('body')

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('/js/inauka_custom.js') }}"></script>
<script src="{{ multisite_js() }}"></script>
<script type="text/javascript" src="https://embed.cloudflarestream.com/embed/sdk.latest.js"></script>
<script type="text/javascript">
    window.baseUrl = '{{ url('/') }}';
</script>
{!! NoCaptcha::renderJs() !!}
@foreach(\App\Script::all() as $script)
{!! $script->script !!}
@endforeach

@stack('scripts')

@include('cookieConsent::index')

</body>
</html>

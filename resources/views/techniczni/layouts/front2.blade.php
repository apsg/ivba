<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') {{ config('app.name', 'Laravel') }}</title>

    <link rel="apple-touch-icon" sizes="180x180" href="/images/techniczni/fav/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/techniczni/fav/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/techniczni/fav/favicon-16x16.png">
    <link rel="manifest" href="/images/techniczni/fav/site.webmanifest">

    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/inauka_custom.css') }}" rel="stylesheet">
    <link href="{{ multisite_css() }}" rel="stylesheet">
</head>
<body>
<div @if(request()->path() != 'cart' ) id="app" @endif>
    <flash-message class="fm-container"></flash-message>

    <header class="header mb-3 @if(\Illuminate\Support\Facades\Request::is('/')) home @endif">
        <nav class="navbar navbar-expand-sm ">
            <div class="container-xl">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('images/techniczni/logo_glowne.svg') }}" style="height: 70px">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-inauka"
                        aria-controls="navbar-inauka" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars fa-2x"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbar-inauka">
                    @include('partials.menu')
                </div>
            </div>
        </nav>
        @if(Request::is('/'))

        @endif
    </header>
    <div class="container-xl">
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

    <footer class="pt-5 pb-3 mt-3 text-white">
        <div class="container-xl py-3 ">
            <div class="row">
                <div class="col-md-6">
                    <a href="{{url('/')}}" class="py-3">
                        <img src="{{ asset('/images/techniczni/logo_stopka.svg') }}" height="70">
                    </a>
                    <p><strong>Edukacja Informatyczna sp z o.o.</strong>,
                        ul. Rynek 2, 43-190 Mikołów,
                        NIP: 635-186-70-12, REGON: 52612289400000, KRS: 0001052917

                    </p>
                </div>
                <div class="col-md-6">
                    <div>
                        <div class="footer-menu alignright">
                            {!! App\MenuItem::make(3, 'asc') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    @auth
        @if($lastLesson !== null)
            <last-lesson
                    url="{{ $lastLesson['url'] }}"
                    lesson="{{ $lastLesson['lesson'] }}"
                    course="{{ $lastLesson['course'] }}"></last-lesson>
        @endif
    @endauth
</div>

@if(request()->path() === 'cart')
    <div id="app"></div>
@endif

@stack('modals')

{{--@include('partials.show_proof')--}}
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('/js/inauka_custom.js') }}"></script>
<script src="{{ multisite_js() }}"></script>
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

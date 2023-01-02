<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') {{ config('app.name', 'Laravel') }}</title>

    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}"/>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/inauka_custom.css') }}" rel="stylesheet">
    <link href="{{ multisite_css() }}" rel="stylesheet">
</head>
<body>
<div @if(request()->path() != 'cart') id="app" @endif>
    <flash-message class="fm-container"></flash-message>

    @if(!request()->is('/') || !\Illuminate\Support\Facades\Auth::guest())
        <header class="header mb-3">
            <nav class="navbar navbar-expand-sm navbar-orange">
                <div class="container">
                    <a class="navbar-brand pt-4" href="{{ url('/') }}">
                        <img src="{{ asset('images/projekt30/p30-logo.png') }}">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-inauka"
                            aria-controls="navbar-inauka" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars fa-2x text-white"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbar-inauka">
                        @include('partials.menu')
                    </div>
                </div>
            </nav>
        </header>
    @endif
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

    @if(!request()->is('/'))

    <footer class="pt-3 pb-3 mt-3 text-white">
        <div class="container py-3 ">
            <div class="row">
                <div class="col-md-4">
                    <a href="{{url('/')}}" class="py-3">
                        <img src="{{ asset('/images/projekt30/p30-logo_stopka.png') }}">
                    </a>
                    <p>&copy; {{ Carbon\Carbon::now()->year }} ITBT</p>
                </div>
                <div class="col-md-4">
                </div>
                <div class="col-md-4 text-center">
                    <p><strong>IT&Business Training Mateusz Grabowski</strong> <br/>
                        ul. Zygmunta Starego 1/3, 44-100 Gliwice |
                        NIP: 6312273946 |
                        REGON: 240829920
                    </p>
                </div>
            </div>
        </div>
    </footer>

    @endif

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

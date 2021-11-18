@extends('layouts.html')

@section('body')
<body>
<div @if(request()->path() != 'cart' ) id="app" @endif>
    <flash-message class="fm-container"></flash-message>

    <header class="header mb-3 pt-5">
        <nav class="navbar navbar-expand-sm navbar-is fixed-top bg-red">
            <div class="container">
                <a class="navbar-brand pt-4" href="{{ url('/') }}">
                    <img src="{{ asset('images/internetowisprzedawcy/logo_white.png') }}" height="50">
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
        @if(Request::is('/'))
        <main-slider></main-slider>
        @endif
    </header>
    <div class="container pt-5">
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

    <footer class="pt-3 pb-3 mt-3 text-white">
        <div class="container py-3 ">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <a href="{{url('/')}}" class="py-3">
                        <img src="{{ asset('/images/internetowisprzedawcy/logo_white.png') }}">
                    </a>
                </div>
                <div class="col-md-4">
                    <div class="footer-menu">
                        {!! App\MenuItem::make(2, 'asc') !!}
                    </div>
                </div>
                <div class="col-md-4 text-right">
                    <p><strong>IT&Business Training Mateusz Grabowski</strong> <br/>
                        ul. Zygmunta Starego 1/3, 44-100 Gliwice |
                        NIP: 6312273946 |
                        REGON: 240829920
                    </p>
                </div>
            </div>
        </div>
    </footer>

    {{--    @guest--}}
    {{--        <proofs></proofs>--}}
    {{--    @endguest--}}

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
@endsection

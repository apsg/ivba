@extends('layouts.front2')

@section('title', 'Internetowi Sprzedawcy')

@section('content')
    <section class="container">
        <div class="row">
            <div class="col-md-6">
                <!-- old video
                <iframe src="https://player.vimeo.com/video/311629551" width="380" height="285" -->
                <div class="iframe-vimeo">
                    <iframe src="https://player.vimeo.com/video/29950141?h=c6db007fe5&title=0&byline=0&portrait=0"
                            frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen>
                    </iframe>
                </div>
                <script src="https://player.vimeo.com/api/player.js"></script>
            </div>
            <div class="col-md-6 pt-2">
                <div class="d-flex">
                    <div>
                        <ul class="square-ul"><li></li></ul>
                    </div>
                    <div class="video-description">
                        <div>
                            <h2 class="flex-grow-1 header-is mb-0">Rozwiń sprzedaż</h2><br>
                            <h2 class="flex-grow-1 header-is mb-0">Do <span class="text-blue">perfekcji</span></h2>
                        </div>
                        <p class="mt-4">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="container py-5 promo-cards">
        <div class="row">
            <div class="col-md-4 text-center promo-card p-3">
                <div class="bg-white rounded rounded-30 p-3">
                    <img src="{{ asset('images/projekt30/ikona-kursanci.png') }}">
                </div>
            </div>
            <div class="col-md-4 text-center promo-card p-3">
                <div class="bg-white rounded rounded-30 p-3">
                    <img src="{{ asset('images/projekt30/ikona-webinaria.png') }}">
                </div>
            </div>
            <div class="col-md-4 text-center promo-card p-3">
                <div class="bg-white rounded rounded-30 p-3">
                    <img src="{{ asset('images/projekt30/lekcje.png') }}">
                </div>
            </div>
            <div class="col-md-4 text-center promo-card p-3">
                <div class="bg-white rounded rounded-30 p-3">
                    <img src="{{ asset('images/projekt30/grupa wsparcia.png') }}">
                </div>
            </div>
            <div class="col-md-4 text-center promo-card p-3">
                <div class="bg-white rounded rounded-30 p-3">
                    <img src="{{ asset('images/projekt30/case-study.png') }}">
                </div>
            </div>
            <div class="col-md-4 text-center promo-card p-3">
                <div class="bg-white rounded rounded-30 p-3">
                    <img src="{{ asset('images/projekt30/sukces.png') }}">
                </div>
            </div>
        </div>
    </section>

    <testimonials></testimonials>

    <section class="start-grow">
        <div class="container mt-5 mb-5 row">
            <div class="col-md-6 text-center">
                <img src="{{ asset('/images/projekt30/rozpocznij-rozwoj-ilustracja.png') }}" class="w-75"/>
            </div>
            <div class="col-md-6 pt-5">
                <h3 class="mb-3 text-center">Rozpocznij swój rozwój z nami</h3>
                <p class="text-center">Sprzedaż i reklama w internecie, na pozór banalna, zmienia się gdy chcesz być
                    liderem w swojej
                    branży.
                    Jak to wszystko prowadzić i robić to dobrze?</p>
                <p class="text-right pr-5 text-bold">Dowiesz się u nas</p>
                <div class="text-center mb-5">
                    <a href="{{ url('/register') }}" class="btn btn-p30-green btn-big">
                        Zarejestruj się <i class="fa fa-chevron-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection

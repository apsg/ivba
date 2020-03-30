@extends('layouts.front2')

@section('title', 'Projekt30 - kompleksowe szkolenia z e-marketingu')

@section('content')
    <section class="container">
        <div class="row">
            <div class="col-md-6">
                <iframe src="https://player.vimeo.com/video/311629551" width="380" height="285" class="w-100 h-100 rounded" style="border-radius: 30px !important;" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>
				
            </div>
            <div class="col-md-6 pt-5">
                <div class="d-flex">
                    <h2 class="flex-grow-1">Zapraszam Cię na wspólny <span class="text-p30-orange">projekt</span></h2>
                    <div>
                        <img class="" src="{{ url('/images/projekt30/zapraszam-na.png') }}"/>
                    </div>
                </div>
                <p class="">Masz problemy ze sprzedażą w Internecie? Chcesz zwiększyć zasięgi? Zoptymalizować swoje działania sprzedażowe. A może masz ciekawy pomysł? Pokażemy Ci jak sprzedaje się w Internecie. Pokaże Ci moje case-e. Poprzez wyzwania na żywo udowodnię Ci, że da się w Polsce sprzedawać spore ilości towaru. A może podbijemy świat? </p>
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
                <p class="text-center">Sprzedaż i reklama w internecie, na pozór banalna, zmienia się gdy chcesz być liderem w swojej
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

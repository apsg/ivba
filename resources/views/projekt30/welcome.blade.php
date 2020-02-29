@extends('layouts.front2')

@section('title', 'Wideo kursy i konferencje  z Excel, Power BI, Photoshop, Prezentacji.')

@section('content')
    <section class="container">
        <div class="row">
            <div class="col-md-6">
                <iframe src="https://player.vimeo.com/video/319020879"
                        class="w-100 h-100 rounded"
                        style="border-radius: 30px !important;"
                        frameborder="0"
                        webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
            </div>
            <div class="col-md-6 pt-5">
                <div class="d-flex">
                    <h2 class="flex-grow-1">Zapraszam Cię na wspólny <span class="text-p30-orange">projekt</span></h2>
                    <div>
                        <img class="" src="{{ url('/images/projekt30/zapraszam-na.png') }}"/>
                    </div>
                </div>
                <p class="">O co chodzi z tą platfromą...</p>
            </div>
        </div>
    </section>
    <section class="container py-5 promo-cards">
        <div class="row">
            <div class="col-md-4 text-center promo-card">
                <img src="{{ asset('images/projekt30/kursanci-2.png') }}">
            </div>
            <div class="col-md-4 text-center promo-card">
                <img src="{{ asset('images/projekt30/webinaria-2.png') }}">
            </div>
            <div class="col-md-4 text-center promo-card">
                <img src="{{ asset('images/projekt30/lekcje-2.png') }}">
            </div>
            <div class="col-md-4 text-center promo-card">
                <img src="{{ asset('images/projekt30/grupa-wsparcia2.png') }}">
            </div>
            <div class="col-md-4 text-center promo-card">
                <img src="{{ asset('images/projekt30/casestudy2.png') }}">
            </div>
            <div class="col-md-4 text-center promo-card">
                <img src="{{ asset('images/projekt30/sukces2.png') }}">
            </div>
        </div>
    </section>

    <testimonials></testimonials>

    <section class="start-grow">
        <div class="container mt-5 mb-5 row">
            <div class="col-md-6 text-center">
                <img src="{{ asset('/images/projekt30/rozpocznij-rozwoj-ilustracja.png') }}" class="w-75" />
            </div>
            <div class="col-md-6 pt-5">
                <h3 class="mb-3">Rozpocznij swój rozwój z nami</h3>
                <p>Sprzedaż i reklama w internecie, na pozór banalna, zmienia się gdy chcesz być liderem w swojej branży.
                    Jak to wszystko prowadzić i robić to dobrze?</p>
                <p class="text-right pr-5 text-bold">Dowiesz się u nas</p>
                <div class="text-center">
                    <a href="{{ url('/register') }}" class="btn btn-p30-green btn-big">
                        Zarejestruj się <i class="fa fa-chevron-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection

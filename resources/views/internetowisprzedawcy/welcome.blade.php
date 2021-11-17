@extends('layouts.front2')

@section('title', 'Internetowi Sprzedawcy')

@section('content')
    <section class="container">
        <div class="row mt-5">
            <div class="col-md-6">
                <!-- old video
                <iframe src="https://player.vimeo.com/video/311629551" width="380" height="285" -->
                <div class="iframe-vimeo">
                    <iframe src="https://player.vimeo.com/video/29950141?h=c6db007fe5&title=0&byline=0&portrait=0"
                            frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen>
                    </iframe>
                </div>
            </div>
            <div class="col-md-6 pt-2">
                <div class="d-flex">
                    <div>
                        <ul class="square-ul"><li></li></ul>
                    </div>
                    <div class="container-description">
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
    <section class="container" style="padding-top: 5em">
        <div class="row mt-5">
            <div class="col-md-6">
                <div class="d-flex">
                    <div>
                        <ul class="square-ul"><li></li></ul>
                    </div>
                    <div class="container-description">
                        <div>
                            <h2 class="flex-grow-1 header-is mb-0">O tym dostępie</h2><br>
                            <h2 class="flex-grow-1 header-is mb-0">tylko raz na kwartał</h2>
                        </div>
                        <p class="mt-4">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 center-justify-flex-content">
                <img style="width: 100%" src="{{ asset('images/internetowisprzedawcy/timeline.png') }}">
            </div>
        </div>
    </section>
    <section class="container" style="padding-top: 5em">
        <div class="row mt-5">
            <div class="col-md-12 mb-5 center-justify-flex-content">
                <div class="text-center">
                    <h5>Co zyskasz dzięki dostępowi</h5>
                    <p class="p-header">Co zyskasz dzięki dostępowi?</p>
                </div>
            </div>
            <div class="col-md-4 d-flex justify-content-center">
                <div class="subscription-promo-card center-justify-flex-content">
                    <div class="text-center p-4">
                        <img class="m-3" src="{{ asset('images/internetowisprzedawcy/subscription-promo-1.png') }}">
                        <h3 class="m-3">Profesjonalne<br>wideokursy</h3>
                        <p class="m-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex justify-content-center">
                <div class="subscription-promo-card center-justify-flex-content">
                    <div class="text-center p-2">
                        <img class="m-3" src="{{ asset('images/internetowisprzedawcy/subscription-promo-2.png') }}">
                        <h3 class="m-3">Certyfikaty<br>ukończenia</h3>
                        <p class="m-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex justify-content-center">
                <div class="subscription-promo-card center-justify-flex-content">
                    <div class="text-center p-2">
                        <img class="m-3" src="{{ asset('images/internetowisprzedawcy/subscription-promo-3.png') }}">
                        <h3 class="m-3">Aktualne<br>nowości</h3>
                        <p class="m-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod</p>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-5 center-justify-flex-content">
                <div class="text-center">
                    <button type="button" class="btn subscription-button">
                        <span>
                            Wykup dostęp
                        </span>
                    </button>
                    <div class="mt-2">
                        <span class="subscription-button-description">Nie zwlekaj, możliwość zakupu przez tydzień raz na kwartał.</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="container" style="padding-top: 5em">
        <div class="row mt-5">
            <div class="col offer-promo-card">
                <div class="offer-promo-card__title">
                    <span>
                        Case Study 
                    </span>
                </div>
                <div class="offer-promo-card__description">
                    <span>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex
                    </span>
                </div>
            </div>
            <div class="col offer-promo-card offer-promo-card__with-margin">
                <div class="offer-promo-card__title">
                    <span>
                        Grupa Wsparcia 
                    </span>
                </div>
                <div class="offer-promo-card__description">
                    <span>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex
                    </span>
                </div>
            </div>
            <div class="col offer-promo-card">
                <div class="offer-promo-card__title">
                    <span>
                        Checklisty 
                    </span>
                </div>
                <div class="offer-promo-card__description">
                    <span>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex
                    </span>
                </div>
            </div>
            <div class="col offer-promo-card offer-promo-card__with-margin">
                <div class="offer-promo-card__title">
                    <span>
                        Egzamin 
                    </span>
                </div>
                <div class="offer-promo-card__description">
                    <span>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex
                    </span>    
                </div>
            </div>
            <div class="col offer-promo-card">
                <div class="offer-promo-card__title">
                    <span>
                        Pytania 
                    </span>
                </div>
                <div class="offer-promo-card__description">
                    <span>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex
                    </span>    
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

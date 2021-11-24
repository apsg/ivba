@extends('layouts.front2')

@section('title', 'Internetowi Sprzedawcy')

@section('content')
    <div class="section-container" id="o-platformie">
        <section class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="iframe-vimeo">
                        <img src="{{ asset('images/internetowisprzedawcy/brand-mark-1.png') }}">
                        <iframe src="https://player.vimeo.com/video/29950141?h=c6db007fe5&title=0&byline=0&portrait=0"
                                frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen
                                
                                >
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
                                <h2 class="flex-grow-1 header-is mb-0">Rozwiń sprzedaż <br>Do <span class="text-blue">perfekcji</span></h2>
                            </div>
                            <p class="mt-4">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="section-container" id="korzysci">
        <section class="container pb-5">
            <div class="row mt-5">
                <div class="col-md-6">
                    <div class="d-flex">
                        <div>
                            <ul class="square-ul"><li></li></ul>
                        </div>
                        <div class="container-description">
                            <div>
                                <h2 class="flex-grow-1 header-is mb-0">O tym dostępie <br>tylko raz na kwartał</h2>
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
    </div>
    <div class="section-container section-container__bg-color-grey">
        <section class="container pb-5">
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
                    <div class="text-center mt-5">
                        <a href="{{ url('/buy_access') }}">
                            <button type="button" class="btn subscription-button">
                                <span>
                                    Wykup dostęp
                                </span>
                            </button>
                        </a>
                        <div class="mt-2">
                            <span class="subscription-button-description">Nie zwlekaj, możliwość zakupu przez tydzień raz na kwartał.</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="section-container">
        <section class="container">
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
            <div class="row">
                <div class="col-md-6 center-justify-flex-content">
                    <div class="d-flex">
                        <div>
                            <ul class="square-ul"><li></li></ul>
                        </div>
                        <div class="container-description">
                            <div>
                                <h2 class="flex-grow-1 header-is mb-0">Motywacyjna <br>gadka</h2>
                            </div>
                            <p class="mt-4">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <img class="w-100 confident-seller-img" src="{{ asset('images/internetowisprzedawcy/mati.png') }}">
                </div>
            </div>
        </section>
    </div>
    <div class="section-container section-container__bg-color-grey" id="opinie">
        <section class="container py-5 promo-cards">
            <div class="row">
                <div class="col-md-12 center-justify-flex-content">
                    <div class="text-center">
                        <h5>Co o nas sądzą sprzedawcy</h5>
                        <p class="p-header">Opinie o naszej platformie</p>
                    </div>
                </div>
            </div>
            <opinions-slider></opinions-slider>
        </section>
    </div>
    <div class="section-container" id="zobacz-kursy">
        <section class="container">
            <div class="row mt-5">
                <div class="col-md-6 center-justify-flex-content">
                    <img style="width: 100%" src="{{ asset('images/internetowisprzedawcy/min-video.png') }}">
                </div>
                <div class="col-md-6 center-justify-flex-content">
                    <div class="d-flex">
                        <div>
                            <ul class="square-ul"><li></li></ul>
                        </div>
                        <div class="container-description">
                            <div>
                                <h2 class="flex-grow-1 header-is mb-0">Specjalistyczna wiedza <br><span class="text-blue">praktyczne</span> przykłady</h2>
                            </div>
                            <p class="mt-4">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud.
                            </p>
                            <a href="{{ url('/courses') }}" class="btn courses-list-button mt-4">
                                <span>
                                    Zobacz spis kursów
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="section-container">
        <section class="container">
            <div class="row mt-5">
                <div class="col-md-6 center-justify-flex-content">
                    <div class="d-flex">
                        <div>
                            <ul class="square-ul"><li></li></ul>
                        </div>
                        <div class="container-description">
                            <div>
                                <h2 class="flex-grow-1 header-is mb-0">Różne spojrzenia na <br>sprzedaż w internecie</h2>
                            </div>
                            <p class="mt-4">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 center-justify-flex-content">
                    <img style="width: 100%" src="{{ asset('images/internetowisprzedawcy/team-card.png') }}">
                </div>
            </div>
        </section>
    </div>
    <div class="section-container">
        <section class="container">
            <div class="row mt-5">
                <div class="col-md-12 col-lg-6">
                    <img class="vs-logo" src="{{ asset('images/internetowisprzedawcy/vs-logo.png') }}">
                    <div class="list-card list-card__negative">
                        <div class="list-card__header">
                            Typowa platforma <br>do nauki
                        </div>
                        <div class="list-card-item list-card-item__negative">
                            <i class="far fa-times-circle"></i> Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        </div>
                        <div class="list-card-item list-card-item__negative">
                            <i class="far fa-times-circle"></i> Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        </div>
                        <div class="list-card-item list-card-item__negative">
                            <i class="far fa-times-circle"></i> Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        </div>
                        <div class="list-card-item list-card-item__negative">
                            <i class="far fa-times-circle"></i> Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        </div>
                        <div class="list-card-item list-card-item__negative">
                            <i class="far fa-times-circle"></i> Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        </div>
                        <div class="list-card-item list-card-item__negative">
                            <i class="far fa-times-circle"></i> Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        </div>
                        <div class="list-card-item list-card-item__negative">
                            <i class="far fa-times-circle"></i> Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        </div>
                        <div class="list-card-item list-card-item__negative">
                            <i class="far fa-times-circle"></i> Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6">
                    <div class="list-card list-card__positive">
                        <div class="list-card__header">
                            <img src="{{ asset('images/internetowisprzedawcy/logo_color.png') }}">
                        </div>
                        <div class="list-card-item list-card-item__positive">
                            <i class="far fa-check-circle"></i> Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        </div>
                        <div class="list-card-item list-card-item__positive">
                            <i class="far fa-check-circle"></i> Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        </div>
                        <div class="list-card-item list-card-item__positive">
                            <i class="far fa-check-circle"></i> Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        </div>
                        <div class="list-card-item list-card-item__positive">
                            <i class="far fa-check-circle"></i> Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        </div>
                        <div class="list-card-item list-card-item__positive">
                            <i class="far fa-check-circle"></i> Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        </div>
                        <div class="list-card-item list-card-item__positive">
                            <i class="far fa-check-circle"></i> Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        </div>
                        <div class="list-card-item list-card-item__positive">
                            <i class="far fa-check-circle"></i> Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        </div>
                        <div class="list-card-item list-card-item__positive">
                            <i class="far fa-check-circle"></i> Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        </div>
                        <div class="list-card-item list-card-item__positive">
                            <i class="far fa-check-circle"></i> Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="row mt-5">
                <div class="col-12 d-flex justify-content-center">
                    <div class="access-promo-card center-justify-flex-content">
                        <div class="access-promo-card__container text-center p-4">
                            <div class="circle-container__outer">
                                <div class="circle-container__inner">
                                    <img class="m-3" src="{{ asset('images/internetowisprzedawcy/logo_znak.png') }}">
                                </div>
                            </div>
                            <h1 class="m-3">Dostęp do platformy<br> właśnie trwa!</h3>
                            <p class="mb-5 mt-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut ero labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
                            <a href="{{ url('/buy_access') }}">
                                <button type="button" class="mb-5 btn subscription-button subscription-button-alt">
                                    <span>
                                        Wykup dostęp
                                    </span>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="section-container" id="faq">
        <section class="container faq-accordion__section py-5">
            <faq-accordion></faq-accordion>
        </section>
    </div>

@endsection

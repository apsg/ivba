@extends('layouts.front2')

@section('title', 'Internetowi Sprzedawcy')

@section('content')
    <div class="section-container" id="o-platformie">
        <section class="container">
            <div class="row">
                <div class="col-md-6">
                <vimeo-video-modal
                    image="{{ asset('images/internetowisprzedawcy/ytt.png') }}"
                    video-src="https://player.vimeo.com/video/764209544?h=c6db007fe5&title=0&byline=0&portrait=0">
                </vimeo-video-modal>
                </div>
                <div class="col-md-6 pt-2">
                    <div class="d-flex">
                        <div>
                            <ul class="square-ul">
                                <li></li>
                            </ul>
                        </div>
                        <div class="container-description">
                            <div>
                                <h2 class="flex-grow-1 header-is mb-0">
                                    Mechanizmy, które <br>
                                    zwiększą Twoją <span class="text-blue">sprzedaż</span>
                                </h2>
                            </div>
                            <p class="mt-4">
                                Internetowi Sprzedawcy to platforma pozwalająca na zdobycie nowych umiejętności
                                wymaganych przez rynek E-Commerce. Oprócz wiedzy przygotowanej przez ekspertów
                                otrzymujesz konsultacje, wsparcie oraz dostęp do nowości rynkowych.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="section-container">
        <section class="container pb-5">
            <div class="row mt-5">
                <div class="col-md-6">
                    <div class="d-flex">
                        <div>
                            <ul class="square-ul">
                                <li></li>
                            </ul>
                        </div>
                        <div class="container-description">
                            <div>
                                <h2 class="flex-grow-1 header-is mb-0">Ekskluzywny <br>dostęp</h2>
                            </div>
                            <p class="mt-4">
                                Dostęp do stale aktualizowanej platformy jest ściśle limitowany, ponieważ chcemy
                                zapewnić jakość działania jej materiałów oraz troskę o społeczność. Tylko 4 razy w roku
                                otwieramy możliwość przystąpienia do programu.
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
    <div class="section-container section-container__bg-color-grey" id="korzysci">
        <section class="container pb-5">
            <div class="row mt-5">
                <div class="col-md-12 mb-5 center-justify-flex-content">
                    <div class="text-center">
                        <h5>Co zyskasz dzięki dostępowi</h5>
                        <p class="p-header">Co zyskasz dzięki dostępowi?</p>
                    </div>
                </div>
                <div class="col-md-4 pt-1 pb-1 d-flex justify-content-center">
                    <div class="subscription-promo-card center-justify-flex-content">
                        <div class="text-center p-4">
                            <img class="m-3" src="{{ asset('images/internetowisprzedawcy/subscription-promo-1.png') }}">
                            <h3 class="m-3">Sprawdzona<br>wiedza</h3>
                            <p class="m-3">Praktyczne materiały na podstawie doświadczeń prowadzących</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 pt-1 pb-1 d-flex justify-content-center">
                    <div class="subscription-promo-card center-justify-flex-content">
                        <div class="text-center p-2">
                            <img class="m-3" src="{{ asset('images/internetowisprzedawcy/subscription-promo-2.png') }}">
                            <h3 class="m-3">Certyfikaty<br>ukończenia</h3>
                            <p class="m-3">
                                Wszystkie kursy posiadają egzaminy sprawdzające i certyfikaty ukończenia.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 pt-1 pb-1 d-flex justify-content-center">
                    <div class="subscription-promo-card center-justify-flex-content">
                        <div class="text-center p-2">
                            <img class="m-3" src="{{ asset('images/internetowisprzedawcy/subscription-promo-3.png') }}">
                            <h3 class="m-3">Aktualne<br>nowości</h3>
                            <p class="m-3">
                                Główny element platformy to aktualizowany na bieżąco blog o najlepszych rozwiązaniach
                                rynkowych.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-5 center-justify-flex-content">
                    <div class="text-center mt-5">

                        <a href="{{ url('/buy_access') }}">
                            <button type="button" class="btn subscription-button">
                                <span>
                                    @if(!setting('is.disable_buy'))
                                        Wykup dostęp
                                    @else
                                        Zapisz się
                                    @endif
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
    <div class="section-container section-container__offer-promo-container">
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
                            Otrzymasz dostęp do analizy wdrożonych rozwiązań biznesowych, zobaczysz konfigurację kampanii reklamowych, przychody i zyski ze sprzedaży oraz dowiesz się jak wszystko zostało zaplanowane w czasie.
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
                            Zaprosimy Cię na platformę Discord gdzie wraz z trenerami i innymi członkami społeczności będziesz mógł/mogła wymieniać się doświadczeniem, zadawać pytania i konsultować się na żywo.
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
                            Każdy kurs, oprócz lekcji wideo i ćwiczeń posiadać będzie checklistę która pomoże Ci uporządkować wszystkie przekazane materiały oraz zorganizować plan pracy
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
                            Przetestujesz swoją wiedzę! Po przerobieniu materiałów będziesz miał możliwość zdawania egzaminu, którego pozytywny wynik uprawnia do uzyskania certyfikatu.
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
                            Nie wiesz o co chodzi w lekcji lub zastanawiasz się nad swoim rozwiązaniem? Zadaj pytanie! Do każdej lekcji dodaliśmy możliwość kontaktu.
                        </span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 center-justify-flex-content">
                    <div class="d-flex">
                        <div>
                            <ul class="square-ul">
                                <li></li>
                            </ul>
                        </div>
                        <div class="container-description">
                            <div>
                                <h2 class="flex-grow-1 header-is mb-0">
                                    Brakowało mi takiego rozwiązania w Internecie
                                </h2>
                            </div>
                            <p class="mt-4">
                                Internetowi Sprzedawcy to moja odpowiedź na potrzeby właścicieli sklepów internetowych
                                oraz stacjonarnych którzy chcą wkroczyć na rynek e-commerce. <br/>
                                Celem platformy jest nie tylko nauka technik sprzedaży on-line, ale także wymiana
                                doświadczeniami pomiędzy członkami oraz możliwość kontaktu z ekspertami. <br/>
                                To miejsce które zastąpi Ci żmudne badanie i analizę rynku ponieważ będziesz informowany
                                na bieżąco o skutecznych rozwiązaniach oraz narzędziach które zrewolucjonizują Twój
                                biznes.
                            </p>
                            <p>
                                Mateusz Grabowski autor platformy InternetowiSprzedawcy.pl
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
    <div class="section-container section-container__bg-color-grey section-container__opinions-container" id="opinie">
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
                            <ul class="square-ul">
                                <li></li>
                            </ul>
                        </div>
                        <div class="container-description">
                            <div>
                                <h2 class="flex-grow-1 header-is mb-0">Ekspercka wiedza <br><span
                                            class="text-blue">praktyczne</span> przykłady</h2>
                            </div>
                            <p class="mt-4">
                                Każde szkolenie jest przygotowane pod wymagania rynkowe, oparte na istniejących
                                biznesach rozwiązania które wyjaśnimy jak możesz wprowadzić w swoim sklepie. Dostępne
                                materiały możesz zobaczyć klikając w przycisk poniżej.
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
                            <ul class="square-ul">
                                <li></li>
                            </ul>
                        </div>
                        <div class="container-description">
                            <div>
                                <h2 class="flex-grow-1 header-is mb-0">Różne spojrzenia na <br>sprzedaż w internecie
                                </h2>
                            </div>
                            <p class="mt-4">
                                Do tworzenia platformy zaprosiliśmy ekspertów wielu dziedzin rynku e-commerce, którzy na
                                podstawie swojego doświadczenia przygotowali materiały szkoleniowe.
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
    <div class="section-container section-container__access-promo-container">
        <section class="container">
            <div class="row mt-5">
                <div class="col-md-12 col-lg-6">
                    <!-- <img class="vs-logo" src="{{ asset('images/internetowisprzedawcy/vs-logo.png') }}"> -->
                    <div class="list-card list-card__negative">
                        <div class="list-card__header">
                            Typowa platforma <br>do nauki
                        </div>
                        <div class="list-card-item list-card-item__negative">
                            <i class="fa fa-times-circle-o"></i> Treść wideo
                        </div>
                        <div class="list-card-item list-card-item__negative">
                            <i class="fa fa-times-circle-o"></i> Kontakt pośredni
                        </div>
                        <div class="list-card-item list-card-item__negative">
                            <i class="fa fa-times-circle-o"></i> Automatyczne raporty bez badania
                        </div>
                        <div class="list-card-item list-card-item__negative">
                            <i class="fa fa-times-circle-o"></i> Rzadkie aktualizacje
                        </div>
                        <div class="list-card-item list-card-item__negative">
                            <i class="fa fa-times-circle-o"></i> Checklisty
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-6">
                    <div class="list-card list-card__positive">
                        <div class="list-card__header">
                            <img src="{{ asset('images/internetowisprzedawcy/logo_color.png') }}">
                        </div>
                        <div class="list-card-item list-card-item__positive">
                            <i class="fa fa-check-circle-o"></i>
                            Treść wideo + case study
                        </div>
                        <div class="list-card-item list-card-item__positive">
                            <i class="fa fa-check-circle-o"></i>
                            Kontakt bezpośredni z autorem
                        </div>
                        <div class="list-card-item list-card-item__positive">
                            <i class="fa fa-check-circle-o"></i>
                            Cykliczne raporty z możliwością nadzoru
                        </div>
                        <div class="list-card-item list-card-item__positive">
                            <i class="fa fa-check-circle-o"></i>
                            Miesięczne aktualizacje kursów
                        </div>
                        <div class="list-card-item list-card-item__positive">
                            <i class="fa fa-check-circle-o"></i>
                            Checklisty + procesy
                        </div>
                        <div class="list-card-item list-card-item__positive">
                            <i class="fa fa-check-circle-o"></i>
                            Działanie w clusterach
                        </div>
                        <div class="list-card-item list-card-item__positive">
                            <i class="fa fa-check-circle-o"></i>
                            Cykliczne wyzwania
                        </div>
                        <div class="list-card-item list-card-item__positive">
                            <i class="fa fa-check-circle-o"></i>
                            Schematy sprzedaży
                        </div>
                        <div class="list-card-item list-card-item__positive">
                            <i class="fa fa-check-circle-o"></i>
                            Spotkania na żywo
                        </div>
                        <div class="list-card-item list-card-item__positive">
                            <i class="fa fa-check-circle-o"></i>
                            Aktualności + powiadomienia
                        </div>
                        <div class="list-card-item list-card-item__positive">
                            <i class="fa fa-check-circle-o"></i>
                            Segmentacja - sprzedawcy produktów i usług
                        </div>
                        <div class="list-card-item list-card-item__positive">
                            <i class="fa fa-check-circle-o"></i>
                            100% praktyków
                        </div>
                    </div>
                </div>

            </div>
            <div class="row mt-5">
                <div class="col-12 d-flex justify-content-center">
                    <div class="access-promo-card center-justify-flex-content">
                        <div class="access-promo-card__container text-center p-4">
                            <img class="access-promo-card__container--brand-logo-img"
                                 src="{{ asset('images/internetowisprzedawcy/brand-mark-2.png') }}">
                            <div class="circle-container__outer">
                                <div class="circle-container__inner">
                                    <img width="43" height="71" class="m-3" src="{{ asset('images/internetowisprzedawcy/logo_znak.svg') }}">
                                </div>
                            </div>
                            @if(!setting('is.disable_buy'))
                                <h1 class="m-3">Dostęp do platformy<br> właśnie trwa!</h1>
                                <p class="mb-5 mt-3">
                                    Dołącz do społeczności Internetowych Sprzedawców, możliwość dostępu niebawem
                                    wygaśnie.
                                </p>
                                <a href="{{ url('/buy_access') }}">
                                    <button type="button" class="mb-5 btn subscription-button subscription-button-alt">
                                    <span>
                                        Wykup dostęp
                                    </span>
                                    </button>
                                </a>
                            @else
                                <h1 class="m-3">Możliwość dołączenia<br> chwilowo niedostępna.</h1>
                                <p class="mb-5 mt-3">
                                    Zapisz się na listę oczekujących, aby otrzymać powiadomienie o kolejnym naborze do
                                    platformy.
                                </p>
                                <a href="{{ url('/buy_access') }}">
                                    <button type="button" class="mb-5 btn subscription-button subscription-button-alt">
                                    <span>
                                        Zapisz się
                                    </span>
                                    </button>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="section-container" id="faq">
        <section class="container faq-accordion__section py-5">
            <faq-accordion
                    :email="'info@internetowisprzedawcy.pl'"
                    :phone="'508 091 752'">
            </faq-accordion>
        </section>
    </div>

@endsection

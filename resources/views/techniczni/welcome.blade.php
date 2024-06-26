@extends('layouts.front2')

@section('title', 'Wideo kursy i konferencje  z Excel, Power BI, Photoshop, Prezentacji.')

@section('content')
    <div class="video-wrapper">
        <video playsinline autoplay muted loop poster="cake.jpg">
            <source src="/images/techniczni/www-background.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <div class="video-overlay w-100 h-100">
            <div class="d-flex container flex-column justify-content-center h-100 fadeIn welcome-container">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div>
                            <div style="position: relative; padding-top: 56.25%;">
                                <iframe
                                        src="https://customer-gnl8urc1wq6n6cqi.cloudflarestream.com/00d6dbf54d502585b25276c0a07d63d0/iframe"
                                        style="border: none; position: absolute; top: 0; left: 0; height: 100%; width: 100%;"
                                        allow="accelerometer; gyroscope; autoplay; encrypted-media; picture-in-picture;"
                                        allowfullscreen="true"
                                ></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 ">
                        <div class="pl-5 side-text">
                            <p class="font-green">
                                Kursy z Excela i IT
                            </p>
                            <h1 class="font-weight-700 font-size-60">
                                Jak się uczyć?
                            </h1>
                            <p class="font-size-22">
                                Oferujemy naukę nowoczesnymi metodami, Przygotowane materiały pomogą Ci utrwalić i
                                wykorzystać
                                jak najwięcej wiedzy.
                            </p>
                            <div>
                                <a href="{{ url('register') }}" class="btn btn-green px-3 py-2 font-size-18">
                                    Wypróbuj za darmo
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="container-lg py-5 promo-cards">
        <div class="row">
            <div class="col-md-4 techniczni-card px-4" data-inviewport="fadeIn">
                <div class="border-green p-3">
                    <div class="card-thumb">
                        <img src="{{ asset('/images/techniczni/glowna1.png') }}" class="w-100 card-main-img " />
                        <img src="{{ asset('/images/techniczni/icona1.svg') }}" class="icon">
                    </div>

                    <h3>Kursy online</h3>

                    <p>Najwięcej nauczysz się podczas konsultacji, wpadnij na comiesięczne spotkanie on-line.</p>

                </div>
            </div>

            <div class="col-md-4 techniczni-card px-4 delay1" data-inviewport="fadeIn">
                <div class="border-green p-3">
                    <div class="card-thumb">
                        <img src="{{ asset('/images/techniczni/glowna-2.png') }}" class="w-100 card-main-img" />
                        <img src="{{ asset('/images/techniczni/icona2.svg') }}" class="icon">
                    </div>

                    <h3>Certyfikaty</h3>

                    <p>Każdy kursy to egzamin i certyfikat, nie uda się? Spokojnie masz powtórkę.</p>

                </div>
            </div>

            <div class="col-md-4 techniczni-card px-4 delay2" data-inviewport="fadeIn">
                <div class="border-green p-3">
                    <div class="card-thumb">
                        <img src="{{ asset('/images/techniczni/glowna-3.png') }}" class="w-100 card-main-img" />
                        <img src="{{ asset('/images/techniczni/icona3.svg') }}" class="icon">
                    </div>

                    <h3>Na żywo</h3>

                    <p>Najwięcej nauczysz się podczas konsultacji, wpadnij na comiesięczne spotkanie on-line.</p>

                </div>
            </div>
        </div>
    </section>

@endsection

@extends('layouts.front2')

@section('title', 'Wideo kursy i konferencje  z Excel, Power BI, Photoshop, Prezentacji.')

@section('content')
    <section class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-orange text-center my-3">Jak działa platforma?</h2>
                <div style="position: relative; padding-top: 56.25%;">
                    <iframe
                            src="https://customer-gnl8urc1wq6n6cqi.cloudflarestream.com/319e1b61311d6de43a5eea5279d2591d/iframe?poster=https%3A%2F%2Fmegasobota.pl%2Fwp-content%2Fuploads%2F2023%2F11%2Finauka-thumbnail.png"
                            style="border: none; position: absolute; top: 0; left: 0; height: 100%; width: 100%;"
                            allow="accelerometer; gyroscope; autoplay; encrypted-media; picture-in-picture;"
                            allowfullscreen="true"
                    ></iframe>
                </div>
            </div>
        </div>
    </section>
    <section class="container py-5 promo-cards">
        <div class="row">
            <div class="col-md-4 text-center promo-card">
                <img src="{{ asset('images/v2/1_kursanci.svg') }}" style="height: 70px">
                <h3>Kursanci</h3>
                <p>Już ponad 5000 osób korzysta z naszej platformy do nauki.</p>
            </div>
            <div class="col-md-4 text-center promo-card">
                <img src="{{ asset('images/v2/2_certyfikaty.svg') }}" style="height: 70px">
                <h3>Certyfikaty</h3>
                <p> Zdobądź certyfikat z wybranego kursu lub specjalizacji.</p>
            </div>
            <div class="col-md-4 text-center promo-card">
                <img src="{{ asset('images/v2/3_grupawsparcia.svg') }}" style="height: 70px">
                <h3> Grupa wsparcia</h3>
                <p> Dołącz do naszej grupy wsparcia i wymieniaj wiedzą z innymi osobami</p>
            </div>
            <div class="col-md-4 text-center promo-card">
                <img src="{{ asset('images/v2/4_wygoda.svg') }}" style="height: 70px">
                <h3> Wygoda</h3>
                <p>Ucz się gdzie chcesz i kiedy chcesz we własnym tempie.</p>
            </div>
            <div class="col-md-4 text-center promo-card">
                <img src="{{ asset('images/v2/5_aktualizacje.svg') }}" style="height: 70px">
                <h3>Aktualizacje</h3>
                <p>Kursy aktualizujemy. Raz w miesiącu dodajemy nowy kurs.</p>
            </div>
            <div class="col-md-4 text-center promo-card">
                <img src="{{ asset('images/v2/6_lekcje.svg') }}" style="height: 70px">
                <h3>Lekcje</h3>
                <p>Na naszym portalu znajdziesz ponad 300 lekcji, a ich liczba stale rośnie.</p>
            </div>
            <div class="col-md-4 text-center promo-card">
                <img src="{{ asset('images/v2/7_ambasadorzy.svg') }}" style="height: 70px">
                <h3>Ambasadorzy</h3>
                <p>Poznaj naszych ambasadorów, do których możesz zwrócić się po pomoc.</p>
            </div>
            <div class="col-md-4 text-center promo-card">
                <img src="{{ asset('images/v2/8_webinaria.svg') }}" style="height: 70px">
                <h3>Webinaria</h3>
                <p>Cykliczne, zamknięte szkolenia on-line na wyciągnięcie ręki.</p>
            </div>
            <div class="col-md-4 text-center promo-card">
                <img src="{{ asset('images/v2/9_zwrot.svg') }}" style="height: 70px">
                <h3>Zwrot</h3>
                <p>Masz 30 dni na rezygnację z naszej platformy.</p>
            </div>
        </div>
    </section>

    {{--<section class="bg-gray-dark random-lessons row">--}}
    {{--<random-lessons num="4"></random-lessons>--}}
    {{--</section>--}}

    <testimonials></testimonials>

    <section class="contact-form">
        <div class="container mt-5 mb-5">
            <div class="row justify-content-md-center">
                <form method="post" action="{{ url('contact_form') }}" class=" col-md-6">
                    {{ csrf_field() }}

                    <h3 class="section-header">Skontakuj się z nami</h3>
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" required placeholder="Imię">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                               aria-describedby="emailHelp"
                               placeholder="Email" required>
                        <small id="emailHelp" class="form-text text-muted">Nigdy nie udostępnimy Twojego adresu email
                            nikomu bez Twojej zgody.
                        </small>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="message"
                                  rows="3" placeholder="Wiadomość" required></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            {!! NoCaptcha::display() !!}
                        </div>
                        <div class="col-md-6 text-right">
                            <button type="submit" class="mt-2 btn btn-ivba rounded-pill">Wyślij</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection

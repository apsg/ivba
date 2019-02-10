@extends('layouts.front2')

@section('content')
    <section class="container py-5 promo-cards">
        <div class="row">
            <div class="col-md-4 text-center promo-card">
                <img src="{{ asset('images/v2/ikonka_konferencja.png') }}">
                <h3>Od a do z</h3>
                <p>Nie spotkałeś się z VBA? U nas krok po kroku wprowadzimy cię w VBA. Znasz VBA? Z nami utrwalisz swoją
                    wiedzę i dowiesz się jak można rozwiązać typowe problemy w VBA.</p>
            </div>
            <div class="col-md-4 text-center promo-card">
                <img src="{{ asset('images/v2/ikonka_nie_bujamy.png') }}">
                <h3>Nie bujamy w obłokach, uczymy</h3>
                <p>Nie spotkałeś się z VBA? U nas krok po kroku wprowadzimy cię w VBA. Znasz VBA? Z nami utrwalisz swoją
                    wiedzę i dowiesz się jak można rozwiązać typowe problemy w VBA.</p>
            </div>
            <div class="col-md-4 text-center promo-card">
                <img src="{{ asset('images/v2/ikonka_od_a_do_z.png') }}">
                <h3>Konferencje on-line</h3>
                <p>Nie spotkałeś się z VBA? U nas krok po kroku wprowadzimy cię w VBA. Znasz VBA? Z nami utrwalisz swoją
                    wiedzę i dowiesz się jak można rozwiązać typowe problemy w VBA.</p>
            </div>
        </div>
    </section>

    <section class="py-3 bg-gray-dark random-lessons row">
        <random-lessons num="4"></random-lessons>
    </section>

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
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

    <section class="py-3 bg-gray-dark random-lessons">
        <random-lessons num="4"></random-lessons>
    </section>

    <section class="testimonial padding-lg">
        <div class="container">
            <div class="wrapper">
                <h2 class="section-header">Co o nas mówią?</h2>

                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <p>Szkolenia iExcel pozwoliły mi na prowadzenie szeregu usprawnień w firmie. Pomimo ciągłej
                                pracy na excelu, moje analizy są teraz zdecydowanie bardziej profesjonalne. Nie ma w
                                Polsce drugiej takiej firmy, która w tak przyswajalny sposób potrafi przekazać wiedzę.
                                Osobiście – bardzo polecam! Dzięki i widzimy się na kolejnej konferencji</p>
                            <span>Łukasz Kutyłowski, <span>Warszawa</span></span>
                            <br/>
                            <img src="images/Łukasz-Kutyłowskibig-100x100.png" class="img-circle" alt=""/>
                        </div>
                        <div class="item">
                            <p>Środowa konferencja była pierwszą i na pewno nie ostatnią. Zdecydowanie polecam. Super
                                atmosfera a wiedza przekazywana w bardzo przystępny sposób!</p>
                            <span>Damian Klekot, <span>Warszawa</span></span>
                            <br/>
                            <img src="images/damian_klekot-100x100.png" class="img-circle" alt=""/>
                        </div>

                        <div class="item">
                            <p>Było przecudnie, szkoda, że nauczycieli w szkołach nie ma z takim podejściem i talentem w
                                przekazywaniu wiedzy :)…no i te kawały</p>
                            <span>Dawid Kowalski, <span>Śrem</span></span>
                            <br/>
                            <img src="images/dawid_kowalski-100x100.png" class="img-circle" alt=""/>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

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
                        <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp"
                               placeholder="Email" required>
                        <small id="emailHelp" class="form-text text-muted">Nigdy nie udostępnimy Twojego adresu email
                            nikomu bez Twojej zgody.
                        </small>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="message"
                                  rows="3" placeholder="Wiadomość" required></textarea>
                    </div>

                    {!! app('captcha')->display() !!}

                    <button type="submit" class="btn btn-ivba rounded-pill">Wyślij</button>
                </form>
            </div>
        </div>
    </section>

@endsection
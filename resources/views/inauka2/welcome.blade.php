@extends('layouts.front')

@section('title', 'Wideo kursy i konferencje  z Excel, Power BI, Photoshop, Prezentacji.')

@section('content')

    @include('layouts._carousel-nav')

    <!-- Learn online courses -->
    <div class="container-fluid learn-online-container">
        <div class="">
            <img class="" src="{{ url('/images/inauka2/orange-big-arrow.svg') }}" alt=""/>
        </div>
        <div class="container">
            <div class="d-flex justify-content-start align-items-center flex-column flex-md-row px-3 px-md-5 gap-4 gap-md-5">
                <div class="order-0 order-md-1">
                    <img class="w-100 mb-5" style="max-height: 232px"
                         src="{{ url('/images/inauka2/illustracja_kursy.png') }}"/>
                </div>
                <div class="order-1 order-md-0">
                    <h2 class="mb-3">Ucz się online na kursach dostosowanych do Twoich potrzeb.</h2>
                    <p>Znajdź kursy na iNauka, które pomogą Ci rozwinąć umiejętności w wybranej dziedzinie. Dołącz do
                        naszej społeczności i zdobywaj certyfikaty uznawane przez pracodawców.</p>
                </div>
            </div>
        </div>
    </div>

    <courses :groups="{{ $groups }}">
        <div class="d-flex flex-row justify-content-end align-items-center gap-2">
            <div style="max-width: 150px;">
                <img class="w-100 h-auto" src="/images/inauka2/programs-icons.png" alt="programs icons"/>
            </div>

            <a class="d-inline-flex align-items-center btn cta_button font-button btn-coral-lg"
               href="{{ url('/buy_access') }}">
                <i class="icon-arrow-right white"></i>
                ODBLOKUJ PEŁNY DOSTĘP
            </a>
        </div>
    </courses>



    {{--Banner Join Us--}}
    <div class="container-fluid mt-5 p-0">
        @include('partials.moving_banner')
    </div>


    {{--Ambasadors container--}}
    <div class="container" style="margin-top: 8rem">
        <div class="text-center">
            <p>Nasi ambasadorzy</p>
            <h2>Monitorowanie przez specjalistów</h2>
        </div>
        <div class="row">
            <div class="col-3">
                <div class="d-flex flex-column align-items-center">
                    <img src="{{ url('/images/inauka2/ambasadors/avatar.svg') }}" alt="ambasadors" class="w-100" style="max-width: 120px"/>
                    <h2 class="fw-normal">Konstancja</h2>
                    <p class="color-red text-uppercase overline">AMBASADORKA</p>
                    <img src="" />
                </div>
            </div>
            <div class="col-3">
                <div class="d-flex flex-column align-items-center">
                    <img src="{{ url('/images/inauka2/ambasadors/avatar.svg') }}" alt="ambasadors" class="w-100" style="max-width: 120px"/>
                    <h2 class="fw-normal">Konstancja</h2>
                    <p class="color-red text-uppercase overline">AMBASADORKA</p>
                    <img src="" />
                </div>
            </div>
            <div class="col-3">
                <div class="d-flex flex-column align-items-center">
                    <img src="{{ url('/images/inauka2/ambasadors/avatar.svg') }}" alt="ambasadors" class="w-100" style="max-width: 120px"/>
                    <h2 class="fw-normal">Konstancja</h2>
                    <p class="color-red text-uppercase overline">AMBASADORKA</p>
                    <img src="" />
                </div>
            </div>
            <div class="col-3">
                <div class="d-flex flex-column align-items-center">
                    <img src="{{ url('/images/inauka2/ambasadors/avatar.svg') }}" alt="ambasadors" class="w-100" style="max-width: 120px"/>
                    <h2 class="fw-normal">Konstancja</h2>
                    <p class="color-red text-uppercase overline">AMBASADORKA</p>
                    <img src="" />
                </div>
            </div>
        </div>
    </div>

    {{--Adv--}}
    <div class="container-fluid p-0 position-relative" style="margin-top: 8rem;">
        <p style="color: transparent">spacer</p>
        <div class="position-absolute d-block">
            <img src="{{ url('/images/inauka2/gradinet.png') }}" class="w-100" alt=""/>
        </div>

        <div class="d-flex flex-column align-items-center mt-5">
            <i class="icon-verified" style="width: 50px; height: 50px"></i>
            <h2 class="h2-headline text-center mb-3">
                Stawiamy na <br>
                <span class="color-red">najwyższą jakość</span> <br>
                naszych materiałów.
            </h2>
            <p class="subtitle-1">
                Dołącz do grona zadowolonych klientów, którzy docenili nasze profesjonalne podejście.
            </p>
        </div>
        <div class="row">
            {{--mobile adv--}}
            <div class="offset-2 col-8 d-lg-none">
                <div id="adv" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ url('/images/inauka2/partners/ing.svg') }}" class="d-block w-100" alt="logo ing">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ url('/images/inauka2/partners/aldi.svg') }}" class="d-block w-100" alt="logo aldi">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ url('/images/inauka2/partners/danone.svg') }}" class="d-block w-100" alt="logo danone">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ url('/images/inauka2/partners/arcelor.mittal.svg') }}" class="d-block w-100" alt="logo arcelor.mittal">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ url('/images/inauka2/partners/dr.oetker.svg') }}" class="d-block w-100" alt="logo dr.oetker">
                        </div>
                    </div>
                </div>
            </div>

            {{--desktop adv--}}
            <div class="container px-5">
                <div class="d-none d-lg-flex justify-content-center align-items-center px-5">
                    <img src="{{ url('/images/inauka2/partners/ing.svg') }}" alt="logo ing">

                    <img src="{{ url('/images/inauka2/partners/aldi.svg') }}" class="d-block w-100" alt="logo aldi">

                    <img src="{{ url('/images/inauka2/partners/danone.svg') }}" class="d-block w-100" alt="logo danone">

                    <img src="{{ url('/images/inauka2/partners/arcelor.mittal.svg') }}" class="d-block w-100" alt="logo arcelor.mittal">

                    <img src="{{ url('/images/inauka2/partners/dr.oetker.svg') }}" class="d-block w-100" alt="logo dr.oetker">
                </div>
            </div>
    </div>


    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-center">
                    <p class="h4-headline">Co zyskasz, ucząc się wspólnie z nami?</p>
                </div>
            </div>
        </div>

        {{--Desktop view--}}
        <div class="row d-none d-lg-flex">
            <div class="col-6 mt-4 p-4 g-4">
                <div class="row">
                    <div class="col-8">
                        <h2 class="h4-headline color-red rounded p-3 mb-4" style="background-color: #FF68410A">
                            Imienne certyfikaty
                        </h2>
                        <p class="h6-headline color-graphite-light">
                            Otrzymaj imienny certyfikat, który wyróżni Cię na rynku pracy.
                        </p>
                    </div>
                    <div class="col-4">
                        <img src="{{ url('/images/inauka2/learning/pencil-cert.svg') }}" class="d-block w-100" alt="pencil image">
                    </div>
                </div>
            </div>

            <div class="col-6 mt-4 p-4 rounded" style="background: transparent linear-gradient(249deg, #FD5429 0%, #F99140 100%) 0% 0% no-repeat padding-box;">
                <div class="row">
                    <div class="col-4">
                        <img src="{{ url('/images/inauka2/learning/cup.svg') }}" class="d-block w-100" alt="cup image">
                    </div>
                    <div class="col-8">
                        <h2 class="h4-headline text-white p-3 mb-4">
                            Ścieżki rozwojuńmin
                        </h2>
                        <p class="h6-headline text-white">
                            Ukończ wybrane ścieżki, aby zdobyć kluczowe umiejętności w swojej branży.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-7 mt-4 p-4">
                <div class="row">
                    <div class="col-8">
                        <h2 class="h4-headline color-red rounded p-3 mb-4" style="background-color: #FF68410A">
                            Wsparcie
                        </h2>
                        <p class="h6-headline color-graphite-light">
                            Otrzymaj pomoc od społeczności na Facebooku i ekspertów mailowo.
                        </p>
                    </div>
                    <div class="col-4">
                        <img src="{{ url('/images/inauka2/learning/connect.svg') }}" class="d-block w-100" alt="connect image">
                    </div>
                </div>
            </div>

            <div class="col-5 mt-4 p-4">
                <div class="row">
                    <div class="col-6">
                        <h2 class="h4-headline color-red rounded p-3 mb-4" style="background-color: #FF68410A">
                            Ćwiczenia
                        </h2>
                        <p class="h6-headline color-graphite-light">
                            Ćwicz pod okiem ekspertów, aby lepiej przyswoić materiał z lekcji.
                        </p>
                    </div>
                    <div class="col-6">
                        <img src="{{ url('/images/inauka2/learning/pencil-book.svg') }}" class="d-block w-100" alt="connect image">
                    </div>
                </div>
            </div>

            <div class="col-6 mt-4 p-4 rounded" style="background-color: #48CBEA">
                <div class="row">
                    <div class="col-8">
                        <h2 class="h4-headline text-white rounded p-3 mb-4" style="background-color: rgba(255, 255, 255, 0.2)">
                            Aktualizacje
                        </h2>
                        <p class="h6-headline text-white">
                            Co miesiąc dodajemy nowy kurs lub szkolenie.
                        </p>
                    </div>
                    <div class="col-4">
                        <img src="{{ url('/images/inauka2/learning/computer-white.svg') }}" class="d-block w-100" alt="computer image">
                    </div>
                </div>
            </div>

            <div class="col-6 mt-4 p-4">
                <div class="row">
                    <div class="col-8">
                        <h2 class="h4-headline color-red rounded p-3 mb-4" style="background-color: #FF68410A">
                            Egzaminy sprawdzające
                        </h2>
                        <p class="h6-headline color-graphite-light">
                            Sprawdź swoje umiejętności dzięki testom końcowym i zdobądź certyfikat.
                        </p>
                    </div>
                    <div class="col-4">
                        <img src="{{ url('/images/inauka2/learning/file-pencil.svg') }}" class="d-block w-100" alt="file pencil image">
                    </div>
                </div>
            </div>

        </div>

        {{--Mobile view--}}
        <div class="offset-2 col-8 d-lg-none">
            <div id="adv" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators pt-5">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="5" aria-label="Slide 6"></button>
                </div>

                <div class="carousel-inner" style="min-height: 32rem">
                    <div class="carousel-item active">
                        <img src="{{ url('/images/inauka2/learning/pencil-cert.svg') }}" class="d-block w-100" alt="pencil image" style="max-height: 14rem">
                        <p class="h5-headline text-center mt-5 color-red rounded p-3" style="background-color: #FF68410A">
                            Imienne certyfikaty
                        </p>
                        <p class="h6-headline color-graphite my-3">
                            Otrzymaj imienny certyfikat, który wyróżni Cię na rynku pracy.
                        </p>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ url('/images/inauka2/learning/cup.svg') }}" class="d-block w-100" alt="cup image" style="max-height: 14rem">
                        <p class="h5-headline text-center mt-5 color-red rounded p-3" style="background-color: #FF68410A">
                            Ścieżki rozwoju
                        </p>
                        <p class="h6-headline color-graphite my-3">
                            Ukończ wybrane ścieżki, aby zdobyć kluczowe umiejątnności w swojej branności.
                        </p>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ url('/images/inauka2/learning/connect.svg') }}" class="d-block w-100" alt="connect image" style="max-height: 14rem">
                        <p class="h5-headline text-center mt-5 color-red rounded p-3" style="background-color: #FF68410A">
                            Wsparcie
                        </p>
                        <p class="h6-headline color-graphite my-3">
                            Otrzymaj pomoc od społeczności na Facebooku i ekspertów mailowo.
                        </p>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ url('/images/inauka2/learning/pencil-book.svg') }}" class="d-block w-100" alt="connect image" style="max-height: 14rem">
                        <p class="h5-headline text-center mt-5 color-red rounded p-3" style="background-color: #FF68410A">
                            Ćwiczenia
                        </p>
                        <p class="h6-headline color-graphite my-3">
                            Ćwicz pod okiem ekspertów, aby lepiej przyswoć materiał z lekcji.
                        </p>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ url('/images/inauka2/learning/pencil-computer.svg') }}" class="d-block w-100" alt="connect image" style="max-height: 14rem">
                        <p class="h5-headline text-center mt-5 color-red rounded p-3" style="background-color: #FF68410A">
                            Aktualizacje
                        </p>
                        <p class="h6-headline color-graphite my-3">
                            Co miesiąc dodajemy nowy kurs lub szkolenie.
                        </p>
                    </div>
                    <div class="carousel-item">
                        <img src="{{ url('/images/inauka2/learning/file-pencil.svg') }}" class="d-block w-100" alt="file pencil image" style="max-height: 14rem">
                        <p class="h5-headline text-center mt-5 color-red rounded p-3" style="background-color: #FF68410A">
                            Egzaminy sprawdzające
                        </p>
                        <p class="h6-headline color-graphite my-3">
                            Sprawdź swoje umiejętności dzięki testom końcowym i zdobądź certyfikat.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{--Platform opinions--}}
    <div class="container-fluid px-0 mt-5">
        <div class="row">
            <div class="col-12">
                <div class="d-flex flex-column justify-content-center">
                    <p class="text-center">Opinie o platformie</p>
                    <h2 class="text-center">
                        Twoje zadowolenie to nasz <span>priorytet</span>
                    </h2>
                    {{--Mobile--}}
                    <div class="offset-2 offset-md-3 col-8 col-md-6">
                        <div id="adv" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-indicators pt-5">
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="5" aria-label="Slide 6"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="6" aria-label="Slide 7"></button>
                            </div>

                            <div class="carousel-inner opinion-indicators">
                                <div class="carousel-item active">
                                    <div class="p-4">
                                        <div class="row">
                                            <div class="col-12 mb-4">
                                                <img src="{{ url('/images/inauka2/opinions/People Avatar-02-12.svg') }}" alt="avatar logo" style="max-width: 60px" />
                                            </div>
                                            <div class="col-12 color-graphite-light mb-5">
                                                Szkolenia iNauka pozwoliły mi na prowadzeniu szeregu usprawnień w Firmie. Pomimo ciągłej pracy na Excelu, moje analizy są teraz zdecydowanie bardziej profesjonalne.
                                            </div>
                                            <div class="col-12">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <span class="fw-bold subtitle-2">Łukasz Kutyłowski</span> <br>
                                                        <span class="body-2">Opinia przesłana przez e-mail</span>
                                                    </div>
                                                    <div class="mt-auto">
                                                        <img src="{{ url('/images/inauka2/inauka-logo.svg') }}" alt="logo" style="max-width: 60px" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="p-4">
                                        <div class="row">
                                            <div class="col-12 mb-4">
                                                <img src="{{ url('/images/inauka2/opinions/People Avatar-02-05.svg') }}" alt="avatar logo" style="max-width: 60px" />
                                            </div>
                                            <div class="col-12 color-graphite-light mb-5">
                                                Przede wszystkim dziękuję za ogromną dawkę wiedzy i pokazanie narzędzi takich jak Power Query! Już mam kilka pomysłów jak mogłabym wykorzystać tą wiedzę w pracy.
                                            </div>
                                            <div class="col-12">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <span class="fw-bold subtitle-2">Ewelina Wysocka</span> <br>
                                                        <span class="body-2">Opinia przesłana przez e-mail</span>
                                                    </div>
                                                    <div class="mt-auto">
                                                        <img src="{{ url('/images/inauka2/inauka-logo.svg') }}" alt="logo" style="max-width: 60px" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="p-4">
                                        <div class="row">
                                            <div class="col-12 mb-4">
                                                <img src="{{ url('/images/inauka2/opinions/People Avatar-02-13.svg') }}" alt="avatar logo" style="max-width: 60px" />
                                            </div>
                                            <div class="col-12 color-graphite-light mb-5">
                                                Polecam! Fajny sposób na przypomnienie sobie pracy w Excelu jak i możliwość nauczenia się nowych rzeczy 💪
                                            </div>
                                            <div class="col-12">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <span class="fw-bold subtitle-2">Katarzyna Tkacz-Duda</span> <br>
                                                        <span class="body-2">Opinia przesłana komentarz na Facebooku</span>
                                                    </div>
                                                    <div class="mt-auto">
                                                        <img src="{{ url('/images/inauka2/inauka-logo.svg') }}" alt="logo" style="max-width: 60px" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="p-4">
                                        <div class="row">
                                            <div class="col-12 mb-4">
                                                <img src="{{ url('/images/inauka2/opinions/People Avatar-02-19.svg') }}" alt="avatar logo" style="max-width: 60px" />
                                            </div>
                                            <div class="col-12 color-graphite-light mb-5">
                                                Jestem od dawna Waszą wielką fanką. :) Robicie cudowną robotę na Mega Sobotach i maratonach.
                                            </div>
                                            <div class="col-12">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <span class="fw-bold subtitle-2">Agata Szulc-Maj</span> <br>
                                                        <span class="body-2">Opinia przesłana przez e-mail</span>
                                                    </div>
                                                    <div class="mt-auto">
                                                        <img src="{{ url('/images/inauka2/inauka-logo.svg') }}" alt="logo" style="max-width: 60px" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="p-4">
                                        <div class="row">
                                            <div class="col-12 mb-4">
                                                <img src="{{ url('/images/inauka2/opinions/People Avatar-02-06.svg') }}" alt="avatar logo" style="max-width: 60px" />
                                            </div>
                                            <div class="col-12 color-graphite-light mb-5">
                                                Dziękuje za bardzo interesujące i dokładnie przeprowadzone szkolenie. Bardzo dużo nowych informacji.
                                            </div>
                                            <div class="col-12">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <span class="fw-bold subtitle-2">Paweł Kabat</span> <br>
                                                        <span class="body-2">Opinia przesłana przez e-mail</span>
                                                    </div>
                                                    <div class="mt-auto">
                                                        <img src="{{ url('/images/inauka2/inauka-logo.svg') }}" alt="logo" style="max-width: 60px" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="p-4">
                                        <div class="row">
                                            <div class="col-12 mb-4">
                                                <img src="{{ url('/images/inauka2/opinions/People Avatar-02-17.svg') }}" alt="avatar logo" style="max-width: 60px" />
                                            </div>
                                            <div class="col-12 color-graphite-light mb-5">
                                                Szkolenie świetne, jest świetnie prowadzone. Mateusz top of the top! Dzięki!
                                            </div>
                                            <div class="col-12">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <span class="fw-bold subtitle-2">Aleksandra Bala</span> <br>
                                                        <span class="body-2">Opinia przesłana przez e-mail</span>
                                                    </div>
                                                    <div class="mt-auto">
                                                        <img src="{{ url('/images/inauka2/inauka-logo.svg') }}" alt="logo" style="max-width: 60px" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="p-4">
                                        <div class="row">
                                            <div class="col-12 mb-4">
                                                <img src="{{ url('/images/inauka2/opinions/People Avatar-02-09.svg') }}" alt="avatar logo" style="max-width: 60px" />
                                            </div>
                                            <div class="col-12 color-graphite-light mb-5">
                                                Jesteście Panowie bardzo komunikatywni i życzliwie nastawieni do uczestników, którzy są różni. Gratuluję profesjonalizmu!
                                            </div>
                                            <div class="col-12">
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <span class="fw-bold subtitle-2">Julita Kacprowicz</span> <br>
                                                        <span class="body-2">Opinia przesłana przez e-mail</span>
                                                    </div>
                                                    <div class="mt-auto">
                                                        <img src="{{ url('/images/inauka2/inauka-logo.svg') }}" alt="logo" style="max-width: 60px" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing " style="margin-top: 20rem">

        <!-- Three columns of text below the carousel -->
        <div class="row">
            <div class="col-lg-4">
                <svg class="bd-placeholder-img rounded-circle" width="140" height="140"
                     xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder"
                     preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title>
                    <rect width="100%" height="100%" fill="var(--bs-secondary-color)"/>
                </svg>
                <h2 class="fw-normal">Heading</h2>
                <p>Some representative placeholder content for the three columns of text below the carousel. This is the
                    first column.</p>
                <p><a class="btn btn-secondary" href="#">View details &raquo;</a></p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4">
                <svg class="bd-placeholder-img rounded-circle" width="140" height="140"
                     xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder"
                     preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title>
                    <rect width="100%" height="100%" fill="var(--bs-secondary-color)"/>
                </svg>
                <h2 class="fw-normal">Heading</h2>
                <p>Another exciting bit of representative placeholder content. This time, we've moved on to the second
                    column.</p>
                <p><a class="btn btn-secondary" href="#">View details &raquo;</a></p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4">
                <svg class="bd-placeholder-img rounded-circle" width="140" height="140"
                     xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder"
                     preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title>
                    <rect width="100%" height="100%" fill="var(--bs-secondary-color)"/>
                </svg>
                <h2 class="fw-normal">Heading</h2>
                <p>And lastly this, the third column of representative placeholder content.</p>
                <p><a class="btn btn-secondary" href="#">View details &raquo;</a></p>
            </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->


        <!-- START THE FEATURETTES -->

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7">
                <h2 class="featurette-heading fw-normal lh-1">First featurette heading. <span
                            class="text-body-secondary">It’ll blow your mind.</span></h2>
                <p class="lead">Some great placeholder content for the first featurette here. Imagine some exciting
                    prose here.</p>
            </div>
            <div class="col-md-5">
                <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500"
                     height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500"
                     preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title>
                    <rect width="100%" height="100%" fill="var(--bs-secondary-bg)"/>
                    <text x="50%" y="50%" fill="var(--bs-secondary-color)" dy=".3em">500x500</text>
                </svg>
            </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7 order-md-2">
                <h2 class="featurette-heading fw-normal lh-1">Oh yeah, it’s that good. <span
                            class="text-body-secondary">See for yourself.</span></h2>
                <p class="lead">Another featurette? Of course. More placeholder content here to give you an idea of how
                    this layout would work with some actual real-world content in place.</p>
            </div>
            <div class="col-md-5 order-md-1">
                <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500"
                     height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500"
                     preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title>
                    <rect width="100%" height="100%" fill="var(--bs-secondary-bg)"/>
                    <text x="50%" y="50%" fill="var(--bs-secondary-color)" dy=".3em">500x500</text>
                </svg>
            </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7">
                <h2 class="featurette-heading fw-normal lh-1">And lastly, this one. <span class="text-body-secondary">Checkmate.</span>
                </h2>
                <p class="lead">And yes, this is the last block of representative placeholder content. Again, not really
                    intended to be actually read, simply here to give you a better view of what this would look like
                    with some actual content. Your content.</p>
            </div>
            <div class="col-md-5">
                <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500"
                     height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500"
                     preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title>
                    <rect width="100%" height="100%" fill="var(--bs-secondary-bg)"/>
                    <text x="50%" y="50%" fill="var(--bs-secondary-color)" dy=".3em">500x500</text>
                </svg>
            </div>
        </div>

        <hr class="featurette-divider">

        <!-- /END THE FEATURETTES -->

    </div><!-- /.container -->

@endsection

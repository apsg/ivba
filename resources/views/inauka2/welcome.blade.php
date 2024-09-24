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

    <div class="container mt-5">
        @include('partials.moving_banner')
    </div>

    <div class=" mt-5 py-5 bg-white">
        @include('partials.ambassadors')
    </div>

@endsection

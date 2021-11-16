@extends('layouts.html')

@section('body')
    <body class="buyaccess w-100 d-flex align-content-center justify-content-center">
    <div id="app" class="cover-container w-75 d-flex flex-column justify-content-center">
        <div>
            <a href="{{ url()->previous() }}" class="text-gray">
                <i class="fa fa-caret-left"></i> Wróć
            </a>
        </div>
        <div class="h-75 rounded inner p-3">
            @yield('content')
        </div>
        <div class="pt-5">
            <img class="ml-5" src="{{ asset('/images/internetowisprzedawcy/logo_szare.png') }}" />
            <img class="ml-5" src="{{ asset('/images/internetowisprzedawcy/bezpieczna.png') }}" />
        </div>
    </div>
@endsection

@extends('layouts.front2')

@section('title', 'Prosty dostęp')

@php
    Session::put('url.intended', URL::full());
@endphp

@section('content')
    <section class="page content">
        <div class="container">
            <h2>Wykup dostęp</h2>
            @if(!Auth::check())
                <p>Zaloguj się, by wykupić abonament lub pełen dostęp.</p>
                <a href="{{ url('/login') }}" class="btn btn-primary">Zaloguj</a>
            @elseif(Gate::denies('can-buy-subscription'))
                <p>Aby kontynuować proces zakupu abonamentu musisz uzupełnić dane rozliczeniowe swojego
                    konta. </p>
                <hr/>
                @include('partials.user_details_form')
            @else
                @if( Auth::check() && Auth::user()->full_access_expires && Auth::user()->full_access_expires->isFuture() )
                    <p>Masz aktywny pełen dostęp - nie możesz wykupić abonamentu</p>
                @elseif(Auth::check() && Auth::user()->hasActiveSubscription())
                    <p>Masz już aktywny abonament</p>
                @else
                    @include('partials.buy_access.easy_access')
                @endif
            @endif
        </div>
    </section>
@endsection


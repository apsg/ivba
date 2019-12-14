@extends('layouts.front2')

@section('title', 'Kup dostęp')

@php
    Session::put('url.intended', URL::full());
@endphp

@section('content')
    <section class="page content">
        <div class="container">
            <h2>Wykup abonament</h2>

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
                    @include('partials.buy_access.subscription')
                @endif

                <hr/>
                @include('partials.buy_access.full_access')
            @endif
            <hr/>
        </div>
    </section>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#rules').change(function () {
                if ($(this).is(':checked')) {
                    $("#pay-button").prop('disabled', false);
                } else {
                    $("#pay-button").prop('disabled', true);
                }
            });
        });
    </script>
@endpush
@extends('layouts.buyaccess')

@section('title', 'Kup dostęp')

@php
    Session::put('url.intended', URL::full());
@endphp

@section('content')
    <section class="page content">
        <div class="container">

            <order
                    price="{{ number_format(setting('ivba.full_access_price'), 2) }}"
                    rules_link="{{ setting('is.rules_link') }}"
                    :user="{{ Auth::user() ?? "{}" }}"
            ></order>

        </div>
    </section>
@endsection


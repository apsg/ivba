@extends('layouts.front2')

@section('title', 'Kup dostęp')

@php
    Session::put('url.intended', URL::full());
@endphp

@section('content')
    <section class="page content">
        <div class="container">
            <h2>Wykup abonament</h2>

            {!! $gate !!}
            <hr/>
        </div>
    </section>
@endsection

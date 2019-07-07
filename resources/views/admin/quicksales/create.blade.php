@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class="active">Szybka sprzedaż</li>
@endpush

@section('pagename', 'Szybka sprzedaż')
@section('pagesubname', 'Dodaj')

@section('content')
    <div class="container">
        <form action="{{ url('/admin/quicksales') }}" method="post">
            @csrf
            @include('admin.quicksales.partial_form')
            <button class="btn btn-ivba">Dodaj</button>
        </form>
    </div>
@endsection

@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class="active">Logbook</li>
@endpush

@section('pagename', 'Logbook')
@section('pagesubname', 'Dodaj')

@section('content')
    <div class="container">
        <form action="{{ url('/admin/logbooks') }}" method="post">
            @csrf
            @include('admin.logbooks.partial_form')
            <button class="btn btn-ivba">Zapisz i przejdź do dodawania kursów ></button>
        </form>
    </div>
@endsection

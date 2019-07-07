@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class="active">Szybka sprzedaż</li>
@endpush

@section('pagename', 'Szybka sprzedaż')
@section('pagesubname', 'Lista')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <a href="{{ url('/admin/quicksales/create') }}" class="btn btn-primary">
                    <i class="fa fa-4x fa-plus"></i><br/>
                    Dodaj nową
                </a>
            </div>
        </div>
    </div>

@endsection

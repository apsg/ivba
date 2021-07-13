@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li><a href="{{ url('admin/quicksales') }}">Szybka sprzedaż</a></li>
    <li class="active">{{ $quickSale->id }}</li>
@endpush

@section('pagename', 'Szybka sprzedaż: '. $quickSale->name)
@section('pagesubname', 'podgląd')

@section('content')
    <div class="container">
        <div class="col-12 card mb-3">
            <div class="card-body">
                <a href="{{ $quickSale->link }}" target="_blank">{{ $quickSale->link }}</a>
            </div>
        </div>
        <div class="col-md-12">
            <form action="{{ route('admin.quicksale.update', ['quickSale' => $quickSale]) }}" method="post">
                @csrf
                @method('PUT')
                @include('admin.quicksales.partial_form')
                <button class="btn btn-ivba">Zapisz <i class="fa fa-save"></i></button>
            </form>
        </div>

        <div class="col-md-12 pb-5">
            <hr/>
            <h3>Statystyki zakupów</h3>
            <p>Zamówiono: <strong>{{ $quickSale->orders()->count() }} razy</strong>, w tym
                potwierdzono <strong>{{ $quickSale->confirmed_orders()->count() }}</strong> razy.</p>

            <a href="{{ url('/admin/quicksales/'.$quickSale->id.'/report') }}" class="btn btn-primary">
                <i class="fa fa-download"></i>
                Pobierz raport
            </a>
        </div>

    </div>
@endsection

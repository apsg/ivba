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
        <div class="row mt-4">
            @foreach($quickSales as $sale)
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">{{ $sale->name }}</h5>
                            <div class="d-flex justify-content-between">
                                <div>
                                    <strong>Cena:</strong> {{ $sale->price }} <br/>
                                    @if($sale->full_price !== null)
                                        <strong>Przcena z: </strong> {{ $sale->full_price }}
                                    @endif
                                </div>
                                <div class="">
                                    <pre><code>{{ $sale->link }}</code></pre>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{{ $sale->description }}</p>
                            <p class="card-text"><strong>Kurs #{{ $sale->course->id }}</strong> - {{ $sale->course->title }}</p>

                        </div>
                        <div class="card-footer text-muted d-flex justify-content-between">
                            <div>
                                {{ $sale->created_at->diffForHumans() }}
                            </div>
                            <div class="d-flex">
                                <a href="{{ url('/admin/quicksales/'.$sale->id) }}"
                                   class="btn btn-primary mr-3">Zobacz</a>
                                <form action="{{ url('/admin/quicksales/'. $sale->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger confirm"><i class="fa fa-trash"></i> Usuń</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection

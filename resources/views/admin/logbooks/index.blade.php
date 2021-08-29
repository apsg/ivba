@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class="active">Logbooki</li>
@endpush

@section('pagename', 'Logbooki')
@section('pagesubname', 'Lista')

@section('content')
    <div class="container ">
        <div class="row">
            <div class="col-md-2">
                <a href="{{ route('admin.logbooks.create') }}" class="btn btn-primary">
                    <i class="fa fa-4x fa-plus"></i><br/>
                    Dodaj nowy
                </a>
            </div>
        </div>
        <div class="row mt-4 card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th> Nazwa</th>
                        <th>Opcje</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($logbooks as $logbook)
                        <tr>
                            <td>
                                <a href="{{ route('admin.logbooks.edit', $logbook) }}">
                                    #{{ $logbook->id }} - {{ $logbook->title }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('admin.logbooks.edit', $logbook) }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.logbooks.destroy', $logbook) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-sm btn-danger confirm">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

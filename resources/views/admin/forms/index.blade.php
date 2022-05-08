@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class="active">Formularze</li>
@endpush

@section('pagename', 'Formularze')
@section('pagesubname', 'Lista')

@section('content')
    <div class="container ">
        <div class="row">
            <div class="col-md-2">
                <a href="{{ route('admin.forms.create') }}" class="btn btn-primary">
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
                        <th>Nazwa</th>
                        <th>Kurs</th>
                        <th>Opcje</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($forms as $form)
                        <tr>
                            <td>
                                {{ $form->name }}
                            </td>
                            <td>
                                {{ $form->course->title }}
                            </td>
                            <td>
                                <a href="{{ route('admin.forms.view', $form) }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <form action="{{ route('admin.forms.destroy', $form) }}" method="post"
                                      class="d-inline">
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

@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class="active">Autorzy</li>
@endpush

@section('pagename', 'Autorzy')
@section('pagesubname', 'Lista')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Dodaj nowy:</h3>
                        <div>
                            <form
                                    action="{{ route('admin.authors.store') }}"
                                    method="post">
                                <table class="table">
                                    @include('admin.authors._form')
                                </table>
                            </form>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <td>
                                    <h3>Autorzy:</h3>
                                </td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($authors as $author)
                                <tr>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <form action="{{ route('admin.authors.update', $author)}}" method="post">
                                                    @include('admin.authors._form')
                                                </form>
                                            </div>
                                            <div class="col-md-1">

                                                <form action="{{ route('admin.authors.destroy', $author) }}"
                                                      method="post"
                                                >
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit"
                                                            class="btn btn-secondary">
                                                        <i class="fa fa-trash"></i>
                                                        Usuń
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!-- /.box -->
            </div>
        </div>
    </section>
@endsection

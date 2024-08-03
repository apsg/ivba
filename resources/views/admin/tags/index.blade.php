@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class="active">Etykiety</li>
@endpush

@section('pagename', 'Etykiety')
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
                                    action="{{ route('admin.tags.store') }}"
                                    method="post">
                                <table class="table">
                                    @include('admin.tags._form')
                                </table>
                            </form>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <td>
                                    <h3>Zdefiniowane etykiety:</h3>
                                </td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tags as $tag)
                                <tr>
                                    <td>
                                        <div class="row">
                                            <div class="col-md-1 p-3">
                                                <span class="p-3 text-center font-weight-bold rounded"
                                                      style="background-color: {{ $tag->color }}; color: {{ $tag->text_color }}">
                                                    {{ $tag->name }}
                                                </span>
                                            </div>
                                            <div class="col-md-10">
                                                <form action="{{ route('admin.tags.update', $tag)}}" method="post">
                                                    @include('admin.tags._form')
                                                </form>
                                            </div>
                                            <div class="col-md-1">

                                                <form action="{{ route('admin.tags.destroy', $tag) }}"
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

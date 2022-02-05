@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class="active">Strony</li>
@endpush

@section('pagename', 'Wpisy')
@section('pagesubname', 'Lista')

@include('admin.partials.medialibrary')

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Aktualnie dodane wpisy</h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        @forelse($posts as $post)
                            <ul>
                                <a href="{{ url('/admin/posts/'.$post->id) }}">{{ $post->title }}</a>
                            </ul>
                        @empty
                            <p>Brak wpisów. Dodaj jakiś.</p>
                        @endforelse
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        -
                    </div><!-- box-footer -->
                </div><!-- /.box -->
            </div>
        </div>
    </section>
@endsection

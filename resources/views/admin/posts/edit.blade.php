@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class=""><a href="{{ url('/admin/posts') }}">Wpisy</a></li>
    <li class="active">Nowy</li>
@endpush

@section('pagename', 'Lekcje')
@section('pagesubname', 'nowa')

@include('admin.partials.medialibrary')
@include('admin.partials.videolibrary')

@section('content')

    @include('admin.partials.course_errors')

    <section class="content">
        <form action="{{ url('admin/posts/'.$post->id) }}" method="post">
            @include('admin.posts._form')
        </form>
    </section>

@endsection

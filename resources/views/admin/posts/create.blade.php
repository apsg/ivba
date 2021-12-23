@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class=""><a href="{{ url('/admin/lesson') }}">Lekcje</a></li>
    <li class="active">Kurs #{{ $lesson->id }}</li>
@endpush

@section('pagename', 'Lekcje')
@section('pagesubname', $lesson->title)

@include('admin.partials.medialibrary')
@include('admin.partials.videolibrary')

@section('content')

    @include('admin.partials.course_errors')



@endsection

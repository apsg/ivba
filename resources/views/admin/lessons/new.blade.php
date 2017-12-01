@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class=""><a href="{{ url('/admin/lesson') }}">Lekcje</a></li>
    <li class="active">Nowa</li>
@endpush

@section('pagename', 'Lekcje')
@section('pagesubname', 'Nowa lekcja')

@include('admin.partials.medialibrary')
@include('admin.partials.videolibrary')

@section('content')

@include('admin.partials.course_errors')

<section class="content">
	<form action="{{ url('admin/lesson') }}" method="post">
		@include('admin.partials.lesson_form')
	</form>
</section>
@endsection

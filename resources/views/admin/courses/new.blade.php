@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class=""><a href="{{ url('/admin/courses') }}">Kursy</a></li>
    <li class="active">Nowy</li>
@endpush

@section('pagename', 'Kursy')
@section('pagesubname', 'Nowy kurs')

@include('admin.partials.medialibrary')

@section('content')

@include('admin.partials.course_errors')

<section class="content">
	<form action="{{ url('admin/courses') }}" method="post">
		@include('admin.partials.course_form')
	</form>
</section>
@endsection

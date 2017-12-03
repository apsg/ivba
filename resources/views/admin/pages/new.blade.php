@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class=""><a href="{{ url('/admin/pages') }}">Strony</a></li>
    <li class="active">Nowa</li>
@endpush

@section('pagename', 'Strony')
@section('pagesubname', 'Nowa strona')

@section('content')

@include('admin.partials.course_errors')

<section class="content">
	<form action="{{ url('admin/pages') }}" method="post">
		@include('admin.pages.page_form')
	</form>
</section>
@endsection

@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class=""><a href="{{ url('/admin/pages') }}">Newslettery</a></li>
    <li class="active">Nowa</li>
@endpush

@section('pagename', 'Newslettery')
@section('pagesubname', 'Nowa strona')

@include('admin.partials.medialibrary')

@section('content')

@include('admin.partials.course_errors')

<section class="content">
	<form action="{{ url('admin/newsletters') }}" method="post" enctype="multipart/form-data">
		@include('admin.newsletters.newsletter_form')
	</form>
</section>
@endsection

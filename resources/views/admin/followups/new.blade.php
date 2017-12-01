@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class=""><a href="{{ url('/admin/pages') }}">Followupy</a></li>
    <li class="active">Nowa</li>
@endpush

@section('pagename', 'Followupy')
@section('pagesubname', 'Nowy')

@include('admin.partials.medialibrary')

@section('content')

@include('admin.partials.course_errors')

<section class="content">
	<form action="{{ url('admin/followups') }}" method="post" enctype="multipart/form-data">
		@include('admin.followups.followup_form')
	</form>
</section>
@endsection

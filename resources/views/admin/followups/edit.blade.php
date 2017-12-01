@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class=""><a href="{{ url('/admin/pages') }}">Followupy</a></li>
    <li class="active">Edytuj</li>
@endpush

@section('pagename', 'Followupy')
@section('pagesubname', 'Edytuj')

@include('admin.partials.medialibrary')

@section('content')

@include('admin.partials.course_errors')

<section class="content">
	<form action="{{ url('admin/followups/'.$followup->id) }}" method="post" enctype="multipart/form-data">
		{{ method_field('patch') }}
		@include('admin.followups.followup_form')
		
	</form>
</section>
@endsection

@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class="active">Formularz</li>
@endpush

@section('pagename', 'Formularz')
@section('pagesubname', 'Podgląd')

@section('content')
    <div class="container">
        <h3><strong>{{ $form->name }}</strong> dla kursu {{ $form->course->title }}</h3>
    </div>
    <form-answers :form="{{ $form }}"></form-answers>
@endsection

@extends('layouts.learn')

@section('title')
    {{ config('app.name') }} |
    {{ $course->title }} |
    {{ $form->name }}
@endsection

@section('navbar')
@endsection

@section('sidebar')
    @include('learn.sidebar')
@endsection

@section('content')
    <h1 class="page-header border-bottom pl-3">
        {{ $form->name }}
    </h1>
    <div class="col-md-12">
        @include('common.forms.new')
    </div>
    <div class="col-md-12">
        @include('common.forms.index')
    </div>
@endsection

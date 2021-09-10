@extends('layouts.learn')

@section('title')
    {{ config('app.name') }} |
    {{ $course->title }} |
    Logbook: {{ $logbook->title }}
@endsection

@section('navbar')
@endsection

@section('sidebar')
    @include('learn.sidebar')
@endsection

@section('content')
    <h1 class="page-header">
        Twój dziennik aktywności: {{ $logbook->title }}
    </h1>
    <div class="col-md-12">
        {!! $logbook->description !!}
    </div>
    <div class="col-md-12">
        @include('common.logbooks.new')
    </div>
    <div class="col-md-12">
        @include('common.logbooks.list')
    </div>
@endsection

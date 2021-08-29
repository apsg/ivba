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
        {{ $question->title }}
    </h1>
    <div class="col-md-12">
        {!! $question->content !!}
    </div>
    <div class="col-md-12">
    </div>
@endsection

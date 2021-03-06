@extends('layouts.learn')

@section('title')
    {{ config('app.name') }} |
    {{ $quiz->name }}
@endsection

@section('navbar')
@endsection

@section('sidebar')
    @include('learn.sidebar')
@endsection

@section('content')
    <div class="rounded-50 p-5 bg-white">
        <h1 class="page-header">
            Rozpoczynasz test: {{ $quiz->name }}
        </h1>
        <div class="col-md-12">
            @if( ! \Auth::user()->hasFinishedAllLessons($course->id))
                <p>Uwaga! Rozpoczęcie testu oznaczy wszystkie lekcje jako zakończone</p>
            @endif
            <p>Czy na pewno chcesz rozpocząć ten test? Do rozpoczętego testu będzie można powrócić, jeśli przerwiesz
                jego wykonywanie. Nie będzie możliwości powrotu do pytań, na które już odpowiedziano.</p>
            <p>Po zakończeniu testu będzie można ponownie podejść do niego po 14 dniach.</p>
            <hr/>
            <p>Chcesz rozpocząć ten test?</p>
            <a href="{{ $quiz->startUrl() }}" class="btn btn-ivba">Rozpocznij test</a>
        </div>
    </div>
@endsection

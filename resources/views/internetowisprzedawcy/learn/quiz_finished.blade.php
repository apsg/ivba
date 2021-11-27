@extends('layouts.learn')

@section('title')
    {{ config('app.name') }} |
    {{ $quiz->name }} | Zakończono
@endsection

@section('navbar')
@endsection

@section('sidebar')
    @include('learn.sidebar')
@endsection

@section('content')
    <div class="rounded-50 p-5 bg-white">
        <h1 class="page-header">
            Zakończono test: {{ $quiz->name }}
        </h1>
        <div class="col-md-12">
            <h5>Twój wynik to: </h5>
            <h3>{{ $quiz->pivot->points }}/{{ $quiz->max_points }} pkt.</h3>
            @if( $quiz->pivot->is_pass )
                <div class="alert alert-success">Zdany!</div>
            @else
                <div class="alert alert-danger">Niezaliczony</div>
            @endif
            <hr/>
            @if( Gate::allows('retake-quiz', $quiz) )
                <a class="btn btn-ivba" href="{{ $quiz->resetLink() }}">Podejdź ponownie do testu</a>
            @else
                <p>Możesz kolejny raz podejść do testu
                    dnia: {{ \Carbon\Carbon::parse( $quiz->pivot->finished_date)->addDays(14) }}
                </p>
            @endif

            @if(Gate::allows('admin') && app()->isLocal())
                <a href="{{ $quiz->resetLink() }}">Reset</a>
            @endif

            <hr/>
            <a href="{{ $quiz->course->next() }}" class="btn btn-ivba">Dalej <i class="fa fa-chevron-right"></i> </a>
        </div>
    </div>
@endsection

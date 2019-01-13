@extends('layouts.learn')

@section('title')
    iVBA |
    {{ $course->title }}
@endsection

@section('navbar')
@endsection

@section('sidebar')
    @include('learn.sidebar')
@endsection

@section('content')
    <h1 class="page-header">
        Zakończono kurs: {{ $course->title }}
    </h1>
    <div class="row">
        @if( !empty($course->certificate) )

            @if( \Auth::user()->hasPassedCourse( $course->id ) && !empty($course->user_certificate) )
                <a class="btn btn-success" href="{{ $course->user_certificate->getDownloadUrl() }}">Ściągnij certyfikat
                    ukończenia kursu</a>
                <p>Na certyfikacie widnieją złe dane? Wpisz swoje poprawne imię i nazwisko w <a
                            href="{{url('/account')}}" target="_blank">ustawieniach swojego profilu</a>, a następnie
                    ściągnij certyfikat jeszcze raz.</p>
            @else
                <p>Niestety, ten kurs nie posiada certyfikatu lub niektóre testy nie zostały zaliczone, przez co nie
                    możemy wystawić Ci certyfikatu. Możesz ponownie podejść do rozwiązywania testu po 14 dniach od jego
                    zakończenia.</p>
            @endif
            <hr/>
        @endif
    </div>
    {{--<div class="row">--}}
    {{--@include('partials.rating')--}}
    {{--</div>--}}
    @if( \Gate::allows('access-course', $course) )
        <course-rating course="{{ $course->slug }}" rating="{{ $course->rating->rating ?? null }}"></course-rating>
    @endif

    <div class="col-md-12">
        <hr/>
        <p>Chcesz nauczyć się czegoś innego?</p>
        <a href="{{ url('courses') }}" class="btn btn-ivba">Wróć na stronę główną</a>
    </div>
@endsection

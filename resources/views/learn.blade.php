@extends('layouts.learn')

@section('title')
    iExcel |
    @if( !empty($course) )
        {{ $course->title }}
        @if($lesson->title)
            | {{ $lesson->title }}
        @endif
    @else
        {{ $lesson->title }}
    @endif
@endsection

@section('navbar')
    @if(\Auth::user()->hasFinishedLesson($lesson->id))
        @if(!empty($course))
            <a href="{{ $lesson->finishUrl($course) }}" class="btn btn-ivba">Zakończ lekcję</a>
        @endif
    @else
        <a href="{{ $lesson->finishUrl($course) }}" class="btn btn-ivba">Zakończ lekcję </a>
    @endif
@endsection

@section('sidebar')

    @include('learn.sidebar')

@endsection

@section('content')
    <h1 class="page-header">
        @if($course)
            {{ $course->title }}
        @endif
        @if($lesson->title)
            | {{ $lesson->title }}
        @endif
    </h1>
    <div class="row">

        <div class="col-md-12 video centered">
            {!! $lesson->video ? $lesson->video->embed(1000, 600) : "" !!}
        </div>
        @if($lesson->files()->count() > 0)
            <div class="col-md-12">
                <hr/>
                <h3>Pliki do tej lekcji:</h3>
                <hr/>
                <div class="row">
                    @foreach($lesson->files as $file)
                        <div class="col-md-6">
                            <a href="{{ $file->link() }}" class="file">
                                <h5><i class="fa fa-file-o"></i> {{ $file->title }}</h5>
                                {{ $file->name }}
                            </a>
                            <a href="{{ $file->link() }}" class="btn ">
                                <i class="fa fa-download"></i> Pobierz ćwiczenie
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        <div class="col-md-12">
            {!! $lesson->description !!}
        </div>

    </div>
    <div class="col-md-12">
        <hr/>
        <div id="disqus_thread"></div>
    </div>
@endsection
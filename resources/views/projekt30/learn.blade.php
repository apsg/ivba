@extends('layouts.learn')

@section('title')
    Projekt30 |
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
    @if($canViewLesson)
        @if(\Auth::user()->hasFinishedLesson($lesson->id))
            @if(!empty($course))
                <a href="{{ $lesson->finishUrl($course) }}" class="btn btn-ivba">Oznacz lekcję jako zakończoną</a>
            @endif
        @else
            <a href="{{ $lesson->finishUrl($course) }}" class="btn btn-ivba">Oznacz lekcję jako zakończoną </a>
        @endif
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
        @if($course!== null && $lesson !== null)
            |
        @endif
        @if($lesson->title)
            {{ $lesson->title }}
        @endif
    </h1>
    <div class="row">

        @if(!$canViewLesson)
            <div class="col-md-12">
                <p class="alert alert-info">
                    <strong>Nie masz jeszcze dostępu do tej lekcji</strong> - musisz trochę poczekać. Ten kurs składa
                    się z {{ $course->lessons()->count() }} lekcji, a Ty widzisz obecnie
                    {{ $course->visibleLessons(Auth::user())->count() }} z nich.
                </p>
            </div>
        @else

            @if($lesson->video)
                <vimeo-video
                        src="{{ $lesson->video->embedSrc() }}"
                        watermark="{{ asset('/images/projekt30/watermark.png') }}"
                ></vimeo-video>
            @endif

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
        @endif
    </div>
    <div class="col-md-12">
        <hr/>
    </div>
@endsection
<script>
    import VimeoVideo from "../assets/js/components/VimeoVideo";

    export default {
        components: {VimeoVideo}
    }
</script>

<div class="bg-white rounded-50 p-5 lesson-content">
    <div class="d-flex justify-content-between">
        <div>
            @if($course)
                <h3 class="course-header">{{ $course->title }}</h3>
            @endif
            <h1 class="lesson-header">
                @if($lesson->title)
                    {{ $lesson->title }}
                @endif
            </h1>
        </div>
        <div>
            @if(\Auth::user()->hasFinishedLesson($lesson->id))
                @if(!empty($course))
                    <a href="{{ $lesson->finishUrl($course) }}" class="btn btn-ivba-inversed">
                        Oznacz lekcję jako zakończoną
                    </a>
                @endif
            @else
                <a href="{{ $lesson->finishUrl($course) }}" class="btn btn-ivba-inversed">
                    Oznacz lekcję jako zakończoną
                </a>
            @endif
        </div>
    </div>
    <div class="row">
        @if(!$canViewLesson)
            <div class="col-md-12">
                <p class="alert alert-info">
                    <strong>Nie masz jeszcze dostępu do tej lekcji</strong> - musisz trochę poczekać. Ten kurs
                    składa
                    się z {{ $course->lessons()->count() }} lekcji, a Ty widzisz obecnie
                    {{ $course->visibleLessons(Auth::user())->count() }} z nich.
                </p>
            </div>
        @else

            @if($lesson->video)
                <vimeo-video
                        src="{{ $lesson->video->embedSrc() }}"
                        watermark="{{ asset('images/internetowisprzedawcy/logo_white.svg') }}"
                ></vimeo-video>
            @endif

            @if($lesson->files()->count() > 0)
                <div class="col-md-12">
                    @foreach($lesson->files as $file)
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="rounded">
                                <a href="{{ $file->link() }}" class="file text-gray">
                                    {{ $file->title }} [{{ $file->name }}]
                                </a>
                            </div>
                            <a href="{{ $file->link() }}" class="btn btn-red-inversed">
                                <i class="fa fa-download"></i> Pobierz ćwiczenie
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
            <div class="col-md-12 lesson-description">
                <hr/>
                {!! $lesson->description !!}
            </div>
        @endif
    </div>
</div>

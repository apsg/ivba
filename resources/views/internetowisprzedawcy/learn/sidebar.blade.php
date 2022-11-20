<div class="learn-sidebar">
    <div class="pl-3 pb-3">
        <a href="{{ url('/') }}">
            <img width="43" height="71" src="{{ asset('/images/internetowisprzedawcy/logo_znak.svg') }}">
        </a>
    </div>

    <ul class="nav flex-column mb-2">
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/posts') }}">
                <i class="fa fa-caret-left"></i>
                Wróć do strony głównej
            </a>
        </li>
    </ul>
    @if(!empty($course))
    <div class="sidebar-container">
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1">
            <span>Spis lekcji</span>
        </h6>
        <ul class="nav mb-2">
            @foreach($course->visibleLessons(Auth::user())->get() as $l)
                <li class="nav-item ">
                    <a href="{{ $l->url($course) }}"
                       class="nav-link @if(isset($lesson) && $l->id == $lesson->id) {{"active"}} @endif" font-size-14>
                        @if(\Auth::user()->hasFinishedLesson($l->id))
                            <i class="fa fa-check-square"></i>
                        @endif
                        {{ $l->title }} ({{ $l->duration }} min.)
                        @if(isset($lesson) && $l->id == $lesson->id) <i
                                class="fa fa-chevron-right pull-right"></i> @endif
                    </a>
                </li>
            @endforeach
        </ul>

        @if( $course->quizzes->count() > 0 )

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1">
                <span>Testy</span>
            </h6>
            <ul class="nav flex-column mb-2">
                @foreach($course->quizzes as $quiz)
                    <li class="nav-item">
                        <a href="{{ $quiz->url($course) }}"
                           class="nav-link @if($quiz->url($course) === url()->current()) {{"active"}} @endif">
                            @if(\Auth::user()->hasFinishedQuiz($quiz->id))
                                <i class="fa fa-check-square-o"></i>
                            @endif
                            {{ $quiz->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
        @include('common.logbooks.sidebar_logbook')
    
        @include('common.forms.sidebar')
    
        @if(\Auth::user()->hasFinishedCourse($course->id))
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1">
                <span>Zakończ</span>
            </h6>
            <ul class="nav flex-column mb-2">
                <li class="nav-item">
                    <a href="{{ $course->finishedUrl() }}" class="btn btn-ivba nav-link">Koniec kursu</a>
                </li>
            </ul>
        @endif
    @else
        @if(\Auth::user()->hasFinishedLesson($lesson->id))
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1">
                <span>Zakończono lekcję</span>
            </h6>
        @endif
    @endif
    </div>
</div>

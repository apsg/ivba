<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
    <span>Nawigacja</span>
</h6>
<ul class="nav flex-column mb-2">
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/') }}">
            <i class="fa fa-home"></i>
            Wróć do strony głównej
        </a>
    </li>
</ul>

@if(!empty($course))
    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
        <span>Spis lekcji</span>
    </h6>
    <ul class="nav flex-column mb-2">
        @foreach($course->visibleLessons(Auth::user())->get() as $l)
            <li class="nav-item ">
                <a href="{{ $l->url($course) }}"
                   class="nav-link @if(isset($lesson) && $l->id == $lesson->id) {{"active"}} @endif">
                    @if(\Auth::user()->hasFinishedLesson($l->id))
                        <i class="fa fa-check-square-o"></i>
                    @endif
                    {{ $l->title }} ({{ $l->duration }} min.)
                    @if(isset($lesson) && $l->id == $lesson->id)
                        <i class="fa fa-chevron-right pull-right"></i>
                    @endif
                </a>
            </li>
        @endforeach
    </ul>

    @if( $course->quizzes->count() > 0 )

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Testy</span>
        </h6>
        <ul class="nav flex-column mb-2">
            @foreach($course->quizzes as $quiz)
                <li class="nav-item">
                    <a href="{{ $quiz->url($course) }}"
                       class="nav-link @if(isset($lesson) && $l->id == $lesson->id) {{"active"}} @endif">
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
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
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
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Zakończono lekcję</span>
        </h6>
    @endif
@endif


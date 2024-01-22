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


<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
    <span>Wsparcie</span>
</h6>
<ul class="nav flex-column mb-2">
    <li class="nav-item p-3">
        @can(App\Helpers\GateHelper::ASK_QUESTIONS)
            <button type="button" class="btn btn-ivba question-button text-center" data-toggle="modal"
                    data-target="#askQuestionModal" id="askQuestionButton">
                Potrzebuję pomocy!
            </button>
        @else
            <button type="button" class="btn btn-secondary" disabled>
                Niebawem dostępne
            </button>
        @endcan
    </li>
</ul>

<tooltip-info>
    <div class="font-size-12 px-3">
        <i class="fa fa-info-circle"></i>
        Szczegóły korzystania
    </div>

    <template slot="text">
        Jedno wykorzystanie na tydzień! Opisz swój problem, a my skontaktujemy się z Tobą priorytetowo. Przycisk odnawia się co 7 dni od startu, niewykorzystane okazje przepadają. Wykorzystanie pobiera się po wysłaniu wiadomości
    </template>
</tooltip-info>

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
                    @if(isset($lesson) && $l->id == $lesson->id) <i class="fa fa-chevron-right pull-right"></i> @endif
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

@push('modals')
    <!-- Modal -->
    <div class="modal fade" id="askQuestionModal" tabindex="-1" role="dialog"
         aria-labelledby="askQuestionModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <question-form
                    :course="{{json_encode($course)}}"
                    :lesson="{{json_encode($lesson ?? null)}}"
                    :show-phone="true"
            ></question-form>
        </div>
    </div>
@endpush

@if($course->logbooks->count() > 0)
    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
        <span>Logbook</span>
    </h6>
    <ul class="nav flex-column mb-2">
        @foreach($course->logbooks as $logbook)
            <li class="nav-item">
                <a href="{{ route('learn.course.logbook', compact('course', 'logbook')) }}"
                   class="nav-link ">
                    {{ $logbook->title }}
                </a>
            </li>
        @endforeach
    </ul>
@endif

@if($course->forms->count() > 0)
    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
        <span>Formularze</span>
    </h6>
    <ul class="nav flex-column mb-2">
        @foreach($course->forms as $form)
            <li class="nav-item">
                <a href="{{ route('learn.course.form', compact('course', 'form')) }}"
                   class="nav-link ">
                    {{ $form->name }}
                </a>
            </li>
        @endforeach
    </ul>
@endif

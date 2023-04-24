<li class="sortable-item" data-course_id="{{ $course->id }}">
    <div class="d-flex">
        <div class="flex-grow-1">
            <a href="{{ url('/admin/courses/'.$course->slug) }}">
                {{ $course->title }}
            </a>
        </div>
        <div class="pl-2">
            opóźnienie:
            <input type="number" min="0" max="1000" name="delay"
                   value="{{ $course->delay }}"
                   class="editable"
                   data-model="Course"
                   data-id="{{ $course->id }}"
                   data-col="delay"
            /> dni
        </div>
        <div class="pl-3 d-flex">
            <a href="{{ route('admin.course.users', $course) }}"
               class="btn btn-sm btn-primary mx-1">
                <i class="fa fa-users"></i>
            </a>
            <a href="{{ route('admin.course.duplicate', $course) }}"
               class="btn btn-sm btn-ivba mx-1"
               title="Duplikuj">
                <i class="fa fa-copy"></i>
            </a>
            <form method="post" action="{{ route('admin.course.delete', $course) }}">
                @method('delete')
                @csrf
                <button class="btn btn-danger btn-sm">
                    <i class="fa fa-trash"></i>
                </button>
            </form>
        </div>
    </div>
</li>


<div class="inner course-thumb-new">
    <div class="course-img" style="background-image: url('{{ $course->image->thumb(600, 300) }}');"></div>
    <div class="course-info">
        <a href="{{ $course->link() }}">
            <h3>{{ $course->title }}</h3>
            <p>{{ $course->excerpt }}</p>
        </a>
    </div>
    <div class="course-meta">
        <div class="course-users"> <i class="fa fa-user-o"></i> {{ $course->users_count }}</div>
        @if(!Gate::allows('access-course', $course))
            <div class="course-price">{{ $course->price }} zł</div>
        @endif
    </div>

</div>
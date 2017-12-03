
<a href="{{ url('/') }}" class="btn btn-primary">Wróć do strony głównej.</a>
<br />
<br />
@if(!empty($course))
	<h3>Spis lekcji</h3>
	<hr />
	<ul class="nav nav-sidebar">
	@foreach($course->lessons as $l)
		<li @if(isset($lesson) && $l->id == $lesson->id) class="active" @endif>
			<a href="{{ $l->url($course) }}">
				{{ $l->title }} ({{ $l->duration }} min.) 
				@if(\Auth::user()->hasFinishedLesson($l->id))
					<i class="fa fa-check-square-o"></i> 
				@endif
				@if(isset($lesson) && $l->id == $lesson->id) <i class="fa fa-chevron-right pull-right"></i> @endif</a>
		</li>
	@endforeach
	</ul>

	@if( $course->quizzes->count() > 0 )
		<h3>Testy</h3>
		<ul class="nav nav-sidebar">
			@foreach($course->quizzes as $quiz)
				<li>
					<a href="{{ $quiz->url($course) }}">{{ $quiz->name }}
						@if(\Auth::user()->hasFinishedQuiz($quiz->id))
							<i class="fa fa-check-square-o"></i> 
						@endif
					</a>
				</li>
			@endforeach
		</ul>
	@endif

	@if(\Auth::user()->hasFinishedCourse($course->id))
		<a href="{{ $course->finishedUrl() }}" class="btn btn-success">Koniec kursu</a>
	@endif
@else
	@if(\Auth::user()->hasFinishedLesson($lesson->id))
		<h3>Zakończono lekcję.</h3>
		<hr />
	@endif
@endif
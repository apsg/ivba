@extends('layouts.learn')

@section('title')
		iVBA |
		{{ $quiz->name }}
@endsection

@section('navbar')
@endsection

@section('sidebar')
	@include('learn.sidebar')
@endsection

@section('content')
	<h1 class="page-header">
		{{ $question->title }}
	</h1>
	<div class="col-md-12">
		{!! $question->content !!}
	</div>
	<div class="col-md-12">
		<hr />
		<form action="{{ url('/question/'.$question->id.'/answer') }}" method="post">
			{{ csrf_field() }}
			
			<div class="form-group"> 
			@if( $question->type == \App\Question::OPEN )
				<input class="form-control" type="text" name="answer" placeholder="Twoja odpowiedź?" required="required">
			@endif
			
			@if( $question->type == \App\Question::SINGLE )
				@foreach($question->options as $option)
				<label>
					<input class="" type="radio" name="answer" value="{{ $option->id }}"> 
					{{ $option->title }}
				</label><br />
				@endforeach
			@endif 

			@if( $question->type == \App\Question::MULTIPLE )
				@foreach($question->options as $option)	
				<input id="answer_{{ $option->id }}" class="" type="checkbox" name="answer[]" value="{{ $option->id }}">
				<label for="answer_{{ $option->id }}">
					{{ $option->title }}
				</label><br />
				@endforeach
			@endif

			</div>


			<button class="btn btn-primary">Zapisz odpowiedź</button>
		</form>
			
	</div>
@endsection

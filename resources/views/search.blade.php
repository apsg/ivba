@extends('layouts.front2')

@section('title', 'Wyniki wyszukiwania')

@section('content')
<section class="page content">
	<div class="container">
		<h1>Wyniki wyszukiwania</h1>
		<p>Dla frazy "{{ $s }}" znaleziono następujące wyniki: </p>
		
		<hr />
		<h3>Kursy</h3>
		<hr />
		@foreach($courses as $course)

		<div class="row"> 
			<div class="col-md-4">
				<a href="{{ $course->link() }}">
					<img src="{{ $course->image->url }}" style="max-width: 100%; max-height: 300px;">
				</a>
			</div> 
			<div class="col-md-8">
				<h5>{{ $course->title }}</h5>
				{!! $course->excerpt !!}
			</div>
		</div>
		@endforeach


		<hr />
		<h3>Lekcje</h3>
		<hr />
		@foreach($lessons as $lesson)

		<div class="row"> 
			<div class="col-md-4">
				<a href="{{ $lesson->link() }}">
					<img src="{{ $lesson->image->url }}" style="max-width: 100%; max-height: 300px;">
				</a>
			</div> 
			<div class="col-md-8">
				<h5>{{ $lesson->title }}</h5>
				{!! $lesson->excerpt !!}
			</div>
		</div>
		@endforeach

	</div>
</section>
@endsection
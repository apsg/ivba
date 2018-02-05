@extends('layouts.front')

@section('title', 'Dziękujemy')

@section('content')
<section class="page content">
	<div class="container">

		@if($page)
			<h1>{{ $page->title }}</h1>
			{!! $page->content !!}
		@else
			<h1>Dziękujemy</h1>
			<p>Potwierdziliśmy Twoją płatność i aktywowaliśmy abonament!</p>
			<p>Więcej szczegółów znajdziesz w swoim profilu:</p> <a href="{{ url('/account') }}" class="btn btn-primary">Mój profil</a>
		@endif
	</div>
</section>
@endsection

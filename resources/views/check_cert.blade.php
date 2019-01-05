@extends('layouts.front2')

@section('title', 'Sprawdź certyfikat')

@section('content')
<section class="page content">
	
	<div class="container">
		<h1>Sprawdź certyfikat</h1>
		<form action="{{ url('/check_cert') }}" method="get">
			{{ csrf_field() }}
			<div class="form-group">
				<label>Wpisz numer certyfikatu, który chcesz sprawdzić. Poprawny numer certyfikatu ma postać NUMER/ROK, np. 783/2017</label><br />
				<input type="number" min="1" name="number" placeholder="numer" required="required">/<input type="text" name="year" placeholder="rok">

				<button class="btn btn-primary btn-sm"><i class="fa fa-search"></i> Szukaj</button>
			</div>
		</form>
				
		@if( isset( $status ))
			
			@if($status == 'ok')
				<div class="alert alert-success">
					Cerytikat o podanym numerze został wystawiony na osobę o następujących inicjałach: <strong>{{ $text }}</strong>
				</div>
			@endif

			@if($status == 'error')
				<div class="alert alert-danger">
					<strong>{{ $text }}</strong>
				</div>
			@endif
		@endif
	</div>

</section>
@endsection
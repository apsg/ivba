@extends('layouts.front')

@section('title', 'Kup dostęp')

@section('content')
<section class="page content">
	@if( Auth::check() && Auth::user()->full_access_expires && Auth::user()->full_access_expires->isFuture() )
		
		@if( !Auth::user()->canAddFullAccess() )
			<div class="container">
				Ważność Twojego konta jest dłuższa niż rok (ważne do {{ Auth::user()->full_access_expires }}). Nie można teraz przedłużyć bardziej.
			</div>
		@else
			<div class="container">
				<h1>Przedłuż pełen dostęp do strony</h1>
				<p>Masz już wykupiony pełen dostęp ważny do dnia {{ Auth::user()->full_access_expires }}, ale możesz go już teraz przedłużyć, jeśli chcesz</p>
				<a href="{{ url('/cart/add_full_access') }}" class="btn btn-primary">Przedłuż dostęp</a>
			</div>
		@endif
	@else
		<div class="container">
			<h1>Kup pełen dostęp do strony</h1>
			<p>W tym miejscu możesz kupić roczny dostęp do WSZYSTKICH zasobów na iExcel.pl na okres 1 roku.</p>
	    <ul style="list-style: circle;">
	        <li>Podana cena jest ceną brutto i zawiera 23% VAT - brak innych opłat</li>
	        <li>Dostęp jest aktywowany na rok czasu - 365 dni</li>
	        <li>Masz prawo w ciągu 30 dni zrezygnować</li>
	    </ul>
			<a href="{{ url('/cart/add_full_access') }}" class="btn btn-primary">Kup roczny dostęp za 79 zł brutto</a>
		</div>
	@endif

</section>
@endsection
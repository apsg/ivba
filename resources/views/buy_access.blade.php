@extends('layouts.front')

@section('title', 'Kup dostęp')

@php
Session::put('url.intended', URL::full()); 
@endphp

@section('content')
<section class="page content">
	<div class="container">
	@if( Auth::check() && Auth::user()->full_access_expires && Auth::user()->full_access_expires->isFuture() )
		
		@if( !Auth::user()->canAddFullAccess() )
			Ważność Twojego konta jest dłuższa niż rok (ważne do {{ Auth::user()->full_access_expires }}). Nie można teraz przedłużyć bardziej.
		@else
			<h1>Przedłuż pełen dostęp do strony</h1>
			<p>Masz już wykupiony pełen dostęp ważny do dnia {{ Auth::user()->full_access_expires }}, ale możesz go już teraz przedłużyć, jeśli chcesz</p>
			<a href="{{ url('/cart/add_full_access') }}" class="btn btn-primary">Przedłuż dostęp</a>
		@endif
	@else
		<h1>Kup pełen dostęp do strony</h1>
		<p>W tym miejscu możesz kupić roczny dostęp do WSZYSTKICH zasobów na iVBA.pl na okres 1 roku.</p>
	    <ul style="list-style: circle;">
	        <li>Podana cena jest ceną brutto i zawiera 23% VAT - brak innych opłat</li>
	        <li>Dostęp jest aktywowany na rok czasu - 365 dni</li>
	        <li>Masz prawo w ciągu 30 dni zrezygnować</li>
	    </ul>
	    <br />
		<a href="{{ url('/cart/add_full_access') }}" class="btn btn-primary">Kup pełen dostęp za {{ config('ivba.full_access_price') }} zł brutto</a>
		<hr />
	@endif

		<h2>Wykup abonament</h2>
		@if( Auth::check() && Auth::user()->full_access_expires && Auth::user()->full_access_expires->isFuture() )
			<p>Masz aktywny pełen dostęp - nie możesz wykupić abonamentu</p>
		@elseif(Auth::check() && Auth::user()->hasActiveSubscription())
			<p>Masz już aktywny abonament</p>
		@else

			@if(\Auth::check())

				@if(Gate::denies('can-buy-subscription'))
						<p>Aby kontynuować proces zakupu abonamentu musisz uzupełnić dane rozliczeniowe swojego konta. </p>
						<hr />
						@include('partials.user_details_form')
					@else
						
						<h5>Twoje dane rozliczeniowe:</h5>
						<p>Imię i nazwisko: <strong>{{ \Auth::user()->full_name }}</strong></p>
						<p>Adres: <strong>{{ \Auth::user()->address }}</strong></p>
						<p>Złe dane? Zmień je w ustawieniach swojego profilu: <a href="{{ url('account') }}" class="btn btn-sm btn-info">Przejdź do ustawień profilu</a></p>
						<hr />

					<p>Opis abonamentu</p>

					<table class="table">
						<thead>
							<tr>
								<th>Opis</th>
								<th>Koszt</th>
								<th>Czas trwania (dni)</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Pierwsza płatność</td>
								<td>{{ config('ivba.subscription_price_first') }} PLN</td>
								<td>{{ config('ivba.subscription_duration_first') }}</td>
							</tr>
							<tr>
								<td>Kolejne płatności</td>
								<td>{{ config('ivba.subscription_price') }} PLN</td>
								<td>{{ config('ivba.subscription_duration') }}</td>
							</tr>
						</tbody>
					</table>
					
					<label>
						<input type="checkbox" name="rules" id="rules">
						Zapoznałam/zapoznałem się i zgadzam z <a style="vertical-align: bottom;" href="{{ url('/regulamin') }}" target="_blank">regulaminem strony {{ config('app.name') }}</a>
					</label>
					<br />
					<br />
					<form action="{{ url('/process_subscription') }}" method="post">
						{{ csrf_field() }}
						<input type="hidden" name="amount" value="{{ config('ivba.subscription_price_first') }}">
					    <button title="Aby wykupić abonament musisz potwierdzić zapoznanie się i zgodę z regulaminem" disabled="disabled" id="pay-button" class="btn btn-primary">Wykup abonament - zapłać pierwszą opłatę i zapisz kartę</button>
					</form>
				@endif
			@else
				<p>Zaloguj się, by wykupić abonament</p>
				<a href="{{ url('/login') }}" class="btn btn-primary">Zaloguj</a>
			@endif
		@endif
	<hr />
	</div>
</section>
@endsection

@push('scripts')
<script src="https://secure.payu.com/res/v2/jquery-1.7.2.js"></script>
<script src="https://secure.payu.com/res/v2/openpayu-2.0.js"></script>
<script src="https://secure.payu.com/res/v2/plugin-token-2.0.js"></script>
@if(\Auth::check())
<script
    src="https://secure.snd.payu.com/front/widget/js/payu-bootstrap.js"
    pay-button="#pay-button"
    currency-code="PLN"
    customer-email="{{ Auth::user()->email }}"
    customer-language="pl"
    merchant-pos-id="{{ config('payu.posid') }}"
    recurring-payment="true"
    shop-name="{{ config('app.name') }}"
    store-card="true"
    total-amount="{{ 100*config('ivba.subscription_price_first') }}"
    sig="{{ \App\Helpers\Payment::sig(Auth::user()->email, 100*config('ivba.subscription_price_first')) }}">
</script>
@endif
<script type="text/javascript">
	$(document).ready(function(){
		$('#rules').change(function(){
			if($(this).is(':checked')){
				$("#pay-button").prop('disabled', false);
			}else{
				$("#pay-button").prop('disabled', true);
			}
		});
	});
</script>
@endpush
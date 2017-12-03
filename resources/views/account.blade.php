@extends('layouts.front')

@section('title', 'Twoje konto iExcel')

@section('content')
<section class="page content">
	<div class="container">
		<h1>Twoje konto</h1>
		<hr />
		<div class="row">
			<div class="col-md-6">
				<form action="{{ url('/account') }}" method="post">
					{{ csrf_field() }}
					<fieldset disabled>
					    <div class="form-group">
					      	<label for="disabledTextInput">Adres email:</label>
					      	<input type="text" id="disabledTextInput" class="form-control" placeholder="Disabled input" value="{{ $user->email }}">
					    </div>
				    </fieldset>
				    <div class="form-group">
					    <label for="exampleInputEmail1">Nazwa użytkownika</label>
					    <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value="{{ $user->name }}">
					    <p>Ta nazwa używana jest na certyfikatach, które są wystawiane po niektórych z kursów. Najlepiej więc, by znajdowało się tu Twoje imię i nazwisko.</p>
					</div>
					<button type="submit">Zapisz</button>
				</form>
			</div>
			<div class="col-md-6">
				<h3>Zmień hasło</h3>
				
				<form action="{{ url('/account/change_password') }}" method="POST">
					{{ csrf_field() }}
					<div class="form-group">
 						<p>Kliknij poniższy przycisk, aby zmienić hasło. Wyślemy do Ciebie maila, dzięki któremu zmienisz swoje hasło.</p>
 						<p>Po kliknięciu w poniższy przycisk nastąpi automatyczne wylogowanie. Odszukaj w swojej skrzynce naszą wiadomość i zmień hasło.</p>
						<button type="submit">Zmień hasło</button>
					</div>
				</form>
					

			</div>
		</div>

		<hr />
		<h3>Twoje kursy</h3>
		<table class="table">
		  	<thead>
		    	<tr>
			      <th>Kurs</th>
			      <th>Data rozpoczęcia</th>
			      <th>Data ukończenia</th>
			      <th>Link</th>
			      <th>Pobierz certyfikat</th>
			    </tr>
		  	</thead>
		  	<tbody>
			@foreach( $user->courses as $course )
		    	<tr>
		      		<th scope="row">{{ $course->title }}</th>
		      		<td>{{ $course->created_at }}</td>
		      		<td>{{ $course->pivot->finished_at }}</td>
		      		<td>
		      		@if(Gate::allows('access', $course))
		      			<a href="{{ $course->learnUrl() }}">Przejdź do kursu</a>
		      		@else
		      			Dostęp wygasł
		      		@endif
		      		</td>
		      		<td>
		      			@if( !empty($course->user_certificate) )
		      				<a href="{{ $course->user_certificate->getDownloadUrl() }}">Pobierz</a>
		      			@else
		      				Brak certyfikatu
		      			@endif
		      		</td>
		    	</tr>	
		    @endforeach
		    </tbody>
	    </table>

		<hr />
		<h3>Twoje dostępy</h3>
		<table class="table">
		  	<thead>
		    	<tr>
			      <th>Dostęp do</th>
			      <th>Data rozpoczęcia</th>
			      <th>Wygasa</th>
			    </tr>
		  	</thead>
		  	<tbody>
		  	@if( !is_null(\Auth::user()->full_access_expires) )
		    	<tr>
		      		<th scope="row">Pełen dostęp do platformy iExcel</th>
		      		<td>-</td>
		      		<td>{{ \Auth::user()->full_access_expires }}</td>
		    	</tr>
		  	@endif
			@foreach( $accesses as $access )
		    	<tr>
		      		<th scope="row">
		      		@if(Gate::allows('access', $access->accessable))
		      			<a href="{{ $access->accessable->learnUrl() }}">{{ $access->accessable->cartName() }}</a>
		      		@else
		      			{{ $access->accessable->cartName() }}
	      			@endif
		      		</th>
		      		<td>{{ $access->created_at }}</td>
		      		<td>{{ $access->expires }}</td>
		    	</tr>	
		    @endforeach
		    </tbody>
	    </table>

		<hr />
		<h3>Twoje zamówienia</h3>
		<table class="table">
		  	<thead>
		    	<tr>
			      <th>#</th>
			      <th>Kod zamówienia</th>
			      <th>Kwota PLN</th>
			      <th>Opłacono</th>
			    </tr>
		  	</thead>
		  	<tbody>
			@foreach($user->confirmedOrders() as $order)
				<tr>
					<th scope="row">{{ $order->id }}</th>
					<td>{{ $order->payu_order_id ?? $order->id }}</td>
					<td>{{ $order->final_total }}</td>
					<td>{{ $order->confirmed_at }}</td>
				</tr>
			@endforeach
			</tbody>
		</table>

	</div>
</section>
@endsection
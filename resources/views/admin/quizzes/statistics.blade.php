@extends('admin.layouts.admin')


@push('breadcrumbs')
    <li class="active">Testy</li>
@endpush

@section('pagename', 'Statystyki testu')
@section('pagesubname', '#'.$quiz->id)

@include('admin.partials.medialibrary')

@section('content')

<section class="content">
	<div class="row">

		<div class="col-md-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Statystyki</h3>
					<div class="box-tools pull-right">
					</div><!-- /.box-tools -->
				</div><!-- /.box-header -->
				<div class="box-body">
					<p>Podeszło użytkowników: <strong>{{ $quiz->users->count() }} os.</strong></p>
					<p>Średni wynik testu: <strong>{{ $avg }}</strong> pkt.</p>
					<p>Zdawalność: <strong>{{ $passability_p }}%</strong> ({{ $passability }} os.)</p>
					<p>Najtrudniejsze pytanie: <strong>{{ $hardest->title }}</strong> ({{ $hardest->stats*100 }}%)</p>
					<p>Najłatwiejsze pytanie: <strong>{{ $easiest->title }}</strong> ({{ $easiest->stats*100 }}%)</p>
				</div>
			</div>
		</div>

		<div class="col-md-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Użytkownicy rozwiązujący ten test</h3>
					<div class="box-tools pull-right">
					</div><!-- /.box-tools -->
				</div><!-- /.box-header -->
				<div class="box-body">
					<table id="tabela">
						<thead>
							<tr>
								<th>Imię/nazwisko</th>
								<th>Data podejścia</th>
								<th>Punkty</th>
								<th>Wynik</th>
							</tr>
						</thead>
						<tbody>

							@foreach($quiz->users as $user)
							<tr>
								<td>{{ $user->name }}</td>
								<td>{{ $user->pivot->updated_at }}</td>
								<td>{{ $user->pivot->points }}</td>
								<td>@if($user->pivot->is_pass) <i class="fa fa-check"></i> @else <i class="fa fa-times"></i> @endif</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection

@push('scripts')
<script type="text/javascript">
	$(document).ready(function(){
		$("#tabela").DataTable();
	});
</script>
@endpush
@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class="active">Followupy</li>
@endpush

@section('pagename', 'Followupy')
@section('pagesubname', 'Lista')

@include('admin.partials.medialibrary')

@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-6">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Followupy po rejestracji</h3>
					<div class="box-tools pull-right">
					</div><!-- /.box-tools -->
				</div><!-- /.box-header -->
				<div class="box-body">
					<table class="table">
						<thead>
							<tr>
								<th>Tytuł</th>
								<th>Czas opóźnienia</th>
								<th>Opcje</th>
							</tr>
						</thead>
					@forelse($followups['userregistered'] as $followup)
						<tr>
							<td>
								<a href="{{ url('/admin/followups/'.$followup->id) }}">{{ $followup->title }}</a>
							</td>
							<td>
								{{ $followup->interval }}
							</td>
							<td>
								<a class="btn btn-default" href="{{ $followup->editLink() }}"><i class="fa fa-edit"></i> Edytuj</a>
								<a class="btn btn-warning" href="{{ $followup->deleteLink() }}"><i class="fa fa-trash" onclick="return confirm('Na pewno chcesz usunąć?');"></i> Usuń</a>
								<a class="btn btn-info" href="{{ $followup->testLink() }}"><i class="fa fa-envelope"></i> Wyślij test</a>
							</td>
						</tr>
					@empty
						<p>Brak followupów. Dodaj jakiś.</p>
					@endforelse
					</table>
				</div><!-- /.box-body -->
				<div class="box-footer">
					The footer of the box
				</div><!-- box-footer -->
			</div><!-- /.box -->
		</div>

		
		<div class="col-md-6">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Followupy po wykupieniu dostępu</h3>
					<div class="box-tools pull-right">
					</div><!-- /.box-tools -->
				</div><!-- /.box-header -->
				<div class="box-body">
					<table class="table">
						<thead>
							<tr>
								<th>Tytuł</th>
								<th>Czas opóźnienia</th>
								<th>Opcje</th>
							</tr>
						</thead>
					@forelse($followups['userpaid'] as $followup)
						<tr>
							<td>
								<a href="{{ url('/admin/followups/'.$followup->id) }}">{{ $followup->title }}</a>
							</td>
							<td>
								{{ $followup->interval }}
							</td>
							<td>
								<a class="btn btn-default" href="{{ $followup->editLink() }}"><i class="fa fa-edit"></i> Edytuj</a>
								<a class="btn btn-warning" href="{{ $followup->deleteLink() }}"><i class="fa fa-trash" onclick="return confirm('Na pewno chcesz usunąć?');"></i> Usuń</a>
								<a class="btn btn-info" href="{{ $followup->testLink() }}"><i class="fa fa-envelope"></i> Wyślij test</a>
							</td>
						</tr>
					@empty
						<p>Brak followupów. Dodaj jakiś.</p>
					@endforelse
					</table>
				</div><!-- /.box-body -->
				<div class="box-footer">
					The footer of the box
				</div><!-- box-footer -->
			</div><!-- /.box -->
		</div>


		<div class="col-md-6">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Followupy po wygaśnięciu dostępu</h3>
					<div class="box-tools pull-right">
					</div><!-- /.box-tools -->
				</div><!-- /.box-header -->
				<div class="box-body">
					<table class="table">
						<thead>
							<tr>
								<th>Tytuł</th>
								<th>Czas opóźnienia</th>
								<th>Opcje</th>
							</tr>
						</thead>
					@forelse($followups['userexpired'] as $followup)
						<tr>
							<td>
								<a href="{{ url('/admin/followups/'.$followup->id) }}">{{ $followup->title }}</a>
							</td>
							<td>
								{{ $followup->interval }}
							</td>
							<td>
								<a class="btn btn-default" href="{{ $followup->editLink() }}"><i class="fa fa-edit"></i> Edytuj</a>
								<a class="btn btn-warning" href="{{ $followup->deleteLink() }}"><i class="fa fa-trash" onclick="return confirm('Na pewno chcesz usunąć?');"></i> Usuń</a>
								<a class="btn btn-info" href="{{ $followup->testLink() }}"><i class="fa fa-envelope"></i> Wyślij test</a>
							</td>
						</tr>
					@empty
						<p>Brak followupów. Dodaj jakiś.</p>
					@endforelse
					</table>
				</div><!-- /.box-body -->
				<div class="box-footer">
					The footer of the box
				</div><!-- box-footer -->
			</div><!-- /.box -->
		</div>
	</div>
	<div class="row">

		<div class="col-md-6">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Followupy po porzuceniu zamówienia</h3>
					<p>Zamówienie oznaczone będzie jako porzucone, jeśli od wygenerowania id payu minęło więcej niż <strong>24h</strong> i nadal nie zarejestrowano płatności.</p>
					<div class="box-tools pull-right">
					</div><!-- /.box-tools -->
				</div><!-- /.box-header -->
				<div class="box-body">
					<table class="table">
						<thead>
							<tr>
								<th>Tytuł</th>
								<th>Czas opóźnienia</th>
								<th>Opcje</th>
							</tr>
						</thead>
					@forelse($followups['orderleft24'] as $followup)
						<tr>
							<td>
								<a href="{{ url('/admin/followups/'.$followup->id) }}">{{ $followup->title }}</a>
							</td>
							<td>
								{{ $followup->interval }}
							</td>
							<td>
								<a class="btn btn-default" href="{{ $followup->editLink() }}"><i class="fa fa-edit"></i> Edytuj</a>
								<a class="btn btn-warning" href="{{ $followup->deleteLink() }}"><i class="fa fa-trash" onclick="return confirm('Na pewno chcesz usunąć?');"></i> Usuń</a>
								<a class="btn btn-info" href="{{ $followup->testLink() }}"><i class="fa fa-envelope"></i> Wyślij test</a>
							</td>
						</tr>
					@empty
						<p>Brak followupów. Dodaj jakiś.</p>
					@endforelse
					</table>
				</div><!-- /.box-body -->
				<div class="box-footer">
					The footer of the box
				</div><!-- box-footer -->
			</div><!-- /.box -->
		</div>


		<div class="col-md-6">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Followupy po porzuceniu zamówienia</h3>
					<p>Zamówienie oznaczone będzie jako porzucone, jeśli od wygenerowania id payu minęło więcej niż <strong>72h</strong> i nadal nie zarejestrowano płatności.</p>
					<div class="box-tools pull-right">
					</div><!-- /.box-tools -->
				</div><!-- /.box-header -->
				<div class="box-body">
					<table class="table">
						<thead>
							<tr>
								<th>Tytuł</th>
								<th>Czas opóźnienia</th>
								<th>Opcje</th>
							</tr>
						</thead>
					@forelse($followups['orderleft72'] as $followup)
						<tr>
							<td>
								<a href="{{ url('/admin/followups/'.$followup->id) }}">{{ $followup->title }}</a>
							</td>
							<td>
								{{ $followup->interval }}
							</td>
							<td>
								<a class="btn btn-default" href="{{ $followup->editLink() }}"><i class="fa fa-edit"></i> Edytuj</a>
								<a class="btn btn-warning" href="{{ $followup->deleteLink() }}"><i class="fa fa-trash" onclick="return confirm('Na pewno chcesz usunąć?');"></i> Usuń</a>
								<a class="btn btn-info" href="{{ $followup->testLink() }}"><i class="fa fa-envelope"></i> Wyślij test</a>
							</td>
						</tr>
					@empty
						<p>Brak followupów. Dodaj jakiś.</p>
					@endforelse
					</table>
				</div><!-- /.box-body -->
				<div class="box-footer">
					The footer of the box
				</div><!-- box-footer -->
			</div><!-- /.box -->
		</div>

	</div>

</section>
@endsection
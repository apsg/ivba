@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class="active">Newslettery</li>
@endpush

@section('pagename', 'Newslettery')
@section('pagesubname', 'Lista')

@include('admin.partials.medialibrary')

@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Aktualnie dodane Newslettery</h3>
					<div class="box-tools pull-right">
					</div><!-- /.box-tools -->
				</div><!-- /.box-header -->
				<div class="box-body">
					<table id="table">
						<thead>
							<tr>
								<th>Nazwa</th>
								<th>Data dodania</th>
								<th>Data wysyłki</th>
								<th>Wysłano do</th>
								<th>Otworzyło</th>
								<th>Kliknięć</th>
								<th>Wypisanych</th>
							</tr>
						</thead>
						<tbody>
							@foreach($newsletters as $newsletter)
							<tr>
								<td>
									@if( $newsletter->send_at->isFuture() )
									<a href="{{ url('/admin/newsletters/'.$newsletter->id) }}">{{ $newsletter->title }}</a>
									@else
									<p>{{ $newsletter->title }}</p>
									@endif
								</td>
								<td>{{ $newsletter->created_at }}</td>
								<td>{{ $newsletter->send_at }}</td>
								<td>{{ $newsletter->emails()->count() }}</td>
								<td>{{ $newsletter->opened }}</td>
								<td>{{ $newsletter->clicked }}</td>
								<td>{{ $newsletter->unsubscribed }}</td>
							</tr>
							@endforeach
						</tbody>
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

@push('scripts')
<script type="text/javascript">
	$(document).ready(function(){
		$("#table").DataTable();
	});
</script>
@endpush
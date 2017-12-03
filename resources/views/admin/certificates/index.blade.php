@extends('admin.layouts.admin')


@push('breadcrumbs')
    <li class="active">Certyfikaty</li>
@endpush

@section('pagename', 'Certyfikaty')
@section('pagesubname', 'Lista')

@include('admin.partials.medialibrary')

@section('content')

<section class="content">
	<div class="row">
		@if($courses->count() > 0)
		<div class="col-md-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Dodaj nowy certyfikat</h3>
					<div class="box-tools pull-right">
					</div><!-- /.box-tools -->
				</div><!-- /.box-header -->
				<div class="box-body">
					<form action="/admin/certificates" method="post">
						{{ csrf_field() }}
						
						<label>Wybierz kurs:</label>
						<select class="form-control" name="course_id" required="required">
							<option disabled="disabled" selected="selected">-- Wybierz kurs --</option>
							@foreach($courses as $course)
							<option value="{{ $course->id }}">{{ $course->title }} ({{ $course->slug }})</option>
							@endforeach
						</select>
						
						<div class="form-group">
							<label>Tytuł (Tekst na certyfikacie)</label>
							<input required="required" type="text" name="title" class="form-control" value="{{ old('title') }}" />
						</div>
						
						<button class="btn btn-primary"><i class="fa fa-save"></i> Dodaj</button>

					</form>
				</div>
			</div>
		</div>
		@endif

		<div class="col-md-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Certyfikaty</h3>
					<div class="box-tools pull-right">
					</div><!-- /.box-tools -->
				</div><!-- /.box-header -->
				<div class="box-body">
					<table id="tabela">
						<thead>
							<tr>
								<th>Tytuł</th>
								<th>Do kursu</th>
								<th>Utworzono</th>
								<th>Opcje</th>
							</tr>
						</thead>
						<tbody>
							@foreach($certificates as $certificate)
							<tr>
								<td>{{ $certificate->title }}</td>
								<td>{{ $certificate->course->title }}</td>
								<td>{{ $certificate->created_at }}</td>
								<td>
									<a class="confirm" href="{{ url('admin/certificates/'.$certificate->id.'/delete') }}"><i class="fa fa-trash"></i> Usuń</a>
								</td>
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
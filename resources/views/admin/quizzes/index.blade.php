@extends('admin.layouts.admin')


@push('breadcrumbs')
    <li class="active">Testy</li>
@endpush

@section('pagename', 'Testy')
@section('pagesubname', 'Lista')

@include('admin.partials.medialibrary')

@section('content')

<section class="content">
	<div class="row">
		<div class="col-md-6">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Testy</h3>
					<div class="box-tools pull-right">
					</div><!-- /.box-tools -->
				</div><!-- /.box-header -->
				<div class="box-body">
					<table id="tabela">
						<thead>
							<tr>
								<th>Nazwa</th>
								<th>Do kursu</th>
								<th>Utworzono</th>
								{{-- <th>W losowej kolejności?</th> --}}
								<th>Liczba pytań</th>
								<th>Opcje</th>
							</tr>
						</thead>
						<tbody>
							@foreach($quizzes as $quiz)
							<tr>
								<td>{{ $quiz->name }}</td>
								<td>{{ $quiz->course->title }}</td>
								<td>{{ $quiz->created_at }}</td>
								{{-- <td>{{ $quiz->is_random ? "tak" : "nie" }}</td> --}}
								<td>{{ $quiz->questions()->count() }}</td>
								<td>
									<a href="{{ url('admin/quizzes/'.$quiz->id) }}"><i class="fa fa-edit"></i> Edytuj</a>
									<a class="confirm" href="{{ url('admin/quizzes/'.$quiz->id.'/delete') }}"><i class="fa fa-trash"></i> Usuń</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Dodaj nowy test</h3>
					<div class="box-tools pull-right">
					</div><!-- /.box-tools -->
				</div><!-- /.box-header -->
				<div class="box-body">
					<form action="/admin/quizzes" method="post">
						{{ csrf_field() }}
						
						<label>Wybierz kurs:</label>
						<select class="form-control" name="course_id" required="required">
							<option disabled="disabled" selected="selected">-- Wybierz kurs --</option>
							@foreach($courses as $course)
							<option value="{{ $course->id }}">{{ $course->title }} ({{ $course->slug }})</option>
							@endforeach
						</select>
						
						<div class="form-group">
							<label>Nazwa testu</label>
							<input required="required" type="text" name="name" class="form-control" value="{{ old('name') }}" />
						</div>
						
						<div class="form-group row">
							<div class="col-md-6">
								<label><input type="checkbox" name="is_random" value="1"> Pytania w losowej kolejności?</label>
							</div>
							<div class="col-md-6">
								<label>
									<input required="required" type="number" min="0" max="100" value="{{ old('pass_threshold') ?? 0 }}" name="pass_threshold">
									%  -  Próg zdawalności (0 = zawsze pozytywnie)
								</label>
							</div>
						</div>
						
						<button class="btn btn-primary"><i class="fa fa-save"></i> Dodaj</button>

					</form>
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
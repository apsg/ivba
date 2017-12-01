@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class="active">Skrypty</li>
@endpush

@section('pagename', 'Skrypty')
@section('pagesubname', 'Zarządzanie')

@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Dodane Skrypty</h3>
					<div class="box-tools pull-right">
					</div><!-- /.box-tools -->
				</div><!-- /.box-header -->
				<div class="box-body">
					<table class="table">
						<thead>
							<tr>
								<th>Nazwa</th>
								<th>Opcje</th>
							</tr>
						</thead>
						<tbody>

							@foreach($scripts as $script)
							<tr>
								<td><a href="{{ url('admin/scripts/'.$script->id) }}">{{ $script->title }}</a></td>
								<td>
									<a class="btn btn-primary" href="{{ url('admin/scripts/'.$script->id) }}"><i class="fa fa-edit"></i> Edytuj</a>
									<a class="btn btn-warning confirm" href="{{ url('admin/scripts/'.$script->id.'/delete') }}"><i class="fa fa-trash"></i> Usuń</a>
								</td>
							</tr>
							@endforeach

						</tbody>
					</table>
				</div><!-- /.box-body -->
				<div class="box-footer">

				</div><!-- box-footer -->
			</div><!-- /.box -->

			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Dodaj nowy</h3>
					<div class="box-tools pull-right">
					</div><!-- /.box-tools -->
				</div><!-- /.box-header -->
				<div class="box-body">
					<form action="{{ url('admin/scripts') }}" method="POST">
						{{ csrf_field() }}
						<input type="text" name="title" required="required" class="form-control" placeholder="Tytuł">
						<textarea class="form-control" name="script" required="required" placeholder="treść skryptu wraz z tagiem &lt;script&gt;"></textarea>
						<button class="form-control btn btn-primary"><i class="fa fa-save"></i> Dodaj</button>
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
		$('.table').DataTable();
	});
</script>
@endpush
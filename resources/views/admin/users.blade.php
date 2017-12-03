@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class="active">Użytkownicy</li>
@endpush

@section('pagename', 'Użytkownicy')
@section('pagesubname', 'Lista')

@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Wszyscy użytkownicy</h3>
					<div class="box-tools pull-right">
					</div><!-- /.box-tools -->
				</div><!-- /.box-header -->
				<div class="box-body">
					<table class="table">
						<thead><tr>
							<th>Nazwa</th>
							<th>Email</th>
							<th>Zarejestrowano dnia</th>
							<th>Pełen dostęp</th>
							<th>Opcje</th>
						</tr></thead>
						<tbody>
						{{-- @foreach($users as $user)
							<tr>
								<td>{{ $user->name }}</td>
								<td>{{ $user->email }}</td>
								<td>{{ $user->full_access_expires }}</td>
								<td>
									<a href="{{ $user->sendPasswordLink() }}" class="btn btn-info"><i class="fa fa-envelope-o"></i> Wyślij losowe hasło</a>
									<a href="{{ $user->deleteLink() }}" class="btn btn-warning" onclick="return confirm('Na pewno chcesz usunąć?');"><i class="fa fa-trash"></i> Usuń</a>
								</td>
							</tr>
						@endforeach --}}
						</tbody>

					</table>
				</div><!-- /.box-body -->
				<div class="box-footer">
					-
				</div><!-- box-footer -->
			</div><!-- /.box -->
		</div>
	</div>
</section>
@endsection

@push('scripts')

<script type="text/javascript">
	$(document).ready(function(){
		$('.table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url : '{{ url('/admin/users/data') }}',
            'data' : function(d){
            }
        },
        columns: [
            { data: 'name', name: 'name', searchable: true },
            { data: 'email', name: 'email', searchable: true },
            { data: 'created_at', name: 'created_at', searchable: false, orderable: true },
            { data: 'full_access_expires', name: 'full_access_expires', searchable: false, orderable: true },
            { data: 'options', name: 'options', searchable: false, orderable: false },

        ],
        'iDisplayLength' : 10,
        'order' : [[2,'desc']],
    });
	});
</script>

@endpush
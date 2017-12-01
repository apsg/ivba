@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class="active">Zamówienia</li>
@endpush

@section('pagename', 'Zamówienia')
@section('pagesubname', 'Lista')

@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Wszystkie zamówienia</h3>
					<div class="box-tools pull-right">
					</div><!-- /.box-tools -->
				</div><!-- /.box-header -->
				<div class="box-body">
					<table class="table">
						<thead><tr>
							<th>Użytkownik</th>
							<th>email</th>
							<th>Data</th>
							<th>Zawartość</th>
							<th>Kody rabatowe</th>
							<th>Kwota</th>
							<th>Opłacono</th>
						</tr></thead>
						<tbody>
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
            url : '{{ url('/admin/orders/data') }}',
            'data' : function(d){
            }
        },
        columns: [
            { data: 'user.name', name: 'user.name', searchable: true },
            { data: 'user.email', name: 'user.email', searchable: true },
            { data: 'created_at', name: 'created_at', searchable: false, orderable: true },
            { data: 'items2', name: 'items2', searchable: false, orderable: false },
            { data: 'coupons', name: 'coupons', searchable: false, orderable: true },
            { data: 'total', name: 'total', searchable: true, orderable: true },
            { data: 'confirmed_at', name: 'confirmed_at', searchable: true, orderable: true },
        ],
        'iDisplayLength' : 10,
        'order' : [[2,'desc']],
    });
	});
</script>

@endpush
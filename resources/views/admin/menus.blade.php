@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class="active">Menu</li>
@endpush

@section('pagename', 'Menu')
@section('pagesubname', 'Zarządzanie')

@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-6">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Menu górne</h3>
					<div class="box-tools pull-right">
					</div><!-- /.box-tools -->
				</div><!-- /.box-header -->
				<div class="box-body">
					
					@include('admin.partials.menu_list', ['menu_id' => 1, 'menu_items' => $items[1] ?? [] ] )

				</div><!-- /.box-body -->
				<div class="box-footer">
					@include('admin.partials.menu_form', ['menu_id' => 1, 'position' => isset($items[1]) ? $items[1]->count() : 0 ])
				</div><!-- box-footer -->
			</div><!-- /.box -->
		</div>

		<div class="col-md-6">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Menu stopka 1</h3>
					<div class="box-tools pull-right">
					</div><!-- /.box-tools -->
				</div><!-- /.box-header -->
				<div class="box-body">
					
					@include('admin.partials.menu_list', ['menu_id' => 2, 'menu_items' => $items[2] ?? [] ] )

				</div><!-- /.box-body -->
				<div class="box-footer">
					@include('admin.partials.menu_form', ['menu_id' => 2, 'position' => isset($items[2]) ? $items[2]->count() : 0 ])
				</div><!-- box-footer -->
			</div><!-- /.box -->
		</div>


		<div class="col-md-6">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Menu stopka 2</h3>
					<div class="box-tools pull-right">
					</div><!-- /.box-tools -->
				</div><!-- /.box-header -->
				<div class="box-body">
					
					@include('admin.partials.menu_list', ['menu_id' => 3, 'menu_items' => $items[3] ?? [] ] )

				</div><!-- /.box-body -->
				<div class="box-footer">
					@include('admin.partials.menu_form', ['menu_id' => 3, 'position' => isset($items[3]) ? $items[3]->count() : 0 ])
				</div><!-- box-footer -->
			</div><!-- /.box -->
		</div>
	</div>
</section>
@endsection


@push('scripts')
<script type="text/javascript">
$(document).ready(function(){
	$('.menu_items').sortable().disableSelection();

	$('.menu_items').on('sortupdate', function(e, ui){
		updateOrder( 
			ui.item.parent().children('.menu_item'), 
			ui.item.parent().data('menu_id') 
		);
	});
});

function updateOrder(items, menu_id){
	var order = Array();

	items.each(function(id, item){
		order.push({
			id: $(item).data('id'),
			order: id
		});
	});

	$.post('{{ url('/admin/menu/items_order') }}', { _token: '{{ csrf_token() }}', order: order, menu_id: menu_id }).done(function(r){

	}).fail(function(){
	 	alert("nie udało się zapisać kolejności. Odśwież stronę");
	});

	console.log(order);
}

</script>
@endpush
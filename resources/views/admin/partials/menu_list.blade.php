<div class="menu_items" data-menu_id="{{ $menu_id }}">
	@foreach($menu_items as $item)
	<div class="row menu_item" data-id="{{ $item->id }}">
		<div class="col-md-4">
			{{ $item->title }}
		</div>
		<div class="col-md-4">
			{{ $item->url }}
		</div>
		<div class="col-md-4">
			<form action="{{ url('/admin/menu/'.$item->id) }}" method="POST">
				{{ method_field('DELETE') }}
				{{ csrf_field() }}
				<button type="submit"><i class="fa fa-trash"></i> Usuń</button>
			</form>
		</div>
	</div>
	@endforeach
</div>

<form action="{{ url('admin/menu') }}" method="POST">
	{{ csrf_field() }}
	<input type="hidden" name="menu_id" value="{{ $menu_id }}">
	<input type="hidden" name="position" value="{{ $position ?? 0 }}">
	<div class="col-md-5">
		<input type="text" name="title" placeholder="Tytuł" class="form-control" required="required">
	</div>
	<div class="col-md-5">
		<input type="text" name="url" placeholder="Link" class="form-control" required="required">
	</div>
	<div class="col-md-2">
		<label>
			<input type="checkbox" name="is_new_window" value="1">
			_blank
		</label>
		<button type="submit" class="btn"><i class="fa fa-plus"></i> Dodaj</button>
	</div>
</form>
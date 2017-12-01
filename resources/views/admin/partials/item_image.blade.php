<div class="item box box-success" data-id="{{ $item->id }}" data-lesson_id="{{ $lesson->id }}" data-class="{{ get_class($item) }}">
	<div class="box-header with-border">
	  	<h3 class="box-title"><i class="fa fa-file-picture-o"></i> {{ $item->title }}</h3>
	  <!-- /.box-tools -->
		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
			</button>
		</div>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<div>
			<img src="{{ $item->image->thumb(200, 120) }}" />
		</div>
	</div>
	<!-- /.box-body -->
</div>

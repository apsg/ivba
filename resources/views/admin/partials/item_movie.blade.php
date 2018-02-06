<div class="item box box-success"  data-id="{{ $item->id }}" data-lesson_id="{{ $lesson->id }}" data-class="{{ get_class($item) }}">
	<div class="box-header with-border">
	  	<h3 class="box-title"><i class="fa fa-film"></i> {{ $item->title }}</h3>
	  <!-- /.box-tools -->
		<div class="box-tools pull-right">
			<a class="btn btn-danger confirm" href="{{ $item->deleteLink() }}">
				<i class="fa fa-trash"></i> Usuń
			</a>
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
			</button>
		</div>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<div>
			<img src="{{ $item->video->thumb }}" />
		</div>
	</div>
	<!-- /.box-body -->
</div>

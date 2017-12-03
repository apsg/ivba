@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class=""><a href="{{ url('/admin/lesson') }}">Lekcje</a></li>
    <li class="active">Kurs #{{ $lesson->id }}</li>
@endpush

@section('pagename', 'Lekcje')
@section('pagesubname', $lesson->title)

@include('admin.partials.medialibrary')
@include('admin.partials.videolibrary')

@section('content')

@include('admin.partials.course_errors')

<section class="content">
	<form action="{{ url('admin/lesson/'.$lesson->slug) }}" method="post">
		{{ method_field('patch') }}
		@include('admin.partials.lesson_form')
	</form>
</section>

<section class="content">
	<div class="box box-primary">
	  	<div class="box-header with-border">
	    	<h3 class="box-title">Elementy dodane do tej lekcji</h3>
	    	<div class="box-tools pull-right">
	    	</div><!-- /.box-tools -->
		</div><!-- /.box-header -->
		<div class="box-body items sortable" id="items">
		    @foreach($lesson->items() as $item)
				@include($item->view)
		    @endforeach
		</div><!-- /.box-body -->
		<div class="box-footer">
		    
		</div><!-- box-footer -->
	</div><!-- /.box -->

	<div class="nav-tabs-custom">
        <ul class="nav nav-tabs ">
			<li class="pull-left header"><i class="fa fa-th"></i> Dodaj elementy do lekcji</li>
			<li class="active"><a href="#tab_1-1" data-toggle="tab" aria-expanded="true">Film</a></li>
			<li class=""><a href="#tab_2-2" data-toggle="tab" aria-expanded="false">Obraz</a></li>
			<li class=""><a href="#tab_3-2" data-toggle="tab" aria-expanded="false">Plik</a></li>
			<li class=""><a href="#tab_3-3" data-toggle="tab" aria-expanded="false">Tekst</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1-1">
            	<form action="{{ url('/admin/lesson/'.$lesson->id.'/items') }}" method="post">
					{{ csrf_field() }}
					<input type="hidden" name="type" value="video">
					<div class="form-group">
		                <label for="new-file-title-pl">Tytuł pl</label>
	                	<input name="title" type="text" class="form-control" id="new-file-title-pl" placeholder="Tytuł PL">
	                </div>
	                <div class="form-group">
						<input type="hidden" name="video_id" id="new-video-id" />
						<img src="" id="new-video-thumb">
						<button class="btn btn-default addvideo" data-for-id="#new-video-id" data-for-src="#new-video-thumb">Wybierz lub dodaj film</button>
	                </div>
	                <div class="form-group">
	                	<button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Dodaj</button>
	                </div>
                </form>
			</div>
			<!-- /.tab-pane -->
			<div class="tab-pane" id="tab_2-2">
			{{-- obraz --}}
				<form action="{{ url('/admin/lesson/'.$lesson->slug.'/items') }}" method="post">
					{{ csrf_field() }}
					<input type="hidden" name="type" value="image">
					<div class="form-group">
		                <label for="new-file-title-pl">Tytuł pl</label>
	                	<input name="title" type="text" class="form-control" id="new-file-title-pl" placeholder="Tytuł PL">
	                </div>
	                <div class="form-group">
		                <label for="new-file">Plik</label>
	                	<div class="input-group">
			                <span class="input-group-addon"><i class="fa fa-file"></i></span>
			                <input id="new-file" type="text" class="addmedia form-control" placeholder="ścieżka" data-for-id="#new-file-id" data-for-src-input="#new-file">
			                <input type="hidden" name="image_id" value="" id="new-file-id">
		              	</div>
	                </div>
	                <div class="form-group">
	                	<button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Dodaj</button>
	                </div>
				</form>
			</div>
			<!-- /.tab-pane -->
			<div class="tab-pane" id="tab_3-2">
				
				<form action="{{ url('/admin/lesson/'.$lesson->slug.'/items') }}" method="post" enctype="multipart/form-data">
					{{ csrf_field() }}
					<input type="hidden" name="type" value="file">
					
					<div class="form-group">
		                <label for="new-file-title-pl">Tytuł</label>
	                	<input name="title" type="text" class="form-control" id="new-file-title-pl" placeholder="Tytuł" required="required">
					</div>

					<div class="form-group">
		                <label for="new-file">Plik</label>
	                	<input name="file" type="file" class="form-control" id="new-file" required="required">
					</div>
					
					<input type="hidden" name="host" value="2">
{{-- 
					<div class="form-group">
						<label>Gdzie hostować przesłany plik?</label>
						<select name="host" class="form-control">
							<option value="1">Wistia</option>
							<option value="2">Serwer lokalny</option>
						</select>
					</div> --}}

					<div class="form-group">
						<button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Dodaj</button>
					</div>
				</form>
			</div>
			<!-- /.tab-pane -->
			<div class="tab-pane" id="tab_3-3">

				<form action="{{ url('/admin/lesson/'.$lesson->slug.'/items') }}" method="post" novalidate="novalidate">
					{{ csrf_field() }}
					<input type="hidden" name="type" value="text">

					<div class="form-group">
		                <label for="new-file-title-pl">Tytuł</label>
	                	<input name="title" type="text" class="form-control" id="new-file-title-pl" placeholder="Tytuł" required="required">
					</div>
					<div class="form-group">
						<textarea class="tinymce" name="text" required="required"></textarea>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Dodaj</button>
					</div>
				</form>
			</div>
			<!-- /.tab-pane -->
        </div>
            <!-- /.tab-content -->
    </div>
</section>

@endsection

@push('scripts')
<script type="text/javascript">
$(document).ready(function(){
	$('#items').sortable().disableSelection();

	$('#items').on('sortupdate', function(e, ui){
		updateOrder();
	});
});

/**
 * Aktualizuje dane na podstawie kolejności elementów przypisanych do lekcji
 * @return {[type]} [description]
 */
function updateOrder(){

	var order = Array();

	$("#items > div").each(function(id, item){
		order.push({
			id: $(item).data('id'),
			class: $(item).data('class'),
			lesson_id: $(item).data('lesson_id'),
			order: id
		});
	});

	$.post('{{ url('/admin/lesson/'.$lesson->slug.'/items_order') }}', { _token: '{{ csrf_token() }}', order: order })
	 .done(function(r){

	 }).fail(function(r){
	 	console.log(r);
	 	alert("nie udało się zapisać kolejności");
	 });

}
</script>
@endpush
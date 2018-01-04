@extends('admin.layouts.admin')

@push('breadcrumbs')
    <li class="active">Kursy</li>
@endpush

@section('pagename', 'Kursy')
@section('pagesubname', 'Lista')

@include('admin.partials.medialibrary')

@section('content')
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Aktualnie dodane kursy, kolejność i opóźnienie</h3>
					<div class="box-tools pull-right">
					</div><!-- /.box-tools -->
				</div><!-- /.box-header -->
				<div class="box-body">
					<ul class="sortable" id="courses">
					@forelse($courses as $course)
						<li class="sortable-item" data-course_id="{{ $course->id }}">
							<a href="{{ url('/admin/courses/'.$course->slug) }}">
								{{ $course->title }}
							</a>
							<div class="pull-right w-100">
								<input type="number" min="0" max="1000" name="delay" value="{{ $course->delay }}" 
								class="editable"
								data-model="Course"
								data-id="{{ $course->id }}"
								data-col="delay"
								/> dni
							</div>
						</li>
					@empty
						<p>Brak Kursów. Dodaj jakiś.</p>
						<a href="{{ url('admin/courses/new') }}" class="btn btn-primary">Dodaj kurs</a>
					@endforelse
					</ul>
				</div><!-- /.box-body -->
				<div class="box-footer">
					Przeciągnij kursy by zmienić kolejność
				</div><!-- box-footer -->
			</div><!-- /.box -->
		</div>
	</div>
</section>
@endsection


@push('scripts')
<script type="text/javascript">
	$(document).ready(function(){
		$('.sortable').sortable({
		}).disableSelection();

		$('#courses').on('sortupdate', function(e, ui){
			updateOrder();
		});
	});

/**
 * Aktualizuje dane na podstawie kolejności elementów w spisie lekcji przypisanych
 * @return {[type]} [description]
 */
function updateOrder(){

	var order = Array();

	$("#courses li").each(function(id, item){
		order.push({
			course_id: $(item).data('course_id'),
			position: id
		});
	});

	$.post('{{ url('/admin/courses_order') }}', { _token: '{{ csrf_token() }}', order: order })
	 .done(function(r){

	 });

}

</script>
@endpush

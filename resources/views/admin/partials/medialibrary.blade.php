
@push('modals')
<div class="modal medialibrary" id="medialibrary">
	<div class="modal-dialog" >
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Biblioteka Mediów</h4>
			</div>
			<div class="modal-body">
				<div>

					  <!-- Nav tabs -->
					  <ul class="nav nav-tabs" role="tablist">
					    <li role="presentation" class="active"><a href="#select-media" aria-controls="select-media" role="tab" data-toggle="tab">Wybierz</a></li>
					    <li role="presentation"><a href="#add-new" aria-controls="add-new" role="tab" data-toggle="tab">Dodaj nowy</a></li>
					  </ul>

					  <!-- Tab panes -->
					<div class="tab-content">
					    <div role="tabpanel" class="tab-pane active" id="select-media">
					    </div>
					    <div role="tabpanel" class="tab-pane" id="add-new">
					    	<div class="row">
					    		<div class="col-md-6">
					    			<h4>Dodaj nowy plik do biblioteki mediów: </h4>
							    	<form id="add-new-form" action="{{ url('admin/images') }}" method="post" enctype="multipart/form-data">
							    		{{ csrf_field() }}
							    		<input type="file" name="image" required="required">
							    		<button>Wyślij</button>
							    	</form>
						    	</div>
						    	<div class="col-md-6">
						    		<div id="new-file" data-id="0" data-src="" class="hidden image">
						    			<img src="">
						    		</div>
						    	</div>
					    	</div>
					    </div>
					</div>

				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left close-modal" data-dismiss="modal">Zamknij</button>
				<button type="button" class="btn btn-primary " id="insert-selected">Wstaw wybrany</button>
			</div>
		</div>
	<!-- /.modal-content -->
	</div>
<!-- /.modal-dialog -->
</div>
@endpush

@push('scripts')
<script type="text/javascript">
	
$(document).ready(function(){
	$('.addmedia').on('click, focus', function(e){
		e.preventDefault();
		$("#medialibrary").fadeIn(100);

		window.media_id = $(this).data('for-id');
		window.media_src = $(this).data('for-src');
		window.media_src_input = $(this).data('for-src-input');


		loadImages();
	});

	$("#medialibrary .close-modal").click(function(){
		$("#medialibrary").fadeOut(100);
	});

	$("#insert-selected").click(function(){
		if( $(".ui-selected").length == 0 ){
			alert('Musisz wpierw wybrać jakiś obraz');
		}else{
			let id = $(".ui-selected").data('id');
			let src = $(".ui-selected").data('src');

			$(window.media_id).val(id);
			$(window.media_src_input).val(src);
			$(window.media_src).attr('src', src);

			$('#medialibrary').fadeOut(100);
		}
	});

	$("#medialibrary").on('click', '.pagination a', function(e){
		e.preventDefault();

		$.get( $(this).attr('href'), {_token: '{{ csrf_token() }}'} ).done(function(r){
			$("#select-media").html(r);
			$("#select-media .imageslist").selectable();
		});

	});

	$("#add-new-form").submit(function(e){
		e.preventDefault();

		var button = $(this).find('button');
		button.prop('disabled', true);
		$('body, window').css({cursor:'wait'});
		
		var formData = new FormData($(this)[0]);
		formData._token = '{{ csrf_token() }}';

		$.ajax({
			url: $(this).attr("action"),
			data: formData ,
	        headers: {
	           'X-CSRF-Token': $(this).find('[name="_token"]').val()
	        },
			dataType: 'json',
			processData: false,
			contentType: false,
			type: 'POST'
		}).done( function(data) {
	        console.log(data);
	        $("#new-file").data('id', data.id).data('src', data.url).find('img').attr('src', data.url);
	        $(".ui-selected").removeClass('ui-selected');
	        $("#new-file").addClass('ui-selected').removeClass('hidden');
			$('body, window').css({cursor:''});
			button.prop('disabled', false);

	    });
	});

});

function loadImages(){
	$.get('{{ url('/admin/images') }}', { _token: '{{ csrf_token() }}'  }).done(function(r){
		$("#select-media").html(r);
		$("#select-media .imageslist").selectable();
	});
}

</script>

@endpush
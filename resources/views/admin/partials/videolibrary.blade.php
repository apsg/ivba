

@push('modals')
<div class="modal medialibrary" id="videolibrary">
	<div class="modal-dialog" >
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">×</span></button>
				<h4 class="modal-title">Biblioteka Filmów</h4>
			</div>
			<div class="modal-body">
				<div>

					  <!-- Nav tabs -->
					  <ul class="nav nav-tabs" role="tablist">
					    <li role="presentation" class="active"><a href="#select-videos" aria-controls="select-videos" role="tab" data-toggle="tab">Wybierz</a></li>
					    <li role="presentation"><a href="#add-new-video" aria-controls="add-new-video" role="tab" data-toggle="tab">Dodaj nowy</a></li>
					  </ul>

					  <!-- Tab panes -->
					<div class="tab-content">
					    <div role="tabpanel" class="tab-pane active" id="select-videos">
					    </div>
					    <div role="tabpanel" class="tab-pane" id="add-new-video">
					    	<div class="row">
					    		<div class="col-md-6">
					    			<h4>Dodaj nowy plik do biblioteki mediów: </h4>
							    	<form id="add-new-video-form" action="{{ url('admin/videos') }}" method="post" enctype="multipart/form-data">
							    		{{ csrf_field() }}
							    		<input type="file" name="video" required="required">
							    		<input type="hidden" name="title" id="title-additional">
							    		<button>Wyślij</button>
							    	</form>
							    	<div class="progress">
						                <div id="progressbar" class="progress-bar progress-bar-primary progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
						                  <span class="sr-only"> </span>
						                </div>
					              	</div>
					              	<span id="progress-msg"></span>
						    	</div>
						    	<div class="col-md-6">
						    		<div id="new-file-video" data-id="0" data-src="" class="hidden image video">
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
				<button type="button" class="btn btn-primary " id="insert-selected-video">Wstaw wybrany</button>
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
	$('.addvideo').on('click, focus', function(e){
		e.preventDefault();
		$("#videolibrary").fadeIn(100);

		window.media_id = $(this).data('for-id');
		window.media_src = $(this).data('for-src');
		window.media_src_input = $(this).data('for-src-input');


		loadVideos();
	});

	$("#videolibrary .close-modal").click(function(){
		$("#videolibrary").fadeOut(100);
	});

	$("#insert-selected-video").click(function(){
		if( $(".ui-selected").length == 0 ){
			alert('Musisz wpierw wybrać jakiś obraz');
		}else{
			let id = $(".video.ui-selected").data('id');
			let src = $(".video.ui-selected").data('src');

			$(window.media_id).val(id);
			$(window.media_src_input).val(src);
			$(window.media_src).attr('src', thumbUrl(src) );

			$('#videolibrary').fadeOut(100);
		}
	});

	$("#videolibrary").on('click', '.pagination a', function(e){
		e.preventDefault();

		$.get( $(this).attr('href'), {_token: '{{ csrf_token() }}'} ).done(function(r){
			$("#select-videos").html(r);
			$("#select-videos .imageslist").selectable();
		});

	});

	$("#add-new-video-form").submit(function(e){
		e.preventDefault();

		$('#title-additional').val($("#titlePL").val());

		var button = $(this).find('button');
		button.prop('disabled', true);
		$('body, window').css({cursor:'wait'});
		
		var formData = new FormData($(this)[0]);
		formData._token = '{{ csrf_token() }}';

		$.ajax({
			xhr:function() {
			    var xhr = new window.XMLHttpRequest();

			    xhr.upload.addEventListener("progress", function(evt) {
			      if (evt.lengthComputable) {
			        var percentComplete = evt.loaded / evt.total;
			        percentComplete = parseInt(percentComplete * 100);
			        console.log(percentComplete);

			        $("#progressbar").css({ width: percentComplete+"%" });

			        if (percentComplete === 100) {
			        	$("#progress-msg").text("Przetwarzam, proszę czekać...");
			        	$("#progressbar").removeClass('active');
			        }

			      }
			    }, false);

			    return xhr;
			},
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
	        $("#new-file-video").data('id', data.id)
	        	.data('src', thumbUrl(data.thumb) )
	        	.find('img')
	        	.attr('src', thumbUrl(data.thumb) );
	        	
	        $(".ui-selected").removeClass('ui-selected');
	        $("#new-file-video").addClass('ui-selected').removeClass('hidden');
			$('body, window').css({cursor:''});
			button.prop('disabled', false);

	    });
	});

});

function thumbUrl( thumb ){
	return 'https://i.vimeocdn.com/video/' + thumb + '_200x150.jpg?r=pad';
}

function loadVideos(){
	$.get('{{ url('/admin/videos') }}', { _token: '{{ csrf_token() }}'  }).done(function(r){
		$("#select-videos").html(r);
		$("#select-videos .imageslist").selectable();
	});
}

</script>

@endpush
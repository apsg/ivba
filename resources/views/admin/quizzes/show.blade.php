@extends('admin.layouts.admin')


@push('breadcrumbs')
    <li class="active">Testy</li>
@endpush

@section('pagename', 'Testy')
@section('pagesubname', 'Lista')

@include('admin.partials.medialibrary')

@section('content')

<section class="content">
	<div class="row">
		<div class="col-md-6">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Ustawienia</h3>
					<div class="box-tools pull-right">
					</div><!-- /.box-tools -->
				</div><!-- /.box-header -->
				<div class="box-body">
					<form action="/admin/quizzes/{{$quiz->id}}" method="post">
						{{ csrf_field() }}
						{{ method_field('patch') }}
						
						<label>Wybierz kurs:</label>
						<select class="form-control" name="course_id" required="required">
							@foreach($courses as $course)
							<option value="{{ $course->id }}"
								@if( $course->id == $quiz->course_id )
									selected="selected" 
								@endif
								>{{ $course->title }} ({{ $course->slug }})</option>
							@endforeach
						</select>
						
						<div class="form-group">
							<label>Nazwa testu</label>
							<input required="required" type="text" name="name" class="form-control" value="{{ old('name') ?? $quiz->name }}" />
						</div>
						
						<div class="form-group row">
							<div class="col-md-6">
								<label><input type="checkbox" name="is_random" value="1" @if(old('is_random') || $quiz->is_random) checked="checked" @endif > Pytania w losowej kolejności?</label>
							</div>
							<div class="col-md-6">
								<label>
									<input required="required" type="number" min="0" max="100" value="{{ old('pass_threshold') ?? $quiz->pass_threshold }}" name="pass_threshold">
									%  -  Próg zdawalności (0 = zawsze pozytywnie)
								</label>
							</div>
						</div>
						
						<button class="btn btn-primary"><i class="fa fa-save"></i> Zapisz</button>

					</form>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Nowe pytanie</h3>
					<div class="box-tools pull-right">
					</div><!-- /.box-tools -->
				</div><!-- /.box-header -->
				<div class="box-body">
					<form action="{{ url('admin/quizzes/'.$quiz->id.'/questions') }}" method="post">
						{{ csrf_field() }}
						<select name="type" class="form-control">
							<option value="{{ \App\Question::OPEN }}">Pytanie otwarte</option>
							<option value="{{ \App\Question::SINGLE }}">Jednokrotny wybór</option>
							<option value="{{ \App\Question::MULTIPLE }}">Wielokrotny wybór</option>
						</select>
						<div class="form-group">
							<label>Tytuł pytania</label>
							<input class="form-control" type="text" name="title" required="required">
						</div>
						<div class="form-group">
							<label>Punkty za to pytanie</label>
							<input class="form-control" type="number" min="1" name="points" required="required" value="1">
						</div>

						<button class="btn btn-primary"><i class="fa fa-plus"></i> Dodaj</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<h3>Pytania</h3>
			<div class="questions sortable" id="question_list">
				@foreach($quiz->questions as $question)
				<div class="question" data-question-id="{{ $question->id }}">
					<div class="box @if(!isset($open) || $open != $question->id) collapsed-box @endif">
						<div class="box-header with-border">
							<h3 class="box-title">{{ $question->title }} ({{ $question->type_name }})</h3>

							@if( !$question->isValid() )
								<span class="warn"><i class="fa fa-warning"></i> to pytanie wymaga poprawienia!</span>
							@endif

							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
				                </button>
							</div><!-- /.box-tools -->
						</div><!-- /.box-header -->
						<div class="box-body">
							<form action="{{ url('admin/question/'.$question->id) }}" method="post">
								{{  csrf_field() }}
								{{ method_field('patch') }}
								<div class="form-group">
									<label>Tytuł</label>
									<input class="form-control" type="text" name="title" value="{{ $question->title }}" />
								</div>

								<textarea class="tinymce" name="content">{{ $question->content }}</textarea>
								<div class="form-group">
									<label>Punkty za to pytanie</label>
									<input type="number" name="points" value="{{ $question->points }}" min="1" class="form-control">
								</div>
								@if($question->type == \App\Question::OPEN)
								<div class="form-group">
									<label>Poprawna odpowiedź</label>
									<input type="text" name="answer" value="{{ $question->answer }}" class="form-control">
								</div>
								@endif
								<button class="btn btn-primary"><i class="fa fa-save"></i> Zapisz</button>
							</form>
							<hr />
							<form class="" action="{{ url('admin/question/'.$question->id) }}" method="post">
								{{ csrf_field() }}
								{{ method_field('delete') }}
								<button class="btn btn-warning"><i class="fa fa-trash"></i> Usuń to pytanie</button>
							</form>
							@if( $question->type != \App\Question::OPEN )
							<h3>Odpowiedzi</h3>
							<div class="options" id="options_{{ $question->id }}">
								@foreach($question->options as $option)
									@include('admin.quizzes.question_option')
								@endforeach
							</div>
							<div class="row">
								<form action="{{ url('admin/question/'.$question->id.'/options') }}" method="post" class="add_option_form" data-for="options_{{ $question->id }}">
									{{ csrf_field() }}
									<div class="form-group col-md-6">
										<input type="hidden" name="question_id" value="{{ $question->id }}" placeholder="Odpowiedź">
										<input type="text" name="title" required="required" class="form-control">
									</div>
									<div class="col-md-2">
										<label><input type="checkbox" name="is_correct" value="1"> Poprawna </label>
									</div>
									<div class="col-md-2">
										<button class="btn btn-primary"><i class="fa fa-plus"></i> Dodaj</button>
									</div>
									
								</form>
							</div>
							@endif
								
						</div>
					</div>
				</div>
				@endforeach
			</div>
			<hr />
				
		</div>
	</div>
</section>

@endsection

@push('scripts')
<script type="text/javascript">
	$(document).ready(function(){
		$("#tabela").DataTable();

		$('.sortable').sortable();

		$('#question_list').on('sortupdate', function(e, ui){
			updateOrder();
		});

		$('.add_option_form').submit(function(e){
			e.preventDefault();
			var data = $(this).serialize();
			var list = $(this).data('for');
			var input = $(this).find('input[type=text]');
			var cb = $(this).find('input[type=checkbox]');

			$.post( $(this).attr('action'), data ).done(function(r){
				$('#'+list).append(r.html);
				input.val('');
				cb.prop('checked', false);
			}).fail(function(r){
				console.log(r);
			});
		});

		$('.delete_option_form').submit(function(e){
			e.preventDefault();
			
			console.log('ok');

			var data = $(this).serialize();
			var div = $(this).closest('.question_option');

			$.post( $(this).attr('action'), data ).done(function(r){
				div.remove();
			});

		});


		tinymce.init({
          selector: '.tinymce',
          height: 200,
          file_browser_callback: function(field_name, url, type, win){
                console.log(field_name);
                window.media_src_input = "#"+field_name;
                $("#medialibrary").fadeIn(100);
                loadImages();
          },    
          plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table paste imagetools"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
          // imagetools_cors_hosts: ['www.tinymce.com', 'codepen.io'],
          content_css: [
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            '//www.tinymce.com/css/codepen.min.css'
          ]
        });
	});

function updateOrder(){
		var order = Array();

	$("#question_list > div").each(function(id, item){
		order.push({
			question_id: $(item).data('question-id'),
			position: id
		});
	});

	$.post('{{ url('/admin/quizzes/'.$quiz->id.'/question_order') }}', { _token: '{{ csrf_token() }}', order: order })
	 .done(function(r){

	 });
}
</script>
@endpush
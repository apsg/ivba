<div class="question_option">
	<p> @if($option->is_correct) 
			<i class="fa fa-check-square-o"></i>
		@else 
			<i class="fa fa-square-o"></i> 
		@endif
		{{ $option->title }} 
		<form class="delete_option_form" action="{{ url('/admin/question_option/'.$option->id) }}" method="POST">
			{{ csrf_field() }}
			{{ method_field('delete') }}
			<button type="submit" class="confirm"><i class="fa fa-trash"></i> Usuń </button>
		</form>
			
	</p>
</div>
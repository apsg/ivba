@if( \Gate::allows(\App\Helpers\GateHelper::ACCESS_COURSE, $course) )
	<h4>Twoja ocena tego kursu</h4> 
	<p>Jak oceniasz ten kurs?</p>
	<div class="star-rating">
	  	<div class="star-rating__wrap">
		    <input class="star-rating__input" id="star-rating-5" type="radio" name="rating" value="5" @if($course->rating && $course->rating->rating == 5) checked="checked" @endif>
		    <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-5" title="5 out of 5 stars"></label>
		    <input class="star-rating__input" id="star-rating-4" type="radio" name="rating" value="4" @if($course->rating && $course->rating->rating == 4) checked="checked" @endif>
		    <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-4" title="4 out of 5 stars"></label>
		    <input class="star-rating__input" id="star-rating-3" type="radio" name="rating" value="3" @if($course->rating && $course->rating->rating == 3) checked="checked" @endif>
		    <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-3" title="3 out of 5 stars"></label>
		    <input class="star-rating__input" id="star-rating-2" type="radio" name="rating" value="2" @if($course->rating && $course->rating->rating == 2) checked="checked" @endif>
		    <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-2" title="2 out of 5 stars"></label>
		    <input class="star-rating__input" id="star-rating-1" type="radio" name="rating" value="1" @if($course->rating && $course->rating->rating == 1) checked="checked" @endif>
		    <label class="star-rating__ico fa fa-star-o fa-lg" for="star-rating-1" title="1 out of 5 stars"></label>
	  	</div>
	</div>
@else
	<p>Nie możesz oceniać tego kursu</p>
@endif

@push('scripts')

<script type="text/javascript">
	$(document).ready(function(){
		$('.star-rating__input').change(function(e){
			$.post('{{ url('/learn/course/'.$course->slug.'/rate') }}', {
				_token: '{{ csrf_token() }}',
				rating: $(this).val()
			});
		});
	});
</script>

@endpush
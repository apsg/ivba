<div class="imageslist">

	@foreach($videos as $video)

		<div class="image video" data-id="{{ $video->id }}" data-src="{{ $video->thumb }}">
			<img src="{{ $video->thumb(200,200) }}">
			<div class="video-filename">{{ $video->filename }}</div>
		</div>

	@endforeach
	
</div>
{{ $videos->links() }}
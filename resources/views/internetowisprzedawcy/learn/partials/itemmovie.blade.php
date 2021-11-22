<div>
    <h3 class="lesson-header">{{ $item->title }}</h3>
    <a href="{{ $item->video->url }}" target="_blank">
        <img src="{{ $item->video->thumb(400,300) }}">
    </a>
</div>

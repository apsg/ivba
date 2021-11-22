<div>
    <h3 class="lesson-header">{{ $item->title }}</h3>
    <a href="{{ $item->image->url }}" target="_blank">
        <img src="{{ $item->image->thumb(300,200) }}">
    </a>
</div>

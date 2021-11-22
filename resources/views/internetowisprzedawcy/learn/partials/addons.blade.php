<div class="bg-white rounded-50 p-5 lesson-content">
    <h3 class="lesson-header">Dodatki</h3>
    @foreach($lesson->items() as $item)
        <div class="border border-secondary rounded mb-3 p-3">
            @include('learn.partials.item' . $item->type)
        </div>
    @endforeach
</div>

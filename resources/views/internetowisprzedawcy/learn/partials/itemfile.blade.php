<div class="d-flex justify-content-between align-items-center mb-2">
    <div class="rounded">
        <a href="{{ $item->link() }}" class="file text-gray">
            {{ $item->title }} [{{ $item->name }}]
        </a>
    </div>
    <a href="{{ $item->link() }}" class="btn btn-red-inversed">
        <i class="fa fa-download"></i> Pobierz ćwiczenie
    </a>
</div>

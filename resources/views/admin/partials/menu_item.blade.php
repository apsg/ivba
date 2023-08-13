<li class="menu_item row" data-id="{{ $item->id }}">
    <a class="col-md-8 row">
        <div class="col-md-6">
            {{ $item->title }}
        </div>
        <div class="col-md-6">
            {{ $item->url }}
        </div>
    </a>
    <div class="col-md-4">
        <form action="{{ url('/admin/menu/'.$item->id) }}" method="POST">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <button type="submit"><i class="fa fa-trash"></i> Usuń</button>
        </form>
    </div>
    @if($item->children->count() > 0)
        <ul>
            @foreach($item->children as $child)
                @include('admin.partials.menu_item', [  'item' => $child ])
            @endforeach
        </ul>
    @endif
</li>

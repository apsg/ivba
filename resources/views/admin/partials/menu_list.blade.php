<ul class="menu_items" data-menu_id="{{ $menu_id }}">
    @foreach($menu_items as $item)
        @include('admin.partials.menu_item', [ 'item' => $item ])
    @endforeach
</ul>

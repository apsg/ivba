<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class MenuItem extends Model
{
    protected $fillable = ['menu_id', 'position', 'title', 'url'];

    /**
     * Wygeneruj menu o określonym id
     * @param  [type] $menu_id [description]
     * @return [type]          [description]
     */
    public static function make($menu_id, $order = 'desc')
    {
        $items = static::where('menu_id', $menu_id)
            ->orderBy('position', $order)
            ->get();

        return $items->map(function ($item) {
            return "<a href='"
                . (filter_var($item->url, FILTER_VALIDATE_URL) ? $item->url : url($item->url))
                . "' " . ($item->is_new_window ? "target='_blank'>" : ">")
                . $item->title . "</a>";
        })->implode('');
    }

    public static function getMenu(int $menuId) : Collection
    {
        return static::where('menu_id', '=', $menuId)
            ->orderBy('position', 'asc')
            ->get();
    }
}

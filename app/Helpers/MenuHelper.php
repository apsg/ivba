<?php
namespace App\Helpers;

use App\MenuItem;

class MenuHelper
{
    public static function make(int $menuId, string $order = 'asc') : string
    {
        $items = MenuItem::getMenu($menuId, $order);

        return $items->map(function ($item) {
            return "<a href='"
                . (filter_var($item->url, FILTER_VALIDATE_URL) ? $item->url : url($item->url))
                . "' " . ($item->is_new_window ? "target='_blank'>" : ">")
                . $item->title . "</a>";
        })->implode('');
    }
}
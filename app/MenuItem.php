<?php

namespace App;

use App\Helpers\MenuHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * App\MenuItem.
 *
 * @property int $id
 * @property string $title
 * @property string $url
 * @property int $is_new_window
 * @property int $menu_id
 * @property int $position
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuItem whereIsNewWindow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuItem whereMenuId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuItem wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuItem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MenuItem whereUrl($value)
 * @mixin \Eloquent
 */
class MenuItem extends Model
{
    protected $fillable = ['menu_id', 'position', 'title', 'url'];

    /**
     * Wygeneruj menu o określonym id.
     */
    public static function make(int $menuId, $order = 'desc')
    {
        return MenuHelper::make($menuId, $order);

        $items = static::where('menu_id', $menuId)
            ->orderBy('position', $order)
            ->get();

        return $items->map(function ($item) {
            return "<a href='"
                . (filter_var($item->url, FILTER_VALIDATE_URL) ? $item->url : url($item->url))
                . "' " . ($item->is_new_window ? "target='_blank'>" : '>')
                . $item->title . '</a>';
        })->implode('');
    }

    public static function getMenu(int $menuId, string $order = 'asc') : Collection
    {
        return static::where('menu_id', '=', $menuId)
            ->orderBy('position', $order)
            ->get();
    }
}

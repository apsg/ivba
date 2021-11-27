<?php
namespace App;

use App\Helpers\MenuHelper;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
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

<?php
namespace App;

use Carbon\Carbon;

/**
 * App\ItemText.
 *
 * @property int $id
 * @property string $title
 * @property string $text
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class ItemText extends Item
{
    public $view = 'admin.partials.item_text';
    public $type = 'text';
}

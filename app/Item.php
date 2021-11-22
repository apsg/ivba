<?php
namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Item.
 *
 * @property int                      $lesson_id
 * @property int                      $items_id
 * @property string                   $items_type
 * @property int                      $position
 * @property-read Collection|Lesson[] $lesson
 */
class Item extends Model
{
    protected $guarded = [];

    public $view = 'admin.partials.item';
    public $type = 'item';

    public static function boot()
    {
        parent::boot();

        /**
         * Podczas usuwania zasobu "odłącz" go wpierw od
         * wszystkich lekcji.
         */
        static::deleting(function ($model) {
            $model->lesson()->detach();
        });
    }

    /**
     * Lekcja, do której należy ten obiekt.
     * @return [type] [description]
     */
    public function lesson()
    {
        return $this->morphToMany(Lesson::class, 'items');
    }

    /**
     * Slug.
     * @return [type] [description]
     */
    public function slug()
    {
        return str_slug((new \ReflectionClass($this))->getShortName());
    }

    /**
     * link usuwania.
     * @return [type] [description]
     */
    public function deleteLink()
    {
        return url('/admin/' . $this->slug() . '/' . $this->id . '/delete');
    }
}

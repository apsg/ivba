<?php

namespace App\Traits;

/**
 * Pilnuje, czy slugi nie zostały zmienione na jakieś niespełniające wymogów.
 */
trait ChecksSlugs
{
    public static function bootChecksSlugs()
    {
        static::saving(function ($model) {
            $dirty = $model->getDirty();

            if (isset($dirty['slug'])) {
                $model->slug = str_slug($model->slug);
            }
        });
    }
}

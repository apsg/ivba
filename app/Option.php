<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Option.
 *
 * @property int $id
 * @property string $key
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Option newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Option newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Option query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Option whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Option whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Option whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Option whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Option whereValue($value)
 * @mixin \Eloquent
 */
class Option extends Model
{
    protected $guarded = [];

    /**
     * Pobierz określoną wartość. Jeśli jej nie ma - utwórz.
     * @param  [type] $key [description]
     * @return [type]      [description]
     */
    public static function get($key)
    {
        $option = static::where('key', $key)->first();
        if ($option) {
            return $option;
        } else {
            return static::create([
                'key' => $key,
                'value' => '',
                ]);
        }
    }

    /**
     * Zapisuje i zwraca wartość opcji o określonym kluczu.
     * @param [type] $key   [description]
     * @param [type] $value [description]
     */
    public static function set($key, $value)
    {
        $option = static::get($key);
        $option->value = $value;
        $option->save();

        return $option;
    }
}

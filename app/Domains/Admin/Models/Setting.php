<?php

namespace App\Domains\Admin\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string key
 * @property string value
 */
class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
    ];

    public static function get(string $key)
    {
        $setting = static::where('key', $key)->first();

        if ($setting === null) {
            return config($key);
        }

        return $setting->value;
    }
}

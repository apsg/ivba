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

    public static function getAll(array $keys) : array
    {
        $settings = [];

        foreach ($keys as $key) {
            $settings[$key] = static::get($key);
        }

        return $settings;
    }

    public static function set(string $key, $value)
    {
        return static::firstOrCreate([
            'key' => $key,
        ])->update([
            'value' => $value,
        ]);
    }
}

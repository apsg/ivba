<?php
namespace App\Helpers;

class ColorHelper
{
    public static function getContrastColor(string $color): string
    {
        $rgb = static::parseColor($color);
        $luminance = static::luminance($rgb);

        if ($luminance > 0.5) {
            return '#000000';
        }

        return '#ffffff';
    }

    public static function parseColor(string $color): array
    {
        $arr = [];
        $color = str_replace('#', '', $color);
        $arr[] = substr($color, 0, 2);
        $arr[] = substr($color, 2, 2);
        $arr[] = substr($color, 4, 2);

        return $arr;
    }

    public static function luminance(array $rgb): float
    {
        return (0.299 * hexdec($rgb[0]) + 0.587 * hexdec($rgb[1]) + 0.114 * hexdec($rgb[2])) / 255;
    }
}

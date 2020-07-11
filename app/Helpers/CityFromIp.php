<?php

namespace App\Helpers;

class CityFromIp
{
    /**
     * Zwraca miasto na podstawie IP, o ile to możliwe.
     * @param  [type] $ip [description]
     * @return [type]     [description]
     */
    public static function get($ip)
    {
        try {
            $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}"));
        } catch (\Exception $ex) {
            return null;
        }

        return $details->city ?? null;
    }
}

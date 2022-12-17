<?php
namespace App\Domains\Admin\Services;

abstract class SettingsSelectDataSource
{
    /**
     * Returns key-value pairs for select
     *
     * @return array<string,string>
     */
    abstract public function toArray(): array;
}

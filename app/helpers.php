<?php

function setting(string $key)
{
    return \App\Domains\Admin\Models\Setting::get($key);
}

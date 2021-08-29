<?php

use App\Domains\Logbooks\Models\Logbook;
use Faker\Generator as Faker;

$factory->define(Logbook::class, function (Faker $faker) {
    return [
        'title'       => $faker->sentence,
        'description' => $faker->paragraph,
    ];
});

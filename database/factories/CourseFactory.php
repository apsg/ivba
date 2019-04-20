<?php

use Faker\Generator as Faker;

$factory->define(App\Course::class, function (Faker $faker) {
    return [
        "title"       => $faker->sentence,
        "description" => $faker->paragraph,
        "slug"        => $faker->slug,
        "user_id"     => 1,
        "position"    => \App\Course::max('position') + 1,
        "delay"       => rand(0, 10),
    ];
});



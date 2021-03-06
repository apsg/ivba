<?php

use App\Course;
use App\User;
use Faker\Generator as Faker;

$factory->define(App\Course::class, function (Faker $faker) {
    return [
        'title'       => $faker->sentence,
        'description' => $faker->paragraph,
        'slug'        => $faker->slug,
        'user_id'     => factory(User::class),
        'position'    => Course::max('position') + 1,
        'delay'       => rand(0, 10),
        'difficulty'  => rand(1, 3),
    ];
});

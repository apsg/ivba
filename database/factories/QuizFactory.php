<?php

use Faker\Generator as Faker;

$factory->define(App\Quiz::class, function (Faker $faker) {
    return [
        'name'           => $faker->sentence,
        'is_certified'   => false,
        'is_random'      => $faker->boolean,
        'pass_threshold' => rand(50, 90),
    ];
});

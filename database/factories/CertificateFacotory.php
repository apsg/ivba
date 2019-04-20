<?php

use Faker\Generator as Faker;

$factory->define(App\Certificate::class, function (Faker $faker) {
    return [
        'title'     => $faker->sentence,
        'course_id' => 1,
    ];
});

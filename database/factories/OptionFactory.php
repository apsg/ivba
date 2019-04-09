<?php

use Faker\Generator as Faker;

$factory->define(App\QuestionOption::class, function (Faker $faker) {
    return [
        'title'      => $faker->sentence,
        'is_correct' => rand(0, 1),
    ];
});

$factory->defineAs(App\QuestionOption::class, 'correct', function (Faker $faker) {
    return [
        'title'      => $faker->sentence,
        'is_correct' => true,
    ];
});

$factory->defineAs(App\QuestionOption::class, 'incorrect', function (Faker $faker) {
    return [
        'title'      => $faker->sentence,
        'is_correct' => false,
    ];
});

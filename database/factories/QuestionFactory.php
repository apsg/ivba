<?php

use App\Question;
use Faker\Generator as Faker;

$factory->define(Question::class, function (Faker $faker) {
    return [
        'type'     => Question::OPEN,
        'title'    => $faker->sentence,
        'content'  => $faker->paragraph,
        'points'   => rand(1, 5),
        'answer'   => 'answer',
        'position' => 0,
    ];
});

/** @var \Faker\Factory */
$factory->defineAs(Question::class, 'single', function (Faker $faker) use ($factory) {
    $question = $factory->raw(Question::class);

    return array_merge($question, [
        'type'   => Question::SINGLE,
        'answer' => null,
    ]);
});

/** @var \Faker\Factory */
$factory->defineAs(Question::class, 'multiple', function (Faker $faker) use ($factory) {
    $question = $factory->raw(Question::class);

    return array_merge($question, [
        'type'   => Question::MULTIPLE,
        'answer' => null,
    ]);
});
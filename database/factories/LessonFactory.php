<?php

use App\Lesson;
use App\User;
use Faker\Generator as Faker;

$factory->define(Lesson::class, function (Faker $faker) {
    return [
        'slug'            => $faker->slug,
        'title'           => $faker->title,
        'description'     => $faker->paragraph,
        'seo_title'       => '',
        'seo_description' => '',
        'price'           => 0,
        'introduction'    => $faker->paragraph,
        'duration'        => $faker->randomNumber(),
        'user_id'         => User::first()->id,
    ];
});

<?php

use App\Course;
use App\QuickSale;
use Faker\Generator as Faker;

$factory->define(QuickSale::class, function (Faker $faker) {
    return [
        'name'            => $faker->sentence,
        'description'     => $faker->paragraph,
        'rules_url'       => $faker->url,
        'price'           => $faker->numberBetween(1, 25),
        'full_price'      => rand() > 0.5 ? null : $faker->numberBetween(25, 50),
        'course_id'       => Course::first()->id,
        'message_email'   => $faker->email,
        'message_subject' => $faker->sentence,
        'message_body'    => $faker->paragraph,
    ];
});



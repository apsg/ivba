<?php

use App\Course;
use App\Domains\Logbooks\Models\LogbookEntry;
use App\User;
use Faker\Generator as Faker;

$factory->define(LogbookEntry::class, function (Faker $faker) {
    return [
        'title'       => $faker->sentence,
        'description' => $faker->paragraph,
        'image'       => $faker->imageUrl(),
        'user_id'     => function () {
            return factory(User::class)->create();
        },
        'course_id'   => function () {
            return factory(Course::class)->create();
        },
    ];
});

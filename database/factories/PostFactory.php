<?php

use App\Domains\Posts\Models\Post;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(Post::class, function (Faker $faker) {
    return [
        'title'        => $faker->sentence(4),
        'slug'         => $faker->slug(2),
        'excerpt'      => $faker->paragraph(5),
        'body'         => $faker->text(),
        'published_at' => $faker->dateTimeThisYear(),
    ];
});

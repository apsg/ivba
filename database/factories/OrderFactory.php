<?php

use App\Order;
use App\User;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'confirmed_at'   => $faker->dateTime,
        'user_id'        => User::inRandomOrder()->first()->id,
        'is_full_access' => true,
        'is_easy_access' => false,
        'price'          => $faker->randomFloat(2, 0, 50),
        'description'    => $faker->sentence,
        'invoice_id'     => null,
    ];
});

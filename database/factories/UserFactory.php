<?php

use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name'                => $faker->name,
        'email'               => $faker->email,
        'password'            => $faker->password,
        'first_name'          => $faker->firstName,
        'last_name'           => $faker->lastName,
        'address'             => $faker->address,
        'full_access_expires' => Carbon::now()->addMonth(),
    ];
});

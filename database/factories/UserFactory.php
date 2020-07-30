<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$KG/JS.HUR4tRgm.0fB/TXe4SRXQME6ydE0h/Po4xezRLZoh0I9ZYm',
        'remember_token' => Str::random(10),
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Granters::class, function (Faker $faker) {
    return [
        "name" => $faker->name,
        "email" => $faker->unique()->safeEmail,
        "cell" => $faker->phoneNumber,
        "home_phone" => $faker->phoneNumber,
    ];
});

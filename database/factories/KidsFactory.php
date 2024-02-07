<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Kids::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'image' => $faker->imageUrl($width = 640, $height = 480),
        'age' => 5,
        'sex' => 'male',
        'bio' => 'some bio',
        'illness' => 'some illness',
        'city' => 'okc',
        'language' => 'english',
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Topic;
use Faker\Generator as Faker;

$factory->define(Topic::class, function (Faker $faker) {
    return [
        'title' => $faker->realText(50),
        'content' => $faker->realText(800),
        'user_id' => $faker->randomDigit(),
    ];
});

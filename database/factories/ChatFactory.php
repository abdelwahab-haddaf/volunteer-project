<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Chat;
use Faker\Generator as Faker;

$factory->define(Chat::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1,201),
        'user_id2' => $faker->numberBetween(1,201),
    ];
});

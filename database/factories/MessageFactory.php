<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Message;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {
    return [
        'receiver_id' => $faker->numberBetween(1,200),
        'sender_id' => $faker->numberBetween(1,200),
        'message' => $faker->realText(200,2),
    ];
});
<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Message;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1,200),
        'chat_id' => $faker->numberBetween(1,200),
        'isRead' => $faker->numberBetween(0,1),
        'content' => $faker->realText(200,2),
    ];
});

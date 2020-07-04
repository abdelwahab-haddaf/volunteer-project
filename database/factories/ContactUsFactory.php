<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ContactUs;
use Faker\Generator as Faker;

$factory->define(contactUs::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1,200),
        'name' => $faker->name,
        'title' => $faker->name,
        'email'  =>$faker->email,
        'isRead' => $faker->numberBetween(0,1),
        'message' => $faker->realText(200,2),
    ];
});

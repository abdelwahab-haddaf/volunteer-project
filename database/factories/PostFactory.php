<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->realText(50,1),
        'address' => $faker->address,
        'content' => $faker->realText(200,2),
        'user_id' => rand(1,200),
        'city_id' => rand(1,200),
        'post_type' => rand(0,1),
    ];
});

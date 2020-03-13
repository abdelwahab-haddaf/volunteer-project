<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'address' => $faker->address,
        'content' => $faker->paragraphs(rand(2,5),true),
        'user_id' => rand(1,200),
    ];
});

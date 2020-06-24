<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Advertisement::class, function (Faker $faker) {
    return [
        'title'=>'This is title',
        'content'=>'This is content',
        'image'=>'car.jpg',
        'url'=>'http://www.google.ps'

    ];
});

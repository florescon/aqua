<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Income;
use Faker\Generator as Faker;

$factory->define(Income::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
		'price' => rand(50, 100),
    ];
});

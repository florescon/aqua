<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\ClassroomType;
use Faker\Generator as Faker;

$factory->define(ClassroomType::class, function (Faker $faker) {
    return [
        'name' => $faker->firstNameFemale,
    ];
});

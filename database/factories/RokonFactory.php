<?php

use Faker\Generator as Faker;

$factory->define(App\Rokon::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        "age" => $faker->numberBetween($min=20, $max=100)
    ];
});

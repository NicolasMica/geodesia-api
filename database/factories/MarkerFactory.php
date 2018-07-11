<?php

use App\User;
use App\Roadwork;
use Faker\Generator as Faker;

$factory->define(App\Marker::class, function (Faker $faker) {

    return [

        'name' => $faker->word,
        'description' => $faker->paragraph(5, true),
        'geometry' => $faker->sha256,
        'latitude' => $faker->randomFloat(2, -60, 60),
        'longitude' => $faker->randomFloat(2, -60, 60),
        'user_id' => function() {
            return factory(User::class)->create()->id;
        },
        'roadwork_id' => function() {
            return factory(Roadwork::class)->create()->id;
        }

    ];

});

<?php

use App\User;
use Faker\Generator as Faker;

$factory->define(App\Roadwork::class, function (Faker $faker) {

    return [

        'name' => $faker->words(1, 5),
        'description' => $faker->paragraph(5, true),
        'from_lat' => $faker->randomFloat(6, -90, 90),
        'to_lat' => $faker->randomFloat(6, -90, 90),
        'from_long' => $faker->randomFloat(6, -180, 180),
        'to_long' => $faker->randomFloat(6, -180, 180),
        'user_id' => function() {
            return factory(User::class)->create()->id;
        },
        'referent' => $faker->name,
        'department' => $faker->departmentName

    ];

});

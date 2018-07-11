<?php

use App\User;
use Faker\Generator as Faker;

$factory->define(App\Roadwork::class, function (Faker $faker) {

    return [

        'name' => $faker->name,
        'description' => $faker->paragraph(5, true),
        'geometry' => $faker->sha256,
        'user_id' => function() {
            return factory(User::class)->create()->id;
        },
        'referent' => $faker->name,
        'department' => $faker->randomDigit . $faker->randomDigit

    ];
    
});

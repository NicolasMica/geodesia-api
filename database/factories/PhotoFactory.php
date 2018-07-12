<?php

use App\Marker;
use Faker\Generator as Faker;

$factory->define(App\Photo::class, function (Faker $faker) {

    return [
        'description' => $faker->paragraph(5, true),
        'marker_id' => function() {
            return factory(Marker::class)->create()->id;
        }

    ];

});

<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Review::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(5,150),
        'product_id' => $faker->numberBetween(1,32),
        'content' => $faker->paragraph(rand(10, 20)),
        'rating' => $faker->numberBetween(1,3),
    ];
});


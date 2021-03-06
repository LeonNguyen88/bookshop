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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'realname' => str_random(20),
        'phone' => $faker->numberBetween(10000000, 90000000),
        'address' => str_random(50)
    ];
});
$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(7, 10),
        'content' => $faker->paragraph(rand(5, 10)),
        'user_id' => $faker->numberBetween(1, 3)
    ];
});

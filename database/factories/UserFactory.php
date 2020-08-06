<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(App/User::class, function (Faker\Generator $faker) {
    $activated = $faker->randomElement([0, 1]);

    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        // 'email' => $faker->unique()->safeEmail,
        // 'email_verified_at' => now(),
        'password' => bcrypt('password'), // password
        'remember_token' => Str::random(10),
        'activated' => $activated,
        'confirm_code' => $activated ? null : Str::random(60),
    ];
});

$factory->define(App\Article::class, function (Faker\Generator $faker){
    $date = $faker->dateTimeThisMonth;
    $userId = App\User::pluck('id')->toArray();

    return [
        'title' => $faker->sentence(),
        'content' => $faker->paragraph(),
        'user_id' => $faker->randomElement($userId),
        'created_at' => $date,
        'updated_at' => $date,
    ];
});
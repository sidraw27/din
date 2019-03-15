<?php

use Illuminate\Support\Str;
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

$factory->define(\App\Entities\User::class, function (Faker $faker) {
    return [
        'id'             => $faker->numberBetween(1, 100),
        'origin_user_id' => $faker->numberBetween(1, 100),
        'origin_name'    => $faker->name,
        'display_name'   => $faker->name,
        'avatar'         => $faker->imageUrl(),
        'email'          => $faker->unique()->safeEmail,
        'provider'       => \Illuminate\Support\Arr::random(['facebook', 'google']),
        'remember_token' => Str::random(10),
        'created_at'     => $faker->dateTime(),
        'updated_at'     => $faker->dateTime(),
        'deleted_at'     => null
    ];
});

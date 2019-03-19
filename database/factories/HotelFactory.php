<?php

use Illuminate\Support\Arr;
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

$twFaker = \Faker\Factory::create('zh_TW');

$factory->define(\App\Entities\Hotel::class, function (Faker $faker) use ($twFaker) {
    return [
        'url_id'          => $faker->regexify('[A-Z0-9]{6}'),
        'country_id'      => $faker->numberBetween(1, 3),
        'city_id'         => $faker->numberBetween(1, 10),
        'name'            => $faker->company . " hotel",
        'translated_name' => $faker->streetName . "大飯店",
        'address'         => $twFaker->address,
        'geo'             => json_encode([
            'longitude' => $faker->randomFloat(null, 120, 125),
            'latitude'  => $faker->randomFloat(null, 21, 25)
        ]),
        'checkin'         => Arr::random(['14:00', '12:00']),
        'checkout'        => Arr::random(['11:00', '10:00']),
        'introduction'    => $twFaker->realText(rand(100, 200)),
        'created_at'      => $faker->dateTime(),
        'updated_at'      => $faker->dateTime(),
        'deleted_at'      => null
    ];
});
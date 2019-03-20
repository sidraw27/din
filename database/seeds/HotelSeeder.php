<?php

use Illuminate\Support\Arr;

class HotelSeeder extends \Illuminate\Database\Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('en');
        $twFaker = \Faker\Factory::create('zh_TW');

        $entity     = App::make(\App\Entities\Hotel::class);
        $cityEntity = App::make(\App\Entities\City::class);
        $cities     = $cityEntity::all()->toArray();

        for ($i = 1; $i <= 10; $i++) {
            $city = Arr::random($cities, 1);

            $entity->create([
                'url_id'          => $faker->regexify('[A-Z0-9]{6}'),
                'country_id'      => $city[0]['country_id'],
                'city_id'         => $city[0]['id'],
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
            ]);
        }
    }
}
<?php

use Illuminate\Support\Arr;

class HotelSeeder extends AbstractSeeder
{
    public static $hotelNums = 10;

    public static function getSeeder(array $city)
    {
        $faker   = \Faker\Factory::create('en');
        $twFaker = \Faker\Factory::create('zh_TW');

        return [
            'url_id'            => $faker->regexify('[A-Z0-9]{6}'),
            'country_id'        => $city['country_id'],
            'city_id'           => $city['id'],
            'name'              => $faker->company . " hotel",
            'translated_name'   => $faker->streetName . "大飯店",
            'address'           => $twFaker->address,
            'latitude'          => $faker->randomFloat(null, 21, 25),
            'longitude'         => $faker->randomFloat(null, 120, 125),
            'checkin'           => Arr::random(['14:00', '12:00']),
            'checkout'          => Arr::random(['11:00', '10:00']),
            'introduction'      => $faker->realText(200),
            'total_room'        => $faker->numberBetween(10, 1000),
            'total_floor'       => $faker->numberBetween(2, 12),
            'year_of_open'      => $faker->year(),
            'year_of_renovated' => $faker->year()
        ];
    }

    public function run()
    {
        $entity     = App::make(\App\Entities\Hotel::class);
        $cityEntity = App::make(\App\Entities\City::class);
        $cities     = $cityEntity::all()->toArray();

        for ($i = 1; $i <= self::$hotelNums; $i++) {
            $city = Arr::random($cities, 1);

            $entity->create(self::getSeeder($city[0]));
        }
    }
}
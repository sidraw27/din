<?php

use Illuminate\Support\Arr;

class HotelSeeder extends AbstractSeeder
{
    public static $hotelNums = 10;

    public static function getSeeder(array $country)
    {
        $faker   = \Faker\Factory::create('en');
        $twFaker = \Faker\Factory::create('zh_TW');

        return [
            'url_id'            => $faker->regexify('[A-Z0-9]{6}'),
            'country_id'        => $country['id'],
            'city_id'           => null,
            'name'              => $faker->company . " hotel",
            'translated_name'   => $faker->streetName . "大飯店",
            'address'           => $twFaker->address,
            'latitude'          => $faker->randomFloat(null, 21, 25),
            'longitude'         => $faker->randomFloat(null, 120, 125),
            'star_rated'        => $faker->numberBetween(1, 5),
            'checkin'           => Arr::random(['14:00', '12:00']),
            'checkout'          => Arr::random(['11:00', '10:00']),
            'introduction'      => $faker->realText(200),
            'total_room'        => $faker->numberBetween(10, 1000),
            'total_floor'       => $faker->numberBetween(2, 12),
            'year_of_open'      => $faker->year(),
            'year_of_renovated' => $faker->year(),
            'photo'             => $faker->boolean ? json_encode([
                'http://pix5.agoda.net/hotelimages/656/6567220/6567220_19020515050072011620.jpg?s=312x',
                'http://pix2.agoda.net/hotelimages/656/6567220/6567220_19020415350071994970.jpg?s=312x',
                'http://pix5.agoda.net/hotelimages/656/6567220/6567220_19020515050072011612.jpg?s=312x',
                'http://pix5.agoda.net/hotelimages/656/6567220/6567220_19020515050072011613.jpg?s=312x',
                'http://pix4.agoda.net/hotelimages/656/6567220/6567220_19020515050072011614.jpg?s=312x,'
            ]) : null
        ];
    }

    public function run()
    {
        $entity = App::make(\App\Entities\Hotel::class);
        $countryEntity = App::make(\App\Entities\Country::class);
        $countries = $countryEntity::all()->toArray();

        for ($i = 1; $i <= self::$hotelNums; $i++) {
            $country = Arr::random($countries, 1);

            $entity->create(self::getSeeder($country[0]));
        }
    }
}
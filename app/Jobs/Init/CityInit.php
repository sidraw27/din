<?php

namespace App\Jobs\Init;

use Illuminate\Database\Seeder;

class CityInit extends Seeder
{
    public function run()
    {
        $countries = [
            'tw',
            'jp',
            'kr'
        ];

        $disk = \Storage::disk('local');

        foreach ($countries as $country) {
            try {
                $data = $disk->get("country/{$country}.json");
            } catch (\Illuminate\Contracts\Filesystem\FileNotFoundException $e) {
                $this->command->warn("{$country} data seeder error");
                continue;
            }

            $data = json_decode($data, true);

            /** @var \Illuminate\Database\Eloquent\Builder $entity */
            $entity = \App::make(\App\Entities\Country::class);

            $countryId = $entity->insertGetId([
                'origin_name' => $data['origin'],
                'en_name'     => $this->formatString($data['en']),
                'tw_name'     => $this->formatString($data['tw']),
                'code'        => $data['code']
            ]);

            /** @var \Illuminate\Database\Eloquent\Builder $entity */
            $entity = \App::make(\App\Entities\City::class);

            foreach ($data['cities'] as $city) {
                $entity->create([
                    'country_id'  => $countryId,
                    'origin_name' => $this->formatString($city['origin']),
                    'en_name'     => $this->formatString($city['en']),
                    'tw_name'     => $this->formatString($city['tw']),
                    'code'        => $city['code']
                ]);
            }
        }
    }

    private function formatString($word)
    {
        if (strlen($word) === 0) return null;

        return $word;
    }
}
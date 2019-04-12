<?php

namespace App\Jobs\Init;

use Illuminate\Database\Seeder;

class CountryInit extends Seeder
{
    public function run()
    {
        $countries = [
            'tw',
            'jp',
            'kr'
        ];

        $disk = \Storage::disk('resource');

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
            $entity = \App::make(\App\Entities\District::class);

            foreach ($data['districts'] as $district) {
                $entity->create([
                    'country_id'  => $countryId,
                    'origin_name' => $this->formatString($district['origin']),
                    'en_name'     => $this->formatString($district['en']),
                    'tw_name'     => $this->formatString($district['tw']),
                    'code'        => $district['code'],
                    'level'       => 1
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
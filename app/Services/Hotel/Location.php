<?php

namespace App\Services\Hotel;

use App\Repositories\CityRepository;
use App\Repositories\CountryRepository;
use Illuminate\Support\Arr;

class Location
{
    private $countryRepo;
    private $cityRepo;

    public function __construct(CountryRepository $countryRepo, CityRepository $cityRepo)
    {
        $this->countryRepo = $countryRepo;
        $this->cityRepo    = $cityRepo;
    }

    public function getCityInfo(string $cityId)
    {
        $columns = ['id', 'origin_name', 'en_name', 'tw_name'];

        $data = $this->cityRepo->getWithCountry($cityId, Arr::prepend($columns, 'country_id'), $columns);

        $result = [
            'country' => [
                'id' => $data->country->id,
                'name' => [
                    'origin' => $data->country->origin_name,
                    'en' => $data->country->en_name,
                    'tw' => $data->country->tw_name,
                ]
            ],
            'city' => [
                'id' => $data->id,
                'name' => [
                    'origin' => $data->origin_name,
                    'en' => $data->en_name,
                    'tw' => $data->tw_name,
                ]
            ]
        ];

        return $result;
    }
}
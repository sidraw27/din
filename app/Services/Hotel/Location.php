<?php

namespace App\Services\Hotel;

use App\Repositories\CountryRepository;
use Illuminate\Support\Arr;

class Location
{
    private $countryRepo;

    public function __construct(CountryRepository $countryRepo)
    {
        $this->countryRepo = $countryRepo;
    }

    public function getLocationInfo(string $countryId)
    {
        $columns = ['id', 'origin_name', 'en_name', 'tw_name'];

        $data = $this->countryRepo->getById($countryId, $columns);

        $result = [
            'country' => [
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
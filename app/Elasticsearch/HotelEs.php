<?php

namespace App\Elasticsearch;

class HotelEs extends Builder
{
    protected function getIndex()
    {
        return 'hotels';
    }

    public function searchList(string $target, int $page = 1, int $size = 10)
    {
        $from = ($page - 1) * $size;

        $query = [
            'should' => [
                [
                    'match' => [
                        'name' => $target
                    ]
                ],
                [
                    'match' => [
                        'translated_name' => $target
                    ]
                ],
                [
                    'match_phrase' => [
                        'address' => $target
                    ]
                ]
            ]
        ];

        $result = $this->multiSearch($query, ['_score' => 'desc'], $from, $size);

        return $result['_shards']['total'] > 0 ? $result['hits'] : [];
    }

    public function searchByGeo(string $distance, float $latitude, float $longitude, int $from, int $size = 10)
    {
        $query = [
            'filter' => [
                'geo_distance' => [
                    'distance' => $distance,
                    'geo'      => [
                        'lat' => $latitude,
                        'lon' => $longitude
                    ]
                ]
            ]
        ];

        $result = $this->multiSearch($query, ['_score' => 'desc'],$from, $size);

        return $result['_shards']['total'] > 0 ? $result['hits'] : [];
    }
}
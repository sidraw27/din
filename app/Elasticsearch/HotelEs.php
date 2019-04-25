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

        $sort = [
            '_score' => [
                'order' =>'desc'
            ]
        ];

        $result = $this->multiSearch($query, $sort, $from, $size);

        return $result['_shards']['total'] > 0 ? $result['hits'] : [];
    }
}
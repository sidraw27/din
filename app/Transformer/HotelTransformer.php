<?php

namespace App\Transformer;

class HotelTransformer
{
    public static function transToHotelView(array $hotel): array
    {
        return [
            'id'    => $hotel['id'],
            'urlId' => $hotel['url_id'],
            'name'  => [
                'origin'     => $hotel['name'],
                'translated' => $hotel['translated_name']
            ],
            'address'      => $hotel['location']['address'],
            'geo'          => $hotel['location']['geo'],
            'starRated'    => $hotel['star_rated'],
            'countryName'  => $hotel['location']['belong']['country']['name']['tw'] ?? '未取得',
            'introduction' => $hotel['introduction'],
            'supportFacilities' => $hotel['facility'],
            'info'   => $hotel['info'],
            'rating' => $hotel['rating'],
            'photos' => $hotel['photo']
        ];
    }
}
<?php

namespace App\Transformer;

class HotelTransformer
{
    public static function transToHotelView(array $hotel)
    {
        return array_merge($hotel, [
            'countryName' => $hotel['location']['country']['name']['tw'] ?? '未取得',
            'cityName' => $hotel['location']['city']['name']['tw'] ?? '未取得',
        ]);
    }
}
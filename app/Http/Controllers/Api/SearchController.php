<?php

namespace App\Http\Controllers\Api;

use App\Elasticsearch\HotelEs;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    private $hotelEs;

    public function __construct(HotelEs $hotelEs)
    {
        $this->hotelEs = $hotelEs;
    }

    public function getSuggestion(string $string)
    {
        $result = [];

        $esResponse = $this->hotelEs->searchList($string, 1, 5);

        foreach ($esResponse['hits'] as $hit) {
            $hotel = $hit['_source'];

            $result[] = [
                'link'  => route('hotel', ['url_id' => $hotel['url_id']]),
                'name'  => $hotel['translated_name'],
                'sub'   => $hotel['name'],
                'label' => '飯店'
            ];
        }

        return response()->json($result);
    }
}
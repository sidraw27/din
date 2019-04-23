<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Hotel\HotelService;

class SearchController extends Controller
{
    private $hotelService;

    public function __construct(HotelService $hotelService)
    {
        $this->hotelService = $hotelService;
    }

    public function getSuggestion(string $string)
    {
        $result = [];

        $hotels = $this->hotelService->getList($string, 1, 5);

        foreach ($hotels['data'] as $hotel) {
            $result[] = [
                'name'  => $hotel['translatedName'],
                'sub'   => $hotel['name'],
                'label' => '飯店'
            ];
        }

        return response()->json($result);
    }
}
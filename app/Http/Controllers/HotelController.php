<?php

namespace App\Http\Controllers;

use App\Exceptions\HotelException;
use App\Services\HotelService;
use App\Transformer\HotelTransformer;

class HotelController extends Controller
{
    private $hotelService;

    public function __construct(HotelService $hotelService)
    {
        $this->hotelService = $hotelService;
    }

    public function index(string $urlId)
    {
        try {
            $hotel = $this->hotelService->getHotel($urlId);
            $hotel = HotelTransformer::transToHotelView($hotel);
        } catch (HotelException $e) {
            abort(404);
        }

        return view('hotel', compact('hotel'));
    }
}

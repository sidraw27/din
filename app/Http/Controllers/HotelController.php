<?php

namespace App\Http\Controllers;

use App\Services\HotelService;
use App\Transformer\HotelTransformer;
use App\Exceptions\HotelException;

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
            $searchData = $this->hotelService->formatHotelParameter(\Request::all());

            $hotel     = $this->hotelService->getHotel($urlId);
            $hotelView = HotelTransformer::transToHotelView($hotel);

            $searchData['target'] = $hotelView['name']['origin'];
        } catch (HotelException $e) {
            abort(404);
        }

        return view('hotel', compact('hotelView', 'searchData'));
    }

    public function list()
    {
        $searchData = $this->hotelService->formatHotelParameter(\Request::all());

        return view('list', compact('searchData'));
    }
}

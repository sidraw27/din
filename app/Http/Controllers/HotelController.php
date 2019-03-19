<?php

namespace App\Http\Controllers;

use App\Services\HotelService;

class HotelController extends Controller
{
    private $hotelService;

    public function __construct(HotelService $hotelService)
    {
        $this->hotelService = $hotelService;
    }

    public function index(string $hotelId)
    {

    }
}

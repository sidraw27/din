<?php

namespace App\Services\Hotel;

use App\Repositories\HotelHaveFacilityRepository;

class Facility
{
    private $ownFacilityRepo;

    public function __construct(HotelHaveFacilityRepository $hotelHaveFacilityRepo)
    {
        $this->ownFacilityRepo = $hotelHaveFacilityRepo;
    }
}
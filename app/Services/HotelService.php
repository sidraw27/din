<?php

namespace App\Services;

use App\Exceptions\HotelException;
use App\Repositories\HotelRepository;
use App\Services\Hotel\Facility;
use App\Services\Hotel\Location;

class HotelService
{
    private $hotelRepo;
    private $location;
    private $facility;

    public function __construct(HotelRepository $hotelRepo, Location $location, Facility $facility)
    {
        $this->hotelRepo = $hotelRepo;
        $this->location  = $location;
        $this->facility  = $facility;
    }

    /**
     * @param string $urlId
     * @return array
     * @throws HotelException
     */
    public function getHotel(string $urlId): array
    {
        $hotel = $this->hotelRepo->getByUrlId($urlId);

        if (is_null($hotel)) {
            throw new HotelException(HotelException::NOT_FOUND);
        }

        $location = $this->location->getLocation($hotel->city_id);
        $location['address'] = '';
        $location['geo'] = json_decode($hotel->geo, true);

        $result = [
            'urlId' => $hotel->url_id,
            'name' => [
                'origin'     => $hotel->name,
                'translated' => $hotel->translated_name
            ],
            'location' => $location,
            'introduction' => $hotel->introduction,
        ];

        return $result;
    }
}
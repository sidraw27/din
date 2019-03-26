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

        $checkIsNull = [
            'name',
            'url_id',
            'country_id',
            'city_id'
        ];

        foreach ($checkIsNull as $item) {
            if (is_null($hotel->getAttribute($item))) {
                throw new HotelException(HotelException::ITEM_NULL);
            }
        }

        $location = [
            'address' => $hotel->address,
            'geo'     => $hotel->geo,
            'belong'  => $this->location->getCityInfo($hotel->getAttribute('city_id'))
        ];

        $hotel->setAttribute('location', $location);

        return $hotel->toArray();
    }
}
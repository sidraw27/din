<?php

namespace App\Services;

use App\Exceptions\HotelException;
use App\Repositories\HotelRepository;
use App\Services\Hotel\Facility;
use App\Services\Hotel\Location;
use App\Services\Hotel\Rating;

class HotelService
{
    private $hotelRepo;
    private $location;
    private $facility;
    private $rating;

    public function __construct(HotelRepository $hotelRepo, Location $location, Facility $facility, Rating $rating)
    {
        $this->hotelRepo = $hotelRepo;
        $this->location  = $location;
        $this->facility  = $facility;
        $this->rating    = $rating;
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

        $photos = [];
        if ( ! is_null($hotel->photo)) {
            $hotelPhotos = json_decode($hotel->photo);

            foreach ($hotelPhotos as $photoUrl) {
                $photoUrl = filter_var($photoUrl, FILTER_VALIDATE_URL);

                if (is_bool($photoUrl) && ! $photoUrl) {
                    continue;
                }

                $parseUrl = parse_url($photoUrl);
                if ($parseUrl['scheme'] === 'http') {
                    $parseUrl['scheme'] = 'https';
                }
                parse_str($parseUrl['query'], $query);
                if (isset($query['s'])) {
                    $query['s'] = '600x';
                }
                $query = http_build_query($query);
                $photos[] = "{$parseUrl['scheme']}://{$parseUrl['host']}{$parseUrl['path']}?{$query}";
            }
        }
        $hotel->setAttribute('photo', $photos);

        $location = [
            'address' => $hotel->address,
            'geo'     => $hotel->geo,
            'belong'  => $this->location->getCityInfo($hotel->getAttribute('city_id'))
        ];
        $hotel->setAttribute('location', $location);

        $supportFacility = $this->facility->getHotelSupportFacilities($hotel->id);
        $hotel->setAttribute('facility', $supportFacility);

        $info = [
            'roomTotal'     => $hotel->total_room,
            'floorTotal'    => $hotel->total_floor,
            'openYear'      => $hotel->year_of_open,
            'renovatedYear' => $hotel->year_of_renovated,
            'checkinTime'   => $hotel->checkin,
            'checkoutTime'  => $hotel->checkout,
        ];

        $hotel->setAttribute('info', $info);

        $rating = $this->rating->getHotelRating($hotel->id);
        $hotel->setAttribute('rating', $rating);

        return $hotel->toArray();
    }
}
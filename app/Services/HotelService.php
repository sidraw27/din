<?php

namespace App\Services;

use App\Elasticsearch\HotelEs;
use App\Exceptions\HotelException;
use App\Repositories\HotelRepository;
use App\Services\Hotel\Facility;
use App\Services\Hotel\Location;
use App\Services\Hotel\Rating;

class HotelService
{
    private $hotelEs;
    private $hotelRepo;
    private $location;
    private $facility;
    private $rating;

    public function __construct(
        HotelEs $hotelEs,
        HotelRepository $hotelRepo,
        Location $location,
        Facility $facility,
        Rating $rating
    ) {
        $this->hotelEs   = $hotelEs;
        $this->hotelRepo = $hotelRepo;
        $this->location  = $location;
        $this->facility  = $facility;
        $this->rating    = $rating;
    }

    /**
     * @param $id
     * @return array
     * @throws HotelException
     */
    public function getHotel($id): array
    {
        $hotel = null;

        if (is_string($id) && strlen($id) === 6) {
            $hotel = $this->hotelRepo->getByUrlId($id);
        } else if (is_numeric($id)) {
            $hotel = $this->hotelRepo->getById($id);
        }

        if (is_null($hotel)) {
            throw new HotelException(HotelException::NOT_FOUND);
        }

        $checkIsNull = [
            'name',
            'url_id',
            'country_id'
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
                $query    = http_build_query($query);
                $photos[] = "{$parseUrl['scheme']}://{$parseUrl['host']}{$parseUrl['path']}?{$query}";
            }
        }
        $hotel->setAttribute('photo', $photos);

        $location = [
            'address' => $hotel->address,
            'geo'     => $hotel->geo,
            'belong'  => $this->location->getLocationInfo($hotel->getAttribute('country_id'))
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

    /**
     * @param string $target
     * @param int $page
     * @return \Illuminate\Database\Eloquent\Collection
     * @throws HotelException
     */
    public function getList(string $target, int $page = 1)
    {
        $esResult = $this->hotelEs->searchList($target, $page, 10);

        if ($esResult['total'] === 0) {
            throw new HotelException(HotelException::LIST_EMPTY);
        }

        $hotelIds = [];

        foreach ($esResult['hits'] as $item) {
            $hotelIds[] = $item['_id'];
        }

        $columns = [
            'url_id',
            'name',
            'translated_name',
            'address'
        ];

        $hotels = $this->hotelRepo->getByIds($hotelIds, $columns);

        return $hotels;
    }

    /**
     * @param array $parameter
     * @return array
     */
    public function formatHotelParameter(array $parameter)
    {
        $result = [
            'target'   => '',
            'checkIn'  => date('Y-m-d', strtotime('+ 10 day')),
            'checkOut' => date('Y-m-d', strtotime('+ 13 day')),
            'adult'    => 2,
        ];

        $dateReg = '/([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))/';

        foreach ($result as $key => &$defaultValue) {
            if ( ! isset($parameter[$key]) || is_null($parameter[$key])) {
                continue;
            }
            $value = $parameter[$key];

            switch ($key) {
                case 'target':
                    break;
                case 'checkIn':
                    if ( ! preg_match($dateReg, $value)) {
                        continue 2;
                    }
                    break;
                case 'checkOut':
                    if ( ! preg_match($dateReg, $value)) {
                        continue 2;
                    }
                    break;
                case 'adult':
                    if ( ! is_numeric($value) || ($value > 8 && $value < 1)) {
                        continue 2;
                    }

                    $result['adult'] = $value;
                    break;
            }

            $defaultValue = $value;
        }

        return $result;
    }
}
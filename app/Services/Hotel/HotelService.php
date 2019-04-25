<?php

namespace App\Services\Hotel;

use App\Elasticsearch\HotelEs;
use App\Exceptions\HotelException;
use App\Repositories\HotelRepository;
use App\Support\Geophysical;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Arr;

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

                if (isset($parseUrl['query'])) {
                    parse_str($parseUrl['query'], $query);
                    if (isset($query['s'])) {
                        $query['s'] = '600x';
                    }
                    $query = http_build_query($query);
                } else {
                    $query = '?s=600x';
                }

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

    public function getRelatedHotel()
    {
        $result = [];
//        $esResponse = $this->hotelEs->searchByGeo("$distance", $latitude, $longitude, 1, 10);
//
//        if ($esResponse['total'] === 0) {
//            return $result;
//        }
//
//        foreach ($esResponse['hits'] as $hit) {
//            $source = $hit['_source'];
//            $distance = Geophysical::getDistance($latitude, $longitude, $source['geo']['lat'], $source['geo']['lon']);
//
//            $hotel = $this->hotelRepo->getById($hit['_id']);
//
//            $photo = null;
//            if ( ! is_null($hotel->photo) && $hotel->photo !== '') {
//                $photos = json_decode($hotel->photo);
//                $photo  = Arr::first($photos);
//            }
//
//            $rating = $this->rating->getHotelRating($hotel['id']);
//
//            $result[] = [
//                'name' => [
//                    'origin' => $hotel['name'],
//                    'translated' => $hotel['translated_name']
//                ],
//                'link'      => route('hotel', ['url_id' => $hotel['url_id']]),
//                'distance'  => $distance,
//                'photo'     => $photo,
//                'starRated' => $hotel['star_rated'],
//                'rating'    => $rating
//            ];
//        }

        return $result;
    }

    public function getNearHotel(float $latitude, float $longitude, float $kilometer = 1)
    {
        $result = [];

        if (floor($kilometer) !== $kilometer) {
            $meter = floor(1000 * $kilometer);
            $distance = "{$meter}m";
        } else {
            $distance = "{$kilometer}km";
        }

        $esResponse = $this->hotelEs->searchByGeo("$distance", $latitude, $longitude, 1, 10);

        if ($esResponse['total'] === 0) {
            return $result;
        }

        foreach ($esResponse['hits'] as $hit) {
            $source = $hit['_source'];
            $distance = Geophysical::getDistance($latitude, $longitude, $source['geo']['lat'], $source['geo']['lon']);

            $result[] = [
                'name'     => $source['translated_name'],
                'link'     => route('hotel', ['url_id' => $source['url_id']]),
                'distance' => $distance
            ];
        }

        return $result;
    }

    /**
     * @param string $target
     * @param int $currentPage
     * @param int $perPage
     * @param array $withParameter
     * @return array
     */
    public function getList(string $target, int $currentPage = 1, int $perPage = 10, array $withParameter = [])
    {
        $result = [
            'total' => 0,
            'data'  => []
        ];

        $esResponse = $this->hotelEs->searchList($target, $currentPage, $perPage);

        if ($esResponse['total'] === 0) {
            return $result;
        }

        $result['total'] = $esResponse['total'];

        $hotelIds = [];

        foreach ($esResponse['hits'] as $item) {
            $hotelIds[] = $item['_id'];
        }

        $columns = [
            'id',
            'url_id',
            'name',
            'translated_name',
            'address',
            'star_rated',
            'photo'
        ];

        $hotNums = 0;
        foreach ($hotelIds as $hotelId) {
            $hotel = $this->hotelRepo->getById($hotelId, $columns);

            $photos = json_decode($hotel->photo);

            $rating = $this->rating->getHotelRating($hotel->id);

            // 暫時讓前三間搜尋相關飯店出現標籤
            $isHot = false;
            if ($currentPage === 1 && $hotNums < 3) {
                $hotNums++;
                $isHot = true;
            }

            $result['data'][] = [
                'id'              => $hotel->id,
                'isHot'           => $isHot,
                'urlId'           => $hotel->url_id,
                'name'            => $hotel->name,
                'translatedName'  => $hotel->translated_name,
                'ratingScore'     => $rating['statistics']['avg'],
                'ratingPromotion' => $rating['statistics']['promotion'],
                'address'         => $hotel->address,
                'starRated'       => $hotel->star_rated,
                'photo'           => empty($photos) ? null : Arr::first($photos),
                'link'            => route('hotel', ['url_id' => $hotel->url_id]) . '?' . http_build_query($withParameter),
            ];
        }

        $result['paginate'] = new LengthAwarePaginator(
            (object) [],
            $result['total'],
            $perPage,
            $currentPage,
            ['pageName' => 'page', 'path' => Paginator::resolveCurrentPath()]
        );

        return $result;
    }

    /**
     * @param array $parameter
     * @return array
     */
    public static function formatHotelParameter(array $parameter)
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
                    if (is_null($value)) {
                        continue 2;
                    }
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
                    $value = (int) $value;
                    if (($value >= 1 && $value <= 8)) {
                        $defaultValue = (int) $value;
                    }
                    continue 2;
                    break;
            }

            $defaultValue = $value;
        }

        return $result;
    }
}
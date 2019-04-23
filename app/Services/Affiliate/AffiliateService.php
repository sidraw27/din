<?php

namespace App\Services\Affiliate;

use App\Exceptions\HotelException;
use App\Exceptions\ProviderException;
use App\Repositories\HotelAffiliateRepository;
use App\Repositories\HotelRepository;
use App\Support\DateRange;

class AffiliateService
{
    private $hotelRepo;
    private $hotelAffiliateRepo;

    public function __construct(HotelRepository $hotelRepo, HotelAffiliateRepository $hotelAffiliateRepo)
    {
        $this->hotelRepo = $hotelRepo;
        $this->hotelAffiliateRepo = $hotelAffiliateRepo;
    }

    /**
     * @param string $provider
     * @param string $hotelUrlId
     * @param string $checkIn
     * @param string $checkOut
     * @param int $nums
     * @return array
     * @throws ProviderException
     * @throws HotelException
     */
    public function getPriceByProvider(string $provider, string $hotelUrlId, string $checkIn, string $checkOut, int $nums)
    {
        try {
            $affiliate = Factory::make($provider);
        } catch (\Exception $e) {
            throw new ProviderException(ProviderException::NOT_FOUND);
        }

        $hotel = $this->hotelRepo->getByUrlId($hotelUrlId, ['id']);

        if (is_null($hotel)) {
            throw new HotelException(HotelException::NOT_FOUND);
        }

        $affiliateEntity = $this->hotelAffiliateRepo->getByHotelId($hotel->id);
        if (is_null($affiliateEntity)) {
            throw new HotelException(HotelException::AFFILIATE_NOT_FOUND);
        }

        $providerId = $affiliateEntity->getAttribute("{$provider}_hotel_id");

        try {
            $result = $affiliate->getRealTimePrice($providerId, new DateRange($checkIn, $checkOut), $nums);
        } catch (\Exception $e) {
            throw new HotelException(HotelException::PRICE_NOT_GET);
        }

        return $result->get();
    }
}
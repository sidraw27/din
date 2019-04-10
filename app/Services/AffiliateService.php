<?php

namespace App\Services;

use App\Exceptions\HotelException;
use App\Exceptions\ProviderException;
use App\Repositories\HotelAffiliateRepository;
use App\Services\Affiliate\Factory;
use App\Support\DateRange;

class AffiliateService
{
    private $hotelAffiliateRepo;

    public function __construct(HotelAffiliateRepository $hotelAffiliateRepo)
    {
        $this->hotelAffiliateRepo = $hotelAffiliateRepo;
    }

    /**
     * @param string $provider
     * @param int $hotelId
     * @param string $checkIn
     * @param string $checkOut
     * @param int $nums
     * @return array
     * @throws ProviderException
     * @throws HotelException
     */
    public function getPriceByProvider(string $provider, int $hotelId, string $checkIn, string $checkOut, int $nums)
    {
        try {
            $affiliate = Factory::make($provider);
        } catch (\Exception $e) {
            throw new ProviderException(ProviderException::NOT_FOUND);
        }

        $affiliateEntity = $this->hotelAffiliateRepo->getByHotelId($hotelId);
        $hotelId         = $affiliateEntity->getAttribute("{$provider}_hotel_id");

        try {
            $result = $affiliate->getRealTimePrice($hotelId, new DateRange($checkIn, $checkOut), $nums);
        } catch (\Exception $e) {
            throw new HotelException(HotelException::PRICE_NOT_GET);
        }

        return $result->get();
    }
}
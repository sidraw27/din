<?php

namespace App\Services\Affiliate;

use App\Support\DateRange;

interface AffiliateInterface
{
    public function getRealTimePrice(int $providerHotelId, DateRange $dateRange, int $personNums): AbstractAffiliatePrice;
}
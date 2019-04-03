<?php

namespace App\Repositories;

use App\Entities\HotelAffiliate;

class HotelAffiliateRepository extends AbstractRepository
{
    /**
     * HotelAffiliateRepository constructor.
     * @param HotelAffiliate | \Illuminate\Database\Eloquent\Builder $entity
     */
    public function __construct(HotelAffiliate $entity)
    {
        $this->entity = $entity;
        $this->setPrefix('HotelAffiliate:');
    }

    public function getByHotelId(int $hotelId)
    {
        return $this->entity
            ->where('hotel_id', $hotelId)
            ->first();
    }
}
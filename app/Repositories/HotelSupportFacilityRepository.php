<?php

namespace App\Repositories;

use App\Entities\HotelSupportFacility;

class HotelSupportFacilityRepository extends AbstractRepository
{
    /**
     * HotelSupportFacilityRepository constructor.
     * @param HotelSupportFacility | \Illuminate\Database\Eloquent\Builder $entity
     */
    public function __construct(HotelSupportFacility $entity)
    {
        $this->entity = $entity;
        $this->setPrefix('HotelSupportFacility:');
    }

    public function getByHotelId(int $hotelId)
    {
        return $this->entity
            ->where('hotel_id', $hotelId)
            ->where('is_active', true)
            ->with([
                'facility' => function ($query) {
                    $query->select();
                }
            ])
            ->get(['facility_id']);
    }
}
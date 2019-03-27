<?php

namespace App\Repositories;

use App\Entities\HotelSupportFacility;

class HotelSupportFacilityRepository extends AbstractRepository
{
    /**
     * CityRepository constructor.
     * @param HotelSupportFacility | \Illuminate\Database\Eloquent\Builder $entity
     */
    public function __construct(HotelSupportFacility $entity)
    {
        $this->entity = $entity;
        $this->setPrefix('City:');
    }
}
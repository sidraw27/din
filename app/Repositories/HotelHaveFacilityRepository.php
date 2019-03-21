<?php

namespace App\Repositories;

use App\Entities\HotelHaveFacility;

class HotelHaveFacilityRepository extends AbstractRepository
{
    /**
     * CityRepository constructor.
     * @param HotelHaveFacility | \Illuminate\Database\Eloquent\Builder $entity
     */
    public function __construct(HotelHaveFacility $entity)
    {
        $this->entity = $entity;
        $this->setPrefix('City:');
    }
}
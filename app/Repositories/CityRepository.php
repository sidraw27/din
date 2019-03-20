<?php

namespace App\Repositories;

use App\Entities\City;

class CityRepository extends AbstractRepository
{
    /**
     * CityRepository constructor.
     * @param City | \Illuminate\Database\Eloquent\Builder $entity
     */
    public function __construct(City $entity)
    {
        $this->entity = $entity;
        $this->setPrefix('City:');
    }
}
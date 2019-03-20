<?php

namespace App\Repositories;

use App\Entities\Country;

class CountryRepository extends AbstractRepository
{
    /**
     * CountryRepository constructor.
     * @param Country | \Illuminate\Database\Eloquent\Builder $entity
     */
    public function __construct(Country $entity)
    {
        $this->entity = $entity;
        $this->setPrefix('Country:');
    }
}
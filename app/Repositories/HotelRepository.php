<?php

namespace App\Repositories;

use App\Entities\Hotel;

class HotelRepository extends AbstractRepository
{
    /**
     * HotelRepository constructor.
     * @param Hotel | \Illuminate\Database\Eloquent\Builder $entity
     */
    public function __construct(Hotel $entity)
    {
        $this->entity = $entity;
        $this->setPrefix('Hotel:');
    }
}
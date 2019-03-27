<?php

namespace App\Repositories;

use App\Entities\HotelRating;

class HotelRatingRepository extends AbstractRepository
{
    /**
     * RatingRepository constructor.
     * @param HotelRating | \Illuminate\Database\Eloquent\Builder $entity
     */
    public function __construct(HotelRating $entity)
    {
        $this->entity = $entity;
        $this->setPrefix('HotelRating:');
    }
}
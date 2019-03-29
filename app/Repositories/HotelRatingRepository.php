<?php

namespace App\Repositories;

use App\Entities\HotelRating;

class HotelRatingRepository extends AbstractRepository
{
    /**
     * HotelRatingRepository constructor.
     * @param HotelRating | \Illuminate\Database\Eloquent\Builder $entity
     */
    public function __construct(HotelRating $entity)
    {
        $this->entity = $entity;
        $this->setPrefix('HotelRating:');
    }

    public function getByHotelId(int $hotelId, array $columns = ['*'])
    {
        return $this->entity
            ->where('hotel_id', $hotelId)
            ->first($columns);
    }
}
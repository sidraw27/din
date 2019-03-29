<?php

namespace App\Repositories;

use App\Entities\AgodaRating;
use App\Entities\BookingRating;
use App\Entities\HotelRating;

class HotelRatingRepository extends AbstractRepository
{
    private $agodaEntity;
    private $bookingEntity;

    /**
     * HotelRatingRepository constructor.
     * @param HotelRating | \Illuminate\Database\Eloquent\Builder $entity
     * @param AgodaRating | \Illuminate\Database\Eloquent\Builder $agodaEntity
     * @param BookingRating | \Illuminate\Database\Eloquent\Builder $bookingEntity
     */
    public function __construct(HotelRating $entity, AgodaRating $agodaEntity, BookingRating $bookingEntity)
    {
        $this->entity        = $entity;
        $this->agodaEntity   = $agodaEntity;
        $this->bookingEntity = $bookingEntity;
        $this->setPrefix('HotelRating:');
    }

    public function getByHotelId(int $hotelId, array $columns = ['*'])
    {
        return $this->entity
            ->where('hotel_id', $hotelId)
            ->with('agoda')
            ->with('booking')
            ->first($columns);
    }
}
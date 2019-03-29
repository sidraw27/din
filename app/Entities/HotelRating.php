<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class HotelRating extends Model
{
    public $timestamps = false;

    public function agoda()
    {
        return $this->hasOne(AgodaRating::class,'id', 'agoda_id');
    }

    public function booking()
    {
        return $this->hasOne(BookingRating::class,'id', 'booking_id');
    }
}
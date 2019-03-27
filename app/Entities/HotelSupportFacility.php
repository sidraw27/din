<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class HotelSupportFacility extends Model
{
    public $timestamps = false;

    public function facility()
    {
        return $this->hasOne(HotelFacility::class, 'id', 'facility_id');
    }
}
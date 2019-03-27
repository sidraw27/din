<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HotelRating extends Model
{
    // You should always use soft delete to protect your data
    use SoftDeletes;

    public $timestamps = true;
}
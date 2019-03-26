<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    // You should always use soft delete to protect your data
    use SoftDeletes;

    public $guarded = [];

    public $timestamps = true;

    public function getGeoAttribute()
    {
        return [
            'lat' => (float) $this->getAttribute('latitude'),
            'lng' => (float) $this->getAttribute('longitude'),
        ];
    }
}
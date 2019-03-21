<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    // You should always use soft delete to protect your data
    use SoftDeletes;

    public $timestamps = false;

    public function country()
    {
        return $this->hasOne(Country::class,'id', 'country_id');
    }
}
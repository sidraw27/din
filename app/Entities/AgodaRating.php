<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class AgodaRating extends Model
{
    public $timestamps = true;

    protected $hidden = ['created_at', 'updated_at'];
}
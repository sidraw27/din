<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticate;

class User extends Authenticate
{
    // You should always use soft delete to protect your data
    use SoftDeletes;
    use Notifiable;

    public $fillable = [
        'provider_user_id',
        'origin_name',
        'display_name',
        'avatar',
        'email',
        'provider'
    ];

    protected $hidden = [
        'remember_token',
    ];

    public $timestamps = true;
}

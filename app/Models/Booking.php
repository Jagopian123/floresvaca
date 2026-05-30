<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'trip_id',
        'name',
        'email',
        'phone',
        'travel_date',
        'pax',
        'message',
    ];

    protected $casts = [
        'travel_date' => 'date',
    ];
}

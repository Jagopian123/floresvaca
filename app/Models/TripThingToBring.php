<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TripThingToBring extends Model
{
    protected $table = 'trip_things_to_bring';

    protected $fillable = [
        'trip_id',
        'item',
        'sort_order',
    ];
}

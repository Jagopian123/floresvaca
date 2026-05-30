<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TripExclude extends Model
{
    protected $fillable = [
        'trip_id',
        'item',
        'sort_order',
    ];
}

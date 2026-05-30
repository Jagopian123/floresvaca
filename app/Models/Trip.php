<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Trip extends Model
{
    protected $fillable = [
        'category',
        'title',
        'slug',
        'short_description',
        'description',
        'image',
        'price',
        'price_unit',
        'duration_days',
        'min_pax',
        'max_pax',
        'featured',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'price'     => 'decimal:2',
        'featured'  => 'boolean',
        'is_active' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::saving(function (self $model) {
            if (empty($model->image)) {
                $model->image = $model->getOriginal('image');
            }
        });
    }

    public function itineraries(): HasMany
    {
        return $this->hasMany(TripItinerary::class)->orderBy('day');
    }

    public function includes(): HasMany
    {
        return $this->hasMany(TripInclude::class)->orderBy('sort_order');
    }

    public function excludes(): HasMany
    {
        return $this->hasMany(TripExclude::class)->orderBy('sort_order');
    }

    public function thingsToBring(): HasMany
    {
        return $this->hasMany(TripThingToBring::class)->orderBy('sort_order');
    }
}

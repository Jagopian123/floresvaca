<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Destination extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'image',
        'featured',
        'sort_order',
    ];

    protected $casts = [
        'featured' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::saving(function (self $model) {
            if (empty($model->image)) {
                $model->image = $model->getOriginal('image');
            }
        });
    }

}

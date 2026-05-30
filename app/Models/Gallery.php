<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'gallery';

    protected $fillable = [
        'image',
        'featured',
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

<?php

namespace App\Filament\Admin\Resources\GalleryResource\Pages;

use App\Filament\Admin\Resources\GalleryResource;
use App\Models\Gallery;
use Filament\Resources\Pages\CreateRecord;

class CreateGallery extends CreateRecord
{
    protected static string $resource = GalleryResource::class;

    protected function handleRecordCreation(array $data): Gallery
    {
        $images = $data['images'] ?? [];

        $first = null;

        foreach ((array) $images as $url) {
            $record = Gallery::create(['image' => $url, 'featured' => false]);
            $first ??= $record;
        }

        // CreateRecord requires a model instance; return the first created record.
        return $first ?? Gallery::create(['image' => '', 'featured' => false]);
    }
}

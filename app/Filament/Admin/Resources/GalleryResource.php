<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\GalleryResource\Pages;
use App\Models\Gallery;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Intervention\Image\Laravel\Facades\Image;

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;

    /** @phpstan-ignore-next-line */
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationLabel = 'Gallery';

    protected static ?int $navigationSort = 5;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Upload Images')
                ->components([
                    FileUpload::make('images')
                        ->label('Images (select multiple)')
                        ->image()
                        ->multiple()
                        ->disk('public')
                        ->saveUploadedFileUsing(function ($file): string {
                            $directory = 'gallery';
                            $img = Image::read($file->getRealPath());
                            $img->scaleDown(width: 1200);
                            $filename = $directory . '/' . uniqid() . '.jpg';
                            Storage::disk('public')->put($filename, $img->toJpeg(80)->toString());

                            return URL::to('storage/' . $filename);
                        }),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Image')
                    ->width(100)
                    ->imageHeight(70),

                ToggleColumn::make('featured')
                    ->label('Featured'),

                TextColumn::make('created_at')
                    ->label('Uploaded')
                    ->date('d M Y')
                    ->sortable(),
            ])
            ->filters([])
            ->recordActions([
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListGallery::route('/'),
            'create' => Pages\CreateGallery::route('/create'),
        ];
    }
}

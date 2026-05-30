<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\DestinationResource\Pages;
use App\Models\Destination;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class DestinationResource extends Resource
{
    protected static ?string $model = Destination::class;

    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-globe-alt';

    protected static ?string $navigationLabel = 'Destinations';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Destination Info')
                ->components([
                    TextInput::make('name')
                        ->label('Destination Name')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(function ($set, ?string $state) {
                            $set('slug', Str::slug($state));
                        }),

                    TextInput::make('slug')
                        ->label('Slug')
                        ->required()
                        ->maxLength(255)
                        ->unique(Destination::class, 'slug', ignoreRecord: true),

                    Textarea::make('short_description')
                        ->label('Short Description')
                        ->rows(2)
                        ->maxLength(500)
                        ->columnSpanFull(),

                    RichEditor::make('description')
                        ->label('Full Description')
                        ->columnSpanFull(),

                    TextInput::make('sort_order')
                        ->label('Sort Order')
                        ->numeric()
                        ->default(0),

                    Toggle::make('featured')
                        ->label('Featured')
                        ->default(false),
                ])
                ->columns(2),

            Section::make('Destination Image')
                ->components([
                    FileUpload::make('image')
                        ->label('Image')
                        ->image()
                        ->disk('public')
                        ->saveUploadedFileUsing(function ($file): string {
                            $directory = 'destinations';
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
                    ->width(80)
                    ->imageHeight(60),

                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),

                IconColumn::make('featured')
                    ->label('Featured')
                    ->boolean(),

                TextColumn::make('sort_order')
                    ->label('Order')
                    ->sortable(),
            ])
            ->filters([
                TernaryFilter::make('featured')
                    ->label('Featured'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort_order');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListDestinations::route('/'),
            'create' => Pages\CreateDestination::route('/create'),
            'edit'   => Pages\EditDestination::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\TripResource\Pages;
use App\Models\Destination;
use App\Models\Trip;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class TripResource extends Resource
{
    protected static ?string $model = Trip::class;

    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-map';

    protected static ?string $navigationLabel = 'Trips';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Basic Info')
                ->components([
                    Select::make('destination_id')
                        ->label('Destination')
                        ->options(Destination::orderBy('name')->pluck('name', 'id'))
                        ->searchable()
                        ->required(),

                    Select::make('category')
                        ->label('Category')
                        ->options([
                            'phinisi'  => 'Phinisi',
                            'overland' => 'Overland',
                            'day-trip' => 'Day Trip',
                        ])
                        ->required(),

                    TextInput::make('title')
                        ->label('Trip Title')
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
                        ->unique(Trip::class, 'slug', ignoreRecord: true),

                    Textarea::make('short_description')
                        ->label('Short Description')
                        ->rows(2)
                        ->maxLength(500)
                        ->columnSpanFull(),

                    RichEditor::make('description')
                        ->label('Full Description')
                        ->columnSpanFull(),
                ])
                ->columns(2),

            Section::make('Trip Details')
                ->components([
                    TextInput::make('price')
                        ->label('Price')
                        ->numeric()
                        ->prefix('Rp')
                        ->required(),

                    TextInput::make('price_unit')
                        ->label('Price Unit')
                        ->placeholder('per person / per group')
                        ->maxLength(100),

                    TextInput::make('duration_days')
                        ->label('Duration (Days)')
                        ->numeric()
                        ->minValue(1)
                        ->required(),

                    TextInput::make('min_pax')
                        ->label('Min Pax')
                        ->numeric()
                        ->minValue(1),

                    TextInput::make('max_pax')
                        ->label('Max Pax')
                        ->numeric()
                        ->minValue(1),

                    TextInput::make('sort_order')
                        ->label('Sort Order')
                        ->numeric()
                        ->default(0),

                    Toggle::make('featured')
                        ->label('Featured')
                        ->default(false),

                    Toggle::make('is_active')
                        ->label('Active')
                        ->default(true),
                ])
                ->columns(2),

            Section::make('Trip Image')
                ->components([
                    FileUpload::make('image')
                        ->label('Trip Image')
                        ->image()
                        ->disk('public')
                        ->saveUploadedFileUsing(function ($file): string {
                            $directory = 'trips';
                            $img = Image::read($file->getRealPath());
                            $img->scaleDown(width: 1200);
                            $filename = $directory . '/' . uniqid() . '.jpg';
                            Storage::disk('public')->put($filename, $img->toJpeg(80)->toString());
                            return URL::to('storage/' . $filename);
                        }),
                ]),

            Section::make('Itinerary')
                ->components([
                    Repeater::make('itineraries')
                        ->relationship('itineraries')
                        ->schema([
                            TextInput::make('day')
                                ->label('Day')
                                ->numeric()
                                ->required()
                                ->columnSpan(1),

                            TextInput::make('title')
                                ->label('Title')
                                ->required()
                                ->columnSpan(2),

                            Textarea::make('description')
                                ->label('Description')
                                ->rows(3)
                                ->columnSpanFull(),
                        ])
                        ->columns(3)
                        ->orderColumn('day')
                        ->addActionLabel('Add Day')
                        ->collapsible(),
                ]),

            Section::make('Price Includes')
                ->components([
                    Repeater::make('includes')
                        ->relationship('includes')
                        ->schema([
                            TextInput::make('item')
                                ->label('Item')
                                ->required()
                                ->columnSpan(3),

                            TextInput::make('sort_order')
                                ->label('Order')
                                ->numeric()
                                ->default(0)
                                ->columnSpan(1),
                        ])
                        ->columns(4)
                        ->orderColumn('sort_order')
                        ->addActionLabel('Add Include')
                        ->collapsible(),
                ]),

            Section::make('Price Excludes')
                ->components([
                    Repeater::make('excludes')
                        ->relationship('excludes')
                        ->schema([
                            TextInput::make('item')
                                ->label('Item')
                                ->required()
                                ->columnSpan(3),

                            TextInput::make('sort_order')
                                ->label('Order')
                                ->numeric()
                                ->default(0)
                                ->columnSpan(1),
                        ])
                        ->columns(4)
                        ->orderColumn('sort_order')
                        ->addActionLabel('Add Exclude')
                        ->collapsible(),
                ]),

            Section::make('Things to Bring')
                ->components([
                    Repeater::make('thingsToBring')
                        ->relationship('thingsToBring')
                        ->schema([
                            TextInput::make('item')
                                ->label('Item')
                                ->required()
                                ->columnSpan(3),

                            TextInput::make('sort_order')
                                ->label('Order')
                                ->numeric()
                                ->default(0)
                                ->columnSpan(1),
                        ])
                        ->columns(4)
                        ->orderColumn('sort_order')
                        ->addActionLabel('Add Item')
                        ->collapsible(),
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

                TextColumn::make('title')
                    ->label('Trip Title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('category')
                    ->label('Category')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'phinisi'  => 'primary',
                        'overland' => 'success',
                        'day-trip' => 'warning',
                        default    => 'gray',
                    }),

                TextColumn::make('duration_days')
                    ->label('Days')
                    ->sortable(),

                TextColumn::make('price')
                    ->label('Price')
                    ->money('IDR')
                    ->sortable(),

                IconColumn::make('featured')
                    ->label('Featured')
                    ->boolean(),

                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),

                TextColumn::make('sort_order')
                    ->label('Order')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->options([
                        'phinisi'  => 'Phinisi',
                        'overland' => 'Overland',
                        'day-trip' => 'Day Trip',
                    ]),

                TernaryFilter::make('featured')
                    ->label('Featured'),

                TernaryFilter::make('is_active')
                    ->label('Active'),
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
            'index'  => Pages\ListTrips::route('/'),
            'create' => Pages\CreateTrip::route('/create'),
            'edit'   => Pages\EditTrip::route('/{record}/edit'),
        ];
    }
}

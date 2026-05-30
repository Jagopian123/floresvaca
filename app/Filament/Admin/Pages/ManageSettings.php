<?php

namespace App\Filament\Admin\Pages;

use App\Models\Setting;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use BackedEnum;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class ManageSettings extends Page implements HasSchemas
{
    use InteractsWithSchemas;

    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationLabel = 'Settings';

    protected static ?string $title = 'Manage Settings';

    protected static ?int $navigationSort = 99;

    protected string $view = 'filament.pages.manage-settings';

    public ?array $data = [];

    /** @var array<string, string> */
    public array $uploadedImages = [];

    public function mount(): void
    {
        $settings = Setting::allKeyed();

        $this->form->fill([
            'hero_title'               => $settings['hero_title']               ?? '',
            'hero_subtitle'            => $settings['hero_subtitle']            ?? '',
            'contact_wa'               => $settings['contact_wa']               ?? '',
            'contact_phone'            => $settings['contact_phone']            ?? '',
            'contact_email'            => $settings['contact_email']            ?? '',
            'contact_address'          => $settings['contact_address']          ?? '',
            'social_instagram'         => $settings['social_instagram']         ?? '',
            'social_facebook'          => $settings['social_facebook']          ?? '',
            'social_tiktok'            => $settings['social_tiktok']            ?? '',
        ]);
    }

    public function form(Schema $schema): Schema
    {
        $imageUpload = fn (string $name, string $label, string $directory): FileUpload =>
            FileUpload::make($name)
                ->label($label)
                ->image()
                ->disk('public')
                ->saveUploadedFileUsing(function ($file) use ($name, $directory): string {
                    $img = Image::read($file->getRealPath());
                    $img->scaleDown(width: 1920);
                    $filename = $directory . '/' . uniqid() . '.jpg';
                    Storage::disk('public')->put($filename, $img->toJpeg(85)->toString());
                    $url = \Illuminate\Support\Facades\URL::to('storage/' . $filename);
                    $this->uploadedImages[$name] = $url;
                    Setting::set($name, $url);
                    return $url;
                });

        return $schema
            ->components([
                Section::make('Hero Section')
                    ->components([
                        $imageUpload('hero_image', 'Hero Image', 'settings'),

                        TextInput::make('hero_title')
                            ->label('Hero Title')
                            ->maxLength(255),

                        Textarea::make('hero_subtitle')
                            ->label('Hero Subtitle')
                            ->rows(2)
                            ->maxLength(500),
                    ])
                    ->columns(1),

                Section::make('Homepage — Why Travel With Us')
                    ->description('Images for the "Why Travel With Us" section on the homepage')
                    ->components([
                        $imageUpload('why_us_image_main',  'Main Image (large)',          'settings'),
                        $imageUpload('why_us_image_small', 'Secondary Image (small overlay)', 'settings'),
                    ])
                    ->columns(2),

                Section::make('About Page — Who We Are')
                    ->description('Image for the "Who We Are" section on the About page')
                    ->components([
                        $imageUpload('about_who_image', 'Who We Are Image', 'settings'),
                    ])
                    ->columns(1),

                Section::make('Page Banners')
                    ->components([
                        $imageUpload('page_about_image',        'About Page Banner',        'settings'),
                        $imageUpload('page_trips_image',        'Trips Page Banner',        'settings'),
                        $imageUpload('page_destinations_image', 'Destinations Page Banner', 'settings'),
                        $imageUpload('page_testimonials_image', 'Testimonials Page Banner', 'settings'),
                        $imageUpload('page_gallery_image',      'Gallery Page Banner',      'settings'),
                        $imageUpload('page_contact_image',      'Contact Page Banner',      'settings'),
                        $imageUpload('cta_image',               'CTA Background Image',     'settings'),
                    ])
                    ->columns(2),

                Section::make('Contact Info')
                    ->components([
                        TextInput::make('contact_wa')
                            ->label('WhatsApp Number')
                            ->maxLength(20),

                        TextInput::make('contact_phone')
                            ->label('Phone Number')
                            ->maxLength(20),

                        TextInput::make('contact_email')
                            ->label('Email Address')
                            ->email()
                            ->maxLength(255),

                        Textarea::make('contact_address')
                            ->label('Address')
                            ->rows(2)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Social Media')
                    ->components([
                        TextInput::make('social_instagram')
                            ->label('Instagram Handle')
                            ->maxLength(255),

                        TextInput::make('social_facebook')
                            ->label('Facebook Handle')
                            ->maxLength(255),

                        TextInput::make('social_tiktok')
                            ->label('TikTok Handle')
                            ->maxLength(255),
                    ])
                    ->columns(2),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $state = $this->form->getState();

        $textKeys = [
            'hero_title',
            'hero_subtitle',
            'contact_wa',
            'contact_phone',
            'contact_email',
            'contact_address',
            'social_instagram',
            'social_facebook',
            'social_tiktok',
        ];

        foreach ($textKeys as $key) {
            Setting::set($key, $state[$key] ?? null);
        }

        $this->uploadedImages = [];

        Notification::make()
            ->title('Settings saved successfully.')
            ->success()
            ->send();

        $this->mount();
    }
}

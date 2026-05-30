@extends('layouts.app')

@section('title', $trip->title . ' — PT. Flores Vacation Tour')
@section('meta_description', $trip->short_description ?? 'Book ' . $trip->title . ' with PT. Flores Vacation Tour.')

@section('content')

@php
    $wa      = \App\Models\Setting::get('contact_wa', '6281239523657');
    $waText  = "Hello PT. Flores Vacation Tour!\n\nI'm interested in booking:\n*Trip:* {$trip->title}\n*Duration:* {$trip->duration_days} days\n*Price:* Rp " . number_format($trip->price, 0, ',', '.') . "/pax\n\nPlease send me more details. Thank you!";
    $waUrl   = 'https://wa.me/' . $wa . '?text=' . urlencode($waText);
@endphp

{{-- Cinematic Hero --}}
<section class="relative h-[80vh] min-h-[600px] flex items-end overflow-hidden">
    <div class="absolute inset-0">
        <img
            src="{{ $trip->image ?: 'https://images.unsplash.com/photo-1561304929-81e1e4f702c5?w=1920&q=85' }}"
            alt="{{ $trip->title }}"
            class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-[#0F172A] via-[#0F172A]/40 to-transparent"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-[#0F172A]/50 to-transparent"></div>
    </div>

    <div class="relative z-10 section-padding pb-16 md:pb-28 max-w-5xl">
        <nav class="flex items-center gap-2 mb-10 text-[#F8F5F0]/50 text-xs" style="font-family: 'Manrope', sans-serif;">
            <a href="{{ route('home') }}" class="hover:text-[#D6B98C] transition-colors">Home</a>
            <span>/</span>
            <a href="{{ route('trips') }}" class="hover:text-[#D6B98C] transition-colors">Trips</a>
            <span>/</span>
            <span class="text-[#D6B98C]">{{ $trip->title }}</span>
        </nav>

        @if($trip->category)
        <div class="mb-4">
            <span class="bg-[#D6B98C] text-[#0F172A] text-[10px] uppercase tracking-[0.2em] px-3 py-1.5"
                  style="font-family: 'Manrope', sans-serif;">
                {{ $trip->category }}
            </span>
        </div>
        @endif

        <h1 class="text-[#F8F5F0] font-light leading-tight mb-6"
            style="font-family: 'Cormorant Garamond', serif; font-size: clamp(2.5rem, 5vw, 4.5rem);">
            {{ $trip->title }}
        </h1>

        {{-- Meta row --}}
        <div class="flex flex-wrap items-center gap-6 text-[#F8F5F0]/70">
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-[#D6B98C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="text-sm" style="font-family: 'Manrope', sans-serif;">{{ $trip->duration_days }} {{ $trip->duration_days > 1 ? 'Days' : 'Day' }}</span>
            </div>
            @if($trip->min_pax)
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-[#D6B98C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span class="text-sm" style="font-family: 'Manrope', sans-serif;">Min {{ $trip->min_pax }} pax</span>
            </div>
            @endif
        </div>
    </div>
</section>


{{-- Main Content --}}
<section class="py-24 md:py-32 bg-[#F8F5F0]">
    <div class="section-padding">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">

            {{-- ─── Left: Detail Content ─── --}}
            <div class="lg:col-span-2 space-y-16">

                {{-- Description --}}
                @if($trip->description)
                <div>
                    <p class="section-subtitle mb-6">About This Trip</p>
                    <h2 class="section-title mb-8 leading-snug">{{ $trip->short_description }}</h2>
                    <div class="text-[#0F172A]/65 leading-relaxed space-y-4" style="font-family: 'Inter', sans-serif; font-size: 1.0625rem;">
                        {!! nl2br(e($trip->description)) !!}
                    </div>
                </div>
                @endif

                {{-- Itinerary --}}
                @if($trip->itineraries->isNotEmpty())
                <div>
                    <p class="section-subtitle mb-6">Day by Day</p>
                    <h3 class="section-title mb-10">Trip Itinerary</h3>

                    <div class="space-y-6">
                        @foreach($trip->itineraries as $itinerary)
                        <div class="flex gap-6 group">
                            <div class="flex flex-col items-center flex-shrink-0">
                                <div class="w-10 h-10 flex items-center justify-center text-[#F8F5F0] text-sm font-semibold flex-shrink-0"
                                     style="background-color: #0F172A; font-family: 'Manrope', sans-serif;">
                                    {{ $itinerary->day }}
                                </div>
                                @if(!$loop->last)
                                <div class="w-px flex-1 mt-2" style="background-color: #D6B98C; opacity: 0.3;"></div>
                                @endif
                            </div>
                            <div class="pb-8 {{ $loop->last ? '' : 'border-b border-[#0F172A]/8' }} flex-1">
                                <p class="text-[#D6B98C] text-xs uppercase tracking-[0.2em] mb-2" style="font-family: 'Manrope', sans-serif;">Day {{ $itinerary->day }}</p>
                                <h4 class="text-[#0F172A] text-xl font-light mb-3" style="font-family: 'Cormorant Garamond', serif;">{{ $itinerary->title }}</h4>
                                <p class="text-[#0F172A]/60 text-sm leading-relaxed" style="font-family: 'Inter', sans-serif;">{{ $itinerary->description }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Includes / Excludes --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

                    @if($trip->includes->isNotEmpty())
                    <div>
                        <p class="section-subtitle mb-6">What's Covered</p>
                        <h3 class="text-[#0F172A] text-2xl font-light mb-7" style="font-family: 'Cormorant Garamond', serif;">Price Includes</h3>
                        <ul class="space-y-3">
                            @foreach($trip->includes as $include)
                            <li class="flex items-start gap-3">
                                <svg class="w-4 h-4 text-[#2D5A4A] mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-[#0F172A]/70 text-sm leading-relaxed" style="font-family: 'Inter', sans-serif;">{{ $include->item }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if($trip->excludes->isNotEmpty())
                    <div>
                        <p class="section-subtitle mb-6">Not Included</p>
                        <h3 class="text-[#0F172A] text-2xl font-light mb-7" style="font-family: 'Cormorant Garamond', serif;">Price Excludes</h3>
                        <ul class="space-y-3">
                            @foreach($trip->excludes as $exclude)
                            <li class="flex items-start gap-3">
                                <svg class="w-4 h-4 text-[#D6B98C] mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                <span class="text-[#0F172A]/70 text-sm leading-relaxed" style="font-family: 'Inter', sans-serif;">{{ $exclude->item }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                </div>

                {{-- Things to Bring --}}
                @if($trip->thingsToBring->isNotEmpty())
                <div>
                    <p class="section-subtitle mb-6">Be Prepared</p>
                    <h3 class="text-[#0F172A] text-2xl font-light mb-7" style="font-family: 'Cormorant Garamond', serif;">Things to Bring</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @foreach($trip->thingsToBring as $item)
                        <div class="flex items-center gap-3 bg-[#0F172A]/4 px-4 py-3">
                            <svg class="w-4 h-4 text-[#D6B98C] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                            <span class="text-[#0F172A]/70 text-sm" style="font-family: 'Inter', sans-serif;">{{ $item->item }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

            </div>

            {{-- ─── Right: Sticky Booking Card ─── --}}
            <div class="lg:col-span-1">
                <div class="sticky top-28" x-data>
                    <div style="background-color: #0F172A;" class="p-8">

                        {{-- Price --}}
                        <div class="mb-8 pb-8 border-b border-[#F8F5F0]/10">
                            <span class="block text-[#F8F5F0]/40 text-[10px] uppercase tracking-[0.3em] mb-2" style="font-family: 'Manrope', sans-serif;">Starting from</span>
                            <span class="text-[#D6B98C] font-light" style="font-family: 'Cormorant Garamond', serif; font-size: 2.5rem;">
                                Rp {{ number_format($trip->price, 0, ',', '.') }}
                            </span>
                            <span class="text-[#F8F5F0]/40 text-sm ml-2" style="font-family: 'Manrope', sans-serif;">/pax</span>
                        </div>

                        {{-- Trip Info --}}
                        <ul class="space-y-4 mb-10">
                            <li class="flex items-center justify-between">
                                <span class="text-[#F8F5F0]/50 text-xs uppercase tracking-wider" style="font-family: 'Manrope', sans-serif;">Duration</span>
                                <span class="text-[#F8F5F0] text-sm" style="font-family: 'Inter', sans-serif;">{{ $trip->duration_days }} {{ $trip->duration_days > 1 ? 'Days' : 'Day' }}</span>
                            </li>
                            @if($trip->min_pax)
                            <li class="flex items-center justify-between">
                                <span class="text-[#F8F5F0]/50 text-xs uppercase tracking-wider" style="font-family: 'Manrope', sans-serif;">Min Pax</span>
                                <span class="text-[#F8F5F0] text-sm" style="font-family: 'Inter', sans-serif;">{{ $trip->min_pax }} Person{{ $trip->min_pax > 1 ? 's' : '' }}</span>
                            </li>
                            @endif
                            @if($trip->max_pax)
                            <li class="flex items-center justify-between">
                                <span class="text-[#F8F5F0]/50 text-xs uppercase tracking-wider" style="font-family: 'Manrope', sans-serif;">Max Pax</span>
                                <span class="text-[#F8F5F0] text-sm" style="font-family: 'Inter', sans-serif;">{{ $trip->max_pax }} Person{{ $trip->max_pax > 1 ? 's' : '' }}</span>
                            </li>
                            @endif
                            @if($trip->category)
                            <li class="flex items-center justify-between">
                                <span class="text-[#F8F5F0]/50 text-xs uppercase tracking-wider" style="font-family: 'Manrope', sans-serif;">Type</span>
                                <span class="text-[#F8F5F0] text-sm" style="font-family: 'Inter', sans-serif;">{{ $trip->category }}</span>
                            </li>
                            @endif
                        </ul>

                        {{-- Book via WA --}}
                        <a href="{{ $waUrl }}" target="_blank" rel="noopener"
                           class="flex items-center justify-center gap-3 w-full py-4 text-white text-sm font-semibold transition-all duration-300 hover:opacity-90"
                           style="background-color: #25D366; font-family: 'Manrope', sans-serif;">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                            Book via WhatsApp
                        </a>

                        <p class="text-[#F8F5F0]/30 text-xs text-center mt-4 leading-relaxed" style="font-family: 'Inter', sans-serif;">
                            Our team will respond within a few hours to confirm your booking.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection

@extends('layouts.app')

@section('title', 'Our Trips — PT. Flores Vacation Tour')
@section('meta_description', 'Choose from our handcrafted Flores trips — Phinisi cruises, overland adventures, and cultural day trips.')

@section('content')

{{-- Hero Banner --}}
@php
    $heroImage = $settings['page_trips_image'] ?? '';
@endphp

<section class="relative h-[70vh] min-h-[500px] flex items-end overflow-hidden">
    <div class="absolute inset-0">
        <img
            src="{{ $heroImage ?: 'https://images.unsplash.com/photo-1530789253388-582c481c54b0?w=1920&q=85' }}"
            alt="Flores Trips"
            class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-[#0F172A] via-[#0F172A]/40 to-[#0F172A]/10"></div>
    </div>

    <div class="relative z-10 section-padding pb-16 md:pb-24">
        <p class="text-[#D6B98C] text-xs uppercase tracking-[0.4em] mb-4" style="font-family: 'Manrope', sans-serif;">Our Packages</p>
        <h1 class="text-[#F8F5F0] font-light leading-tight" style="font-family: 'Cormorant Garamond', serif; font-size: clamp(2.5rem, 5vw, 4rem);">
            Choose Your<br>Adventure.
        </h1>
    </div>
</section>


{{-- Trips with Filter --}}
<section class="py-24 md:py-32 bg-[#F8F5F0]"
         x-data="{ trips: {{ $trips->toJson() }} }">
    <div class="section-padding">

        {{-- Header --}}
        <div class="mb-14">
            <p class="section-subtitle mb-4">Handcrafted Journeys</p>
            <h2 class="section-title">All Trips</h2>
        </div>

        {{-- Trips Grid (Alpine-rendered) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            <template x-for="trip in trips" :key="trip.id">
                <article class="group cursor-pointer">
                    <a :href="'/trips/' + trip.slug">

                        {{-- Image --}}
                        <div class="relative overflow-hidden mb-5" style="aspect-ratio: 4/3;">
                            <img
                                :src="trip.image || 'https://images.unsplash.com/photo-1561304929-81e1e4f702c5?w=800&q=80'"
                                :alt="trip.title"
                                class="w-full h-full object-cover transform transition-transform duration-700 group-hover:scale-105"
                                loading="lazy">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#0F172A]/50 to-transparent opacity-70"></div>

                        </div>

                        {{-- Content --}}
                        <div>
                            <div class="flex items-center gap-3 mb-2">
                                <span class="text-[#D6B98C] text-xs flex items-center gap-1.5" style="font-family: 'Manrope', sans-serif;">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span x-text="trip.duration_days + (trip.duration_days > 1 ? ' Days' : ' Day')"></span>
                                </span>
                            </div>

                            <h3 class="text-[#0F172A] text-xl font-light leading-snug mb-2 group-hover:text-[#1E3A5F] transition-colors duration-300"
                                style="font-family: 'Cormorant Garamond', serif;"
                                x-text="trip.title">
                            </h3>

                            <p class="text-[#0F172A]/55 text-sm leading-relaxed mb-5 line-clamp-2"
                               style="font-family: 'Inter', sans-serif;"
                               x-text="trip.short_description">
                            </p>

                            <div class="flex items-end justify-between pt-4 border-t border-[#0F172A]/10">
                                <div>
                                    <span class="block text-[10px] uppercase tracking-widest text-[#0F172A]/40 mb-0.5" style="font-family: 'Manrope', sans-serif;">Starting from</span>
                                    <span class="text-[#0F172A] text-xl font-light" style="font-family: 'Cormorant Garamond', serif;">
                                        Rp <span x-text="Number(trip.price).toLocaleString('id-ID')"></span>
                                    </span>
                                    <span class="text-[#0F172A]/40 text-xs ml-1" style="font-family: 'Manrope', sans-serif;">/pax</span>
                                </div>
                                <span class="text-[10px] uppercase tracking-[0.2em] text-[#1E3A5F] underline underline-offset-4" style="font-family: 'Manrope', sans-serif;">
                                    View Trip
                                </span>
                            </div>
                        </div>
                    </a>
                </article>
            </template>

            {{-- Empty state --}}
            <div x-show="trips.length === 0" class="col-span-full text-center py-20">
                <p class="text-[#0F172A]/30 text-2xl" style="font-family: 'Cormorant Garamond', serif;">
                    No trips available yet.
                </p>
            </div>
        </div>

    </div>
</section>


{{-- CTA --}}
@include('components.cta-section')

@endsection

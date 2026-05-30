@extends('layouts.app')

@section('title', $destination->name . ' — PT. Flores Vacation Tour')
@section('meta_description', $destination->short_description ?? 'Explore ' . $destination->name . ' with PT. Flores Vacation Tour.')

@section('content')

{{-- Cinematic Hero --}}
<section class="relative h-screen min-h-[600px] flex items-end overflow-hidden">
    <div class="absolute inset-0">
        <img
            src="{{ $destination->image ?: 'https://images.unsplash.com/photo-1555881400-74d7acaacd8b?w=1920&q=85' }}"
            alt="{{ $destination->name }}"
            class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-[#0F172A] via-[#0F172A]/30 to-transparent"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-[#0F172A]/40 to-transparent"></div>
    </div>

    <div class="relative z-10 section-padding pb-20 md:pb-32">
        <nav class="flex items-center gap-2 mb-10 text-[#F8F5F0]/50 text-xs" style="font-family: 'Manrope', sans-serif;">
            <a href="{{ route('home') }}" class="hover:text-[#D6B98C] transition-colors">Home</a>
            <span>/</span>
            <a href="{{ route('destinations') }}" class="hover:text-[#D6B98C] transition-colors">Destinations</a>
            <span>/</span>
            <span class="text-[#D6B98C]">{{ $destination->name }}</span>
        </nav>


        <h1 class="text-[#F8F5F0] font-light leading-tight max-w-3xl"
            style="font-family: 'Cormorant Garamond', serif; font-size: clamp(3rem, 6vw, 5rem);">
            {{ $destination->name }}
        </h1>
    </div>
</section>


{{-- Description --}}
<section class="py-24 md:py-32 bg-[#F8F5F0]">
    <div class="section-padding">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-20">

            {{-- Main Content --}}
            <div class="lg:col-span-2">
                <p class="section-subtitle mb-6">About This Place</p>
                <h2 class="section-title mb-10">{{ $destination->short_description }}</h2>

                @if($destination->description)
                <div class="prose prose-lg text-[#0F172A]/65 leading-relaxed max-w-none"
                     style="font-family: 'Inter', sans-serif;">
                    {!! nl2br(e($destination->description)) !!}
                </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <div class="lg:col-span-1">
                <div class="bg-[#0F172A] p-8 sticky top-28">
                    <h3 class="text-[#D6B98C] text-sm uppercase tracking-[0.3em] mb-7" style="font-family: 'Manrope', sans-serif;">Quick Info</h3>

                    <ul class="space-y-5">

                        @if($destination->trips->isNotEmpty())
                        <li class="flex items-start gap-3">
                            <svg class="w-4 h-4 text-[#D6B98C] mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                            </svg>
                            <div>
                                <span class="block text-[10px] uppercase tracking-wider text-[#F8F5F0]/40 mb-0.5" style="font-family: 'Manrope', sans-serif;">Available Trips</span>
                                <span class="text-[#F8F5F0]/80 text-sm" style="font-family: 'Inter', sans-serif;">{{ $destination->trips->count() }} package{{ $destination->trips->count() !== 1 ? 's' : '' }}</span>
                            </div>
                        </li>
                        @endif
                    </ul>

                    <div class="mt-10">
                        <a href="{{ route('contact') }}" class="btn-sand w-full justify-center">
                            Book a Trip Here
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


{{-- Related Trips --}}
@if($destination->trips->isNotEmpty())
<section class="py-24 md:py-32" style="background-color: #0F172A;">
    <div class="section-padding">

        <div class="mb-16">
            <p class="section-subtitle mb-4" style="color: #D6B98C;">Explore More</p>
            <h2 class="section-title" style="color: #F8F5F0;">Trips in {{ $destination->name }}</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($destination->trips->where('is_active', true)->take(6) as $trip)
            <article class="group">
                <a href="{{ route('trip.show', $trip->slug) }}" class="block">
                    <div class="relative overflow-hidden mb-5" style="aspect-ratio: 4/3;">
                        <img
                            src="{{ $trip->image ?: 'https://images.unsplash.com/photo-1561304929-81e1e4f702c5?w=800&q=80' }}"
                            alt="{{ $trip->title }}"
                            class="w-full h-full object-cover transform transition-transform duration-700 group-hover:scale-105"
                            loading="lazy">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0F172A]/60 to-transparent"></div>

                        @if($trip->category)
                        <div class="absolute top-4 left-4">
                            <span class="bg-[#D6B98C] text-[#0F172A] text-[10px] uppercase tracking-[0.2em] px-3 py-1.5"
                                  style="font-family: 'Manrope', sans-serif;">
                                {{ $trip->category }}
                            </span>
                        </div>
                        @endif
                    </div>

                    <h3 class="text-[#F8F5F0] text-xl font-light mb-2 group-hover:text-[#D6B98C] transition-colors duration-300"
                        style="font-family: 'Cormorant Garamond', serif;">
                        {{ $trip->title }}
                    </h3>

                    <div class="flex items-center justify-between">
                        <span class="text-[#F8F5F0]/50 text-xs" style="font-family: 'Manrope', sans-serif;">
                            {{ $trip->duration_days }} {{ $trip->duration_days > 1 ? 'Days' : 'Day' }}
                        </span>
                        <span class="text-[#D6B98C] text-lg font-light" style="font-family: 'Cormorant Garamond', serif;">
                            Rp {{ number_format($trip->price, 0, ',', '.') }}
                        </span>
                    </div>
                </a>
            </article>
            @endforeach
        </div>

    </div>
</section>
@endif

@endsection

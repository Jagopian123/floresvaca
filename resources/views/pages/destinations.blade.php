@extends('layouts.app')

@section('title', 'Destinations — PT. Flores Vacation Tour')
@section('meta_description', 'Explore the most breathtaking destinations across Flores Island — from Kelimutu to Komodo, each place tells its own story.')

@section('content')

{{-- Hero Banner --}}
@php
    $heroImage = $settings['page_destinations_image'] ?? '';
@endphp

<section class="relative h-[70vh] min-h-[500px] flex items-end overflow-hidden">
    <div class="absolute inset-0">
        <img
            src="{{ $heroImage ?: 'https://images.unsplash.com/photo-1555881400-74d7acaacd8b?w=1920&q=85' }}"
            alt="Flores Destinations"
            class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-[#0F172A] via-[#0F172A]/40 to-[#0F172A]/10"></div>
    </div>

    <div class="relative z-10 section-padding pb-16 md:pb-24">
        <p class="text-[#D6B98C] text-xs uppercase tracking-[0.4em] mb-4" style="font-family: 'Manrope', sans-serif;">Where to Go</p>
        <h1 class="text-[#F8F5F0] font-light leading-tight" style="font-family: 'Cormorant Garamond', serif; font-size: clamp(2.5rem, 5vw, 4rem);">
            Destinations<br>Worth Every Mile.
        </h1>
    </div>
</section>


{{-- Destinations Grid --}}
<section class="py-24 md:py-32 bg-[#F8F5F0]">
    <div class="section-padding">

        <div class="mb-16">
            <p class="section-subtitle mb-4">Explore Flores</p>
            <h2 class="section-title max-w-xl">
                Each Place, a Story of Its Own.
            </h2>
        </div>

        @if($destinations->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                @foreach($destinations as $index => $destination)
                <article class="group">
                    <a href="{{ route('destination.show', $destination->slug) }}" class="block">
                        {{-- Image --}}
                        <div class="relative overflow-hidden mb-6" style="aspect-ratio: {{ $index % 3 === 0 ? '16/9' : '4/3' }};">
                            <img
                                src="{{ $destination->image ?: 'https://images.unsplash.com/photo-1501854140801-50d01698950b?w=900&q=80' }}"
                                alt="{{ $destination->name }}"
                                class="w-full h-full object-cover transform transition-transform duration-700 group-hover:scale-105"
                                loading="lazy">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#0F172A]/50 to-transparent opacity-60 group-hover:opacity-80 transition-opacity duration-500"></div>

                            {{-- Region badge --}}
                            @if($destination->region)
                            <div class="absolute top-5 left-5">
                                <span class="bg-[#D6B98C] text-[#0F172A] text-[10px] uppercase tracking-[0.2em] px-3 py-1.5"
                                      style="font-family: 'Manrope', sans-serif;">
                                    {{ $destination->region }}
                                </span>
                            </div>
                            @endif

                            {{-- Explore CTA --}}
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                <span class="border border-[#F8F5F0] text-[#F8F5F0] text-xs uppercase tracking-[0.3em] px-6 py-3 backdrop-blur-sm"
                                      style="font-family: 'Manrope', sans-serif;">
                                    Explore
                                </span>
                            </div>
                        </div>

                        {{-- Content --}}
                        <div>
                            @if($destination->location)
                            <p class="text-[#D6B98C] text-[11px] uppercase tracking-[0.2em] mb-2" style="font-family: 'Manrope', sans-serif;">
                                {{ $destination->location }}
                            </p>
                            @endif

                            <h3 class="text-[#0F172A] font-light mb-3 group-hover:text-[#1E3A5F] transition-colors duration-300"
                                style="font-family: 'Cormorant Garamond', serif; font-size: 1.75rem;">
                                {{ $destination->name }}
                            </h3>

                            <p class="text-[#0F172A]/60 text-sm leading-relaxed line-clamp-3"
                               style="font-family: 'Inter', sans-serif;">
                                {{ $destination->short_description }}
                            </p>

                            <div class="flex items-center gap-2 mt-5">
                                <span class="text-[#1E3A5F] text-xs uppercase tracking-[0.2em]" style="font-family: 'Manrope', sans-serif;">Read More</span>
                                <svg class="w-4 h-4 text-[#1E3A5F] transform transition-transform duration-300 group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </div>
                        </div>
                    </a>
                </article>
                @endforeach
            </div>
        @else
            <div class="text-center py-32">
                <p class="text-[#0F172A]/30 text-2xl" style="font-family: 'Cormorant Garamond', serif;">
                    Destinations coming soon.
                </p>
            </div>
        @endif

    </div>
</section>


{{-- CTA Strip --}}
<section class="py-20" style="background-color: #2D5A4A;">
    <div class="section-padding flex flex-col md:flex-row items-center justify-between gap-8">
        <div>
            <p class="text-[#D6B98C] text-xs uppercase tracking-[0.3em] mb-2" style="font-family: 'Manrope', sans-serif;">Can't decide?</p>
            <h3 class="text-[#F8F5F0] text-2xl md:text-3xl font-light" style="font-family: 'Cormorant Garamond', serif;">
                Let us curate the perfect route for you.
            </h3>
        </div>
        <a href="{{ route('contact') }}" class="btn-sand flex-shrink-0">
            Talk to Us
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>
</section>

@endsection

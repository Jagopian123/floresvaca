@extends('layouts.app')

@section('title', 'About Us — PT. Flores Vacation Tour')
@section('meta_description', 'Learn about PT. Flores Vacation Tour — a team of passionate locals dedicated to sharing the authentic beauty of Flores, Indonesia.')

@section('content')

{{-- Hero Banner --}}
@php
    $heroImage = $settings['page_about_image'] ?? '';
@endphp

<section class="relative h-[70vh] min-h-[500px] flex items-end overflow-hidden">
    <div class="absolute inset-0">
        <img
            src="{{ $heroImage ?: 'https://images.unsplash.com/photo-1588668214407-6ea9a6d8c272?w=1920&q=85' }}"
            alt="About PT Flores Vacation Tour"
            class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-[#0F172A] via-[#0F172A]/40 to-[#0F172A]/20"></div>
    </div>

    <div class="relative z-10 section-padding pb-16 md:pb-24">
        <p class="text-[#D6B98C] text-xs uppercase tracking-[0.4em] mb-4" style="font-family: 'Manrope', sans-serif;">About Flores Fun Tour</p>
        <h1 class="text-[#F8F5F0] font-light leading-tight" style="font-family: 'Cormorant Garamond', serif; font-size: clamp(2.5rem, 5vw, 4rem);">
            Born from Flores,<br>Made for the World.
        </h1>
    </div>
</section>


{{-- Our Story --}}
<section class="py-24 md:py-32 bg-[#F8F5F0]">
    <div class="section-padding">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-start">

            <div class="lg:sticky lg:top-28">
                <div class="relative aspect-[3/4] overflow-hidden">
                    <img
                        src="{{ $settings['about_who_image'] ?? 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=800&q=80' }}"
                        alt="Flores coastal view"
                        class="w-full h-full object-cover">
                </div>
                <div class="absolute -bottom-4 -right-4 bg-[#D6B98C] p-6 w-40 hidden lg:block">
                    <p class="text-[#0F172A] text-3xl font-light mb-1" style="font-family: 'Cormorant Garamond', serif;">2015</p>
                    <p class="text-[#0F172A]/70 text-[10px] uppercase tracking-wider" style="font-family: 'Manrope', sans-serif;">Founded</p>
                </div>
            </div>

            <div>
                <p class="section-subtitle mb-6">Get to Know Flores Fun Tour</p>
                <h2 class="section-title mb-8 leading-snug">
                    Your Trusted Partner for Exploring Flores Island<br>
                    
                </h2>

                <div class="space-y-6 text-[#0F172A]/65 leading-relaxed" style="font-family: 'Inter', sans-serif; font-size: 1.0625rem;">
                    <p>
Flores Fun Tour is a licensed local travel operator based in Labuan Bajo. With a passion for showcasing the beauty of Flores, we specialize in creating authentic journeys across iconic destinations such as Komodo Island, Padar, Wae Rebo, and Kelimutu. Our mission is to provide unforgettable adventures while ensuring your comfort, safety, and satisfaction. Whether you’re joining an Open Trip, enjoying a Private Trip, or sailing on a Phinisi boat, our team is dedicated to making your travel experience smooth, memorable, and truly unique.                    </p>
                </div>

                <div class="mt-12 pt-12 border-t border-[#0F172A]/10 grid grid-cols-3 gap-8">
                    @foreach([
                        ['8+', 'Years of Experience'],
                        ['2.000+', 'Happy Travelers'],
                        ['50+', 'Unique Destinations'],
                    ] as [$stat, $label])
                    <div class="text-center">
                        <p class="text-[#0F172A] text-3xl md:text-4xl font-light mb-2" style="font-family: 'Cormorant Garamond', serif;">{{ $stat }}</p>
                        <p class="text-[#0F172A]/50 text-[11px] uppercase tracking-[0.2em]" style="font-family: 'Manrope', sans-serif;">{{ $label }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>


{{-- Values --}}
<section class="py-24 md:py-32" style="background-color: #0F172A;">
    <div class="section-padding">

        <div class="text-center mb-20">
            <p class="section-subtitle mb-4" style="color: #D6B98C;">What We Stand For</p>
            <h2 class="section-title" style="color: #F8F5F0;">Our Values</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
            @php
                $values = [
                    ['icon' => 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'title' => 'Authentic Exploration', 'desc' => 'We go beyond tourist circuits to show you the living, breathing heart of Flores.'],
                    ['icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z', 'title' => 'Passionate Locals', 'desc' => 'Every guide, every driver, every cook — someone who loves Flores from the inside out.'],
                    ['icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z', 'title' => 'Community First', 'desc' => 'Our trips support local artisans, family warungs, and village economies directly.'],
                    ['icon' => 'M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15', 'title' => 'Responsible Travel', 'desc' => 'Leave no trace. Protect wildlife. Respect culture. These are non-negotiables for us.'],
                ];
            @endphp

            @foreach($values as $i => $value)
            <div class="text-center flex flex-col items-center gap-5">
                <div class="w-16 h-16 flex items-center justify-center border border-[#D6B98C]/30">
                    <svg class="w-7 h-7 text-[#D6B98C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="{{ $value['icon'] }}"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-[#F8F5F0] text-lg font-light mb-3" style="font-family: 'Cormorant Garamond', serif;">{{ $value['title'] }}</h3>
                    <p class="text-[#F8F5F0]/55 text-sm leading-relaxed" style="font-family: 'Inter', sans-serif;">{{ $value['desc'] }}</p>
                </div>
                @if($i < count($values) - 1)
                <div class="hidden lg:block absolute"></div>
                @endif
            </div>
            @endforeach
        </div>

    </div>
</section>


{{-- CTA --}}
@include('components.cta-section')

@endsection

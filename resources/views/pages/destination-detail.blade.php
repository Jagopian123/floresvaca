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



@endsection

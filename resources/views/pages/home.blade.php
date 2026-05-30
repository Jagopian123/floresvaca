@extends('layouts.app')

@section('title', 'PT. Flores Vacation Tour — Where the Island Tells Its Own Story')

@section('content')

{{-- ============================================================
     1. HERO SECTION
     ============================================================ --}}
@php
    $heroImage = $settings['hero_image'] ?? '';
    $heroTitle = $settings['hero_title'] ?? 'Where the Island Tells Its Own Story';
    $heroSubtitle = $settings['hero_subtitle'] ?? 'Authentic journeys across the wild and sacred landscapes of Flores, Indonesia — crafted by those who call it home.';
@endphp

<section id="hero"
         class="relative w-full h-screen min-h-[680px] flex items-end overflow-hidden"
         x-data="heroSection()"
         x-init="init()">

    {{-- Background Image --}}
    <div class="absolute inset-0">
        <img
            src="{{ $heroImage ?: 'https://images.unsplash.com/photo-1518259102261-b40117eabbc9?w=1920&q=85' }}"
            alt="Flores Island"
            class="w-full h-full object-cover"
            id="hero-bg">
        {{-- Gradient overlay --}}
        <div class="absolute inset-0 bg-gradient-to-t from-[#0F172A] via-[#0F172A]/40 to-transparent"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-[#0F172A]/60 to-transparent"></div>
    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-10 right-10 hidden md:flex flex-col items-center gap-2 opacity-60" id="hero-scroll">
        <div class="w-px h-16 bg-[#D6B98C]" style="transform-origin: top;"></div>
        <span class="text-[#D6B98C] text-[10px] uppercase tracking-[0.3em] rotate-90 mt-2" style="font-family: 'Manrope', sans-serif;">Scroll</span>
    </div>

    {{-- Hero Content --}}
    <div class="relative z-10 section-padding pb-20 md:pb-28 max-w-4xl">

        <p class="text-[#D6B98C] text-xs uppercase tracking-[0.4em] mb-6 opacity-0" id="hero-label"
           style="font-family: 'Manrope', sans-serif;">
            Flores, Eastern Indonesia
        </p>

        <h1 class="text-[#F8F5F0] font-light leading-[1.1] mb-8 opacity-0" id="hero-title"
            style="font-family: 'Cormorant Garamond', serif; font-size: clamp(2.8rem, 6vw, 5rem);">
            {{ $heroTitle }}
        </h1>

        <p class="text-[#F8F5F0]/70 text-base md:text-lg leading-relaxed mb-10 max-w-xl opacity-0" id="hero-sub"
           style="font-family: 'Inter', sans-serif;">
            {{ $heroSubtitle }}
        </p>

        <div class="flex flex-wrap gap-4 opacity-0" id="hero-cta">
            <a href="{{ route('trips') }}" class="btn-sand">
                Explore Our Trips
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
            <a href="{{ route('destinations') }}" class="btn-outline" style="border-color: rgba(248,245,240,0.4); color: #F8F5F0;">
                See Destinations
            </a>
        </div>
    </div>
</section>


{{-- ============================================================
     2. TRIPS SECTION
     ============================================================ --}}
<section class="py-24 md:py-32 bg-[#F8F5F0]">
    <div class="section-padding">

        {{-- Section Header --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
            <div>
                <p class="section-subtitle mb-4">Our Packages</p>
                <h2 class="section-title">Featured Trips</h2>
            </div>
            <a href="{{ route('trips') }}" class="btn-outline self-start md:self-auto">
                View All Trips
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>

        @if($featuredTrips->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($featuredTrips as $index => $trip)
            <article class="group cursor-pointer {{ $index === 0 ? 'md:col-span-2 lg:col-span-1' : '' }}">
                <a href="{{ route('trip.show', $trip->slug) }}" class="block">
                    {{-- Image --}}
                    <div class="relative overflow-hidden mb-5" style="aspect-ratio: 4/3;">
                        <img
                            src="{{ $trip->image ?: 'https://images.unsplash.com/photo-1561304929-81e1e4f702c5?w=800&q=80' }}"
                            alt="{{ $trip->title }}"
                            class="w-full h-full object-cover transform transition-transform duration-700 group-hover:scale-105"
                            loading="lazy">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0F172A]/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                        {{-- Category badge --}}
                        <div class="absolute top-4 left-4">
                            <span class="bg-[#D6B98C] text-[#0F172A] text-[10px] uppercase tracking-[0.2em] px-3 py-1.5"
                                  style="font-family: 'Manrope', sans-serif;">
                                {{ $trip->category ?? 'Adventure' }}
                            </span>
                        </div>

                        {{-- Price overlay on hover --}}
                        <div class="absolute bottom-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <span class="text-[#D6B98C] text-lg font-light" style="font-family: 'Cormorant Garamond', serif;">
                                Rp {{ number_format($trip->price, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    {{-- Content --}}
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <svg class="w-3.5 h-3.5 text-[#D6B98C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="text-[#D6B98C] text-xs" style="font-family: 'Manrope', sans-serif;">
                                {{ $trip->duration_days }} {{ $trip->duration_days > 1 ? 'Days' : 'Day' }}
                                @if($trip->min_pax) &nbsp;·&nbsp; Min {{ $trip->min_pax }} pax @endif
                            </span>
                        </div>

                        <h3 class="text-[#0F172A] text-xl font-light leading-snug mb-2 group-hover:text-[#1E3A5F] transition-colors duration-300"
                            style="font-family: 'Cormorant Garamond', serif;">
                            {{ $trip->title }}
                        </h3>

                        <p class="text-[#0F172A]/60 text-sm leading-relaxed mb-4 line-clamp-2"
                           style="font-family: 'Inter', sans-serif;">
                            {{ $trip->short_description }}
                        </p>

                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-[10px] uppercase tracking-widest text-[#0F172A]/40 block mb-0.5" style="font-family: 'Manrope', sans-serif;">Starting from</span>
                                <span class="text-[#0F172A] text-xl font-light" style="font-family: 'Cormorant Garamond', serif;">
                                    Rp {{ number_format($trip->price, 0, ',', '.') }}
                                </span>
                                <span class="text-[#0F172A]/50 text-xs ml-1" style="font-family: 'Manrope', sans-serif;">/pax</span>
                            </div>
                            <span class="text-[10px] uppercase tracking-[0.2em] text-[#1E3A5F] underline underline-offset-4"
                                  style="font-family: 'Manrope', sans-serif;">
                                View Trip
                            </span>
                        </div>
                    </div>
                </a>
            </article>
            @endforeach
        </div>
        @else
        <div class="text-center py-20">
            <p class="text-[#0F172A]/40 text-lg" style="font-family: 'Cormorant Garamond', serif;">
                Trip packages coming soon.
            </p>
        </div>
        @endif

    </div>
</section>


{{-- ============================================================
     3. DESTINATIONS SECTION
     ============================================================ --}}
<section class="py-24 md:py-32" style="background-color: #0F172A;">
    <div class="section-padding">

        {{-- Section Header --}}
        <div class="mb-16">
            <p class="section-subtitle mb-4" style="color: #D6B98C;">Where to Go</p>
            <h2 class="section-title" style="color: #F8F5F0;">Top Destinations</h2>
        </div>

        @if($featuredDestinations->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($featuredDestinations as $index => $destination)
            @php
                $sizes = ['md:col-span-1 row-span-1', 'md:col-span-1 row-span-1', 'md:col-span-1', 'md:col-span-1'];
                $heights = ['aspect-[4/3]', 'aspect-square', 'aspect-[16/9]', 'aspect-[4/3]'];
            @endphp
            <article class="group relative overflow-hidden cursor-pointer">
                <a href="{{ route('destination.show', $destination->slug) }}" class="block relative {{ $heights[$index] ?? 'aspect-[4/3]' }}">
                    <img
                        src="{{ $destination->image ?: 'https://images.unsplash.com/photo-1555881400-74d7acaacd8b?w=900&q=80' }}"
                        alt="{{ $destination->name }}"
                        class="w-full h-full object-cover transform transition-transform duration-700 group-hover:scale-105"
                        loading="lazy">

                    {{-- Overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0F172A]/80 via-[#0F172A]/20 to-transparent"></div>

                    {{-- Content --}}
                    <div class="absolute bottom-0 left-0 right-0 p-7 transform translate-y-2 group-hover:translate-y-0 transition-transform duration-500">
                        <h3 class="text-[#F8F5F0] text-2xl md:text-3xl font-light mb-2" style="font-family: 'Cormorant Garamond', serif;">
                            {{ $destination->name }}
                        </h3>
                        <p class="text-[#F8F5F0]/70 text-sm leading-relaxed mb-4 opacity-0 group-hover:opacity-100 transition-opacity duration-500 line-clamp-2"
                           style="font-family: 'Inter', sans-serif;">
                            {{ $destination->short_description }}
                        </p>
                        <span class="inline-flex items-center gap-2 text-[#D6B98C] text-xs uppercase tracking-widest opacity-0 group-hover:opacity-100 transition-opacity duration-500"
                              style="font-family: 'Manrope', sans-serif;">
                            Explore
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </span>
                    </div>
                </a>
            </article>
            @endforeach
        </div>
        @else
        <div class="text-center py-20">
            <p class="text-[#F8F5F0]/40 text-lg" style="font-family: 'Cormorant Garamond', serif;">
                Destinations coming soon.
            </p>
        </div>
        @endif

        <div class="text-center mt-12">
            <a href="{{ route('destinations') }}" class="btn-outline" style="border-color: rgba(248,245,240,0.3); color: #F8F5F0;">
                View All Destinations
            </a>
        </div>

    </div>
</section>


{{-- ============================================================
     4. WHY CHOOSE US
     ============================================================ --}}
<section class="py-24 md:py-32 bg-[#F8F5F0]">
    <div class="section-padding">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">

            {{-- Left: Image collage --}}
            <div class="relative">
                <div class="aspect-[3/4] overflow-hidden">
                    <img src="{{ $settings['why_us_image_main'] ?? 'https://images.unsplash.com/photo-1588668214407-6ea9a6d8c272?w=800&q=80' }}"
                         alt="Flores landscape" class="w-full h-full object-cover" loading="lazy">
                </div>
                <div class="absolute -bottom-6 -right-6 w-48 h-48 md:w-64 md:h-64 overflow-hidden border-4 border-[#F8F5F0] hidden md:block">
                    <img src="{{ $settings['why_us_image_small'] ?? 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=400&q=80' }}"
                         alt="Local culture" class="w-full h-full object-cover" loading="lazy">
                </div>
                {{-- Years badge --}}
                <div class="absolute top-8 -left-6 bg-[#D6B98C] p-6 text-center hidden md:block">
                    <span class="block text-4xl font-light text-[#0F172A]" style="font-family: 'Cormorant Garamond', serif;">8+</span>
                    <span class="block text-[10px] uppercase tracking-[0.2em] text-[#0F172A]/70 mt-1" style="font-family: 'Manrope', sans-serif;">Years</span>
                </div>
            </div>

            {{-- Right: Content --}}
            <div class="lg:pl-10">
                <p class="section-subtitle mb-4">Why Travel With Us</p>
                <h2 class="section-title mb-8">Crafted by Locals,<br>
                    <em style="font-style: italic;">for the Curious.</em>
                </h2>
                <p class="text-[#0F172A]/60 text-base leading-relaxed mb-12" style="font-family: 'Inter', sans-serif;">
                    We are not travel agents behind a desk. We are people who grew up watching the sun rise over Kelimutu and diving the reefs of Komodo. Every trip we craft carries that intimacy.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                    @php
                        $reasons = [
                            ['icon' => 'M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7', 'title' => 'Deep Local Knowledge', 'desc' => 'Born and raised in Flores — we know every hidden trail, village, and secret view.'],
                            ['icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z', 'title' => 'Authentic Experiences', 'desc' => 'No tourist traps. Real villages, real food, real stories from real people.'],
                            ['icon' => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z', 'title' => '8+ Years Experience', 'desc' => 'Over a decade guiding travelers safely through Flores\' most remarkable landscapes.'],
                            ['icon' => 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'title' => 'Responsible Travel', 'desc' => 'We partner with local communities and protect the natural environment of Flores.'],
                        ];
                    @endphp

                    @foreach($reasons as $reason)
                    <div class="flex gap-4">
                        <div class="w-10 h-10 flex-shrink-0 flex items-center justify-center bg-[#D6B98C]/20 rounded-sm">
                            <svg class="w-5 h-5 text-[#D6B98C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $reason['icon'] }}"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-[#0F172A] text-base font-medium mb-1.5" style="font-family: 'Manrope', sans-serif;">{{ $reason['title'] }}</h4>
                            <p class="text-[#0F172A]/55 text-sm leading-relaxed" style="font-family: 'Inter', sans-serif;">{{ $reason['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</section>


{{-- ============================================================
     5. TESTIMONIALS
     ============================================================ --}}
@if($featuredTestimonials->isNotEmpty())
<section class="py-24 md:py-32" style="background-color: #1E3A5F;">
    <div class="section-padding">

        <div class="text-center mb-16">
            <p class="section-subtitle mb-4" style="color: #D6B98C;">Traveler Stories</p>
            <h2 class="section-title" style="color: #F8F5F0; font-family: 'Cormorant Garamond', serif;">
                Words from Those Who Explored
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($featuredTestimonials->take(3) as $testimonial)
            <div class="bg-[#F8F5F0]/5 backdrop-blur-sm border border-[#F8F5F0]/10 p-8 flex flex-col gap-5">
                {{-- Stars --}}
                <div class="flex gap-1">
                    @for($i = 1; $i <= 5; $i++)
                        <span class="text-lg {{ $i <= $testimonial->rating ? 'text-[#D6B98C]' : 'text-[#F8F5F0]/20' }}">★</span>
                    @endfor
                </div>

                {{-- Quote --}}
                <blockquote class="text-[#F8F5F0]/80 text-base leading-relaxed flex-1 italic"
                            style="font-family: 'Cormorant Garamond', serif; font-size: 1.1rem;">
                    "{{ $testimonial->content }}"
                </blockquote>

                {{-- Author --}}
                <div class="flex items-center gap-3 pt-4 border-t border-[#F8F5F0]/10">
                    <div class="w-9 h-9 rounded-full flex-shrink-0 flex items-center justify-center text-[#0F172A] text-sm font-bold"
                         style="background-color: #D6B98C; font-family: 'Manrope', sans-serif;">
                        {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-[#F8F5F0] text-sm font-medium" style="font-family: 'Manrope', sans-serif;">{{ $testimonial->name }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('testimonials') }}" class="btn-outline" style="border-color: rgba(248,245,240,0.3); color: #F8F5F0;">
                Read All Stories
            </a>
        </div>

    </div>
</section>
@endif


{{-- ============================================================
     6. GALLERY PREVIEW
     ============================================================ --}}
@if($featuredGallery->isNotEmpty())
<section class="py-24 md:py-32 bg-[#F8F5F0]">
    <div class="section-padding">

        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
            <div>
                <p class="section-subtitle mb-4">From the Field</p>
                <h2 class="section-title">Through Our Lens</h2>
            </div>
            <a href="{{ route('gallery') }}" class="btn-outline self-start md:self-auto">
                Full Gallery
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>

        {{-- Masonry-like grid --}}
        <div class="columns-2 md:columns-3 gap-4 space-y-0" x-data>
            @foreach($featuredGallery as $index => $item)
            <div class="break-inside-avoid mb-4 overflow-hidden group cursor-pointer">
                <img
                    src="{{ $item->image ?: 'https://images.unsplash.com/photo-1501854140801-50d01698950b?w=600&q=80' }}"
                    alt="Flores gallery"
                    class="w-full object-cover transform transition-transform duration-700 group-hover:scale-105"
                    loading="lazy">
            </div>
            @endforeach
        </div>

    </div>
</section>
@endif


{{-- ============================================================
     7. CTA SECTION
     ============================================================ --}}
<section class="relative py-36 md:py-52 overflow-hidden">
    @php $ctaImage = $settings['cta_image'] ?? ''; @endphp
    <div class="absolute inset-0">
        <img
            src="{{ $ctaImage ?: 'https://images.unsplash.com/photo-1502082553048-f009c37129b9?w=1920&q=85' }}"
            alt="Flores island"
            class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-[#0F172A]/70"></div>
    </div>

    <div class="relative z-10 section-padding text-center">
        <p class="text-[#D6B98C] text-xs uppercase tracking-[0.4em] mb-6" style="font-family: 'Manrope', sans-serif;">Begin Your Journey</p>
        <h2 class="text-[#F8F5F0] font-light leading-tight mb-6" style="font-family: 'Cormorant Garamond', serif; font-size: clamp(2.5rem, 5vw, 4.5rem);">
            Ready to Discover<br>the Real Flores?
        </h2>
        <p class="text-[#F8F5F0]/70 text-base mb-12 max-w-lg mx-auto" style="font-family: 'Inter', sans-serif;">
            Let us plan your perfect island journey. Every detail handled with care, every experience crafted to last a lifetime.
        </p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('contact') }}" class="btn-sand">
                Plan My Trip
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
            <a href="{{ route('trips') }}" class="btn-outline" style="border-color: rgba(248,245,240,0.4); color: #F8F5F0;">
                Browse Packages
            </a>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    function heroSection() {
        return {
            init() {
                this.$nextTick(() => {
                    if (typeof gsap !== 'undefined') {
                        const tl = gsap.timeline({ delay: 0.8 });
                        tl.to('#hero-bg',    { scale: 1, duration: 2.5, ease: 'power2.out' })
                          .to('#hero-label', { opacity: 1, y: 0, duration: 0.8, ease: 'power2.out' }, '-=2')
                          .to('#hero-title', { opacity: 1, y: 0, duration: 1.2, ease: 'power2.out' }, '-=1.6')
                          .to('#hero-sub',   { opacity: 1, y: 0, duration: 0.9, ease: 'power2.out' }, '-=0.9')
                          .to('#hero-cta',   { opacity: 1, y: 0, duration: 0.8, ease: 'power2.out' }, '-=0.7')
                          .to('#hero-scroll',{ opacity: 0.6, duration: 0.6, ease: 'power2.out' }, '-=0.4');

                        gsap.set(['#hero-label','#hero-title','#hero-sub','#hero-cta'], { y: 30 });
                        gsap.set('#hero-bg', { scale: 1.08 });
                        gsap.set('#hero-scroll', { opacity: 0 });
                    }
                });
            }
        }
    }
</script>
@endpush

@extends('layouts.app')

@section('title', 'Gallery — PT. Flores Vacation Tour')
@section('meta_description', 'A cinematic gallery of Flores Island — landscapes, culture, sunsets, and ocean from our journeys across the archipelago.')

@section('content')

{{-- Hero --}}
<section class="relative h-[60vh] min-h-[440px] flex items-end overflow-hidden">
    <div class="absolute inset-0">
        <img
            src="https://images.unsplash.com/photo-1518259102261-b40117eabbc9?w=1920&q=85"
            alt="Flores Gallery"
            class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-[#0F172A] via-[#0F172A]/30 to-[#0F172A]/10"></div>
    </div>

    <div class="relative z-10 section-padding pb-16 md:pb-24">
        <p class="text-[#D6B98C] text-xs uppercase tracking-[0.4em] mb-4" style="font-family: 'Manrope', sans-serif;">From the Field</p>
        <h1 class="text-[#F8F5F0] font-light leading-tight" style="font-family: 'Cormorant Garamond', serif; font-size: clamp(2.5rem, 5vw, 4rem);">
            Through Our Lens.
        </h1>
    </div>
</section>


{{-- Gallery Masonry --}}
<section class="py-24 md:py-32 bg-[#F8F5F0]"
         x-data="{
             lightbox: false,
             activeImage: null,
             activeIndex: 0,
             images: {{ $gallery->map(fn($g) => ['src' => $g->image ?: 'https://images.unsplash.com/photo-1501854140801-50d01698950b?w=1200&q=80'])->toJson() }},
             openLightbox(index) {
                 this.activeIndex = index;
                 this.activeImage = this.images[index].src;
                 this.lightbox = true;
             },
             prev() {
                 this.activeIndex = (this.activeIndex - 1 + this.images.length) % this.images.length;
                 this.activeImage = this.images[this.activeIndex].src;
             },
             next() {
                 this.activeIndex = (this.activeIndex + 1) % this.images.length;
                 this.activeImage = this.images[this.activeIndex].src;
             }
         }"
         @keydown.escape.window="lightbox = false"
         @keydown.arrow-left.window="if(lightbox) prev()"
         @keydown.arrow-right.window="if(lightbox) next()">

    <div class="section-padding">

        <div class="mb-16">
            <p class="section-subtitle mb-4">Flores in Frames</p>
            <h2 class="section-title">A Visual Journey</h2>
        </div>

        @if($gallery->isNotEmpty())
        {{-- Masonry Grid --}}
        <div class="columns-2 md:columns-3 lg:columns-4 gap-4">
            @foreach($gallery as $index => $item)
            <div class="break-inside-avoid mb-4 overflow-hidden group cursor-pointer relative"
                 @click="openLightbox({{ $index }})">
                <img
                    src="{{ $item->image ?: 'https://images.unsplash.com/photo-1501854140801-50d01698950b?w=600&q=80' }}"
                    alt="Flores gallery {{ $index + 1 }}"
                    class="w-full object-cover transform transition-transform duration-700 group-hover:scale-105"
                    loading="lazy">
                <div class="absolute inset-0 bg-[#0F172A]/0 group-hover:bg-[#0F172A]/40 transition-colors duration-500 flex items-center justify-center">
                    <svg class="w-8 h-8 text-[#F8F5F0] opacity-0 group-hover:opacity-100 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                    </svg>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-32">
            <p class="text-[#0F172A]/30 text-2xl" style="font-family: 'Cormorant Garamond', serif;">
                Gallery coming soon.
            </p>
        </div>
        @endif

    </div>

    {{-- Lightbox --}}
    <div x-show="lightbox"
         x-transition:enter="transition-opacity duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-[100] bg-[#0F172A]/95 flex items-center justify-center p-4"
         style="display: none;"
         @click.self="lightbox = false">

        {{-- Close --}}
        <button @click="lightbox = false"
                class="absolute top-6 right-6 w-10 h-10 flex items-center justify-center text-[#F8F5F0] hover:text-[#D6B98C] transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        {{-- Prev --}}
        <button @click="prev()"
                class="absolute left-4 md:left-8 w-12 h-12 flex items-center justify-center border border-[#F8F5F0]/20 text-[#F8F5F0] hover:border-[#D6B98C] hover:text-[#D6B98C] transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"/>
            </svg>
        </button>

        {{-- Image --}}
        <div class="max-w-5xl max-h-[85vh] flex items-center justify-center">
            <img :src="activeImage" alt="Gallery" class="max-w-full max-h-[85vh] object-contain">
        </div>

        {{-- Next --}}
        <button @click="next()"
                class="absolute right-4 md:right-8 w-12 h-12 flex items-center justify-center border border-[#F8F5F0]/20 text-[#F8F5F0] hover:border-[#D6B98C] hover:text-[#D6B98C] transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"/>
            </svg>
        </button>

        {{-- Counter --}}
        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 text-[#F8F5F0]/50 text-xs" style="font-family: 'Manrope', sans-serif;">
            <span x-text="activeIndex + 1"></span> / <span x-text="images.length"></span>
        </div>
    </div>

</section>

@endsection

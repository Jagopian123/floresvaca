@extends('layouts.app')

@section('title', 'Traveler Stories — PT. Flores Vacation Tour')
@section('meta_description', 'Read authentic testimonials from travelers who have experienced Flores with PT. Flores Vacation Tour.')

@section('content')

{{-- Hero --}}
<section class="relative h-[60vh] min-h-[440px] flex items-end overflow-hidden">
    <div class="absolute inset-0">
        <img
            src="{{ $settings['page_testimonials_image'] ?? 'https://images.unsplash.com/photo-1530789253388-582c481c54b0?w=1920&q=85' }}"
            alt="Traveler Stories"
            class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-[#0F172A] via-[#0F172A]/40 to-[#0F172A]/10"></div>
    </div>

    <div class="relative z-10 section-padding pb-16 md:pb-24">
        <p class="text-[#D6B98C] text-xs uppercase tracking-[0.4em] mb-4" style="font-family: 'Manrope', sans-serif;">Real Voices</p>
        <h1 class="text-[#F8F5F0] font-light leading-tight" style="font-family: 'Cormorant Garamond', serif; font-size: clamp(2.5rem, 5vw, 4rem);">
            Stories from Those<br>Who Explored.
        </h1>
    </div>
</section>


{{-- All Testimonials --}}
<section class="py-24 md:py-32 bg-[#F8F5F0]">
    <div class="section-padding">

        @if($testimonials->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($testimonials as $testimonial)
            <div class="bg-white p-8 flex flex-col gap-6 shadow-sm hover:shadow-md transition-shadow duration-300">
                {{-- Stars --}}
                <div class="flex gap-1">
                    @for($i = 1; $i <= 5; $i++)
                        <span class="text-xl {{ $i <= $testimonial->rating ? 'text-[#D6B98C]' : 'text-gray-200' }}">★</span>
                    @endfor
                </div>

                {{-- Quote --}}
                <div class="relative flex-1">
                    <svg class="w-8 h-8 text-[#D6B98C]/20 mb-3" fill="currentColor" viewBox="0 0 32 32">
                        <path d="M10 8C6.686 8 4 10.686 4 14v10h10V14H7c0-1.654 1.346-3 3-3V8zm18 0c-3.314 0-6 2.686-6 6v10h10V14h-7c0-1.654 1.346-3 3-3V8z"/>
                    </svg>
                    <blockquote class="text-[#0F172A]/70 leading-relaxed italic"
                                style="font-family: 'Cormorant Garamond', serif; font-size: 1.125rem;">
                        "{{ $testimonial->content }}"
                    </blockquote>
                </div>

                {{-- Author --}}
                <div class="flex items-center gap-3 pt-5 border-t border-[#0F172A]/8">
                    <div class="w-10 h-10 rounded-full flex-shrink-0 flex items-center justify-center text-[#0F172A] text-sm font-bold"
                         style="background-color: #D6B98C; font-family: 'Manrope', sans-serif;">
                        {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-[#0F172A] text-sm font-semibold" style="font-family: 'Manrope', sans-serif;">{{ $testimonial->name }}</p>
                        <p class="text-[#0F172A]/40 text-xs" style="font-family: 'Inter', sans-serif;">{{ $testimonial->created_at->format('M Y') }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-32">
            <p class="text-[#0F172A]/30 text-2xl" style="font-family: 'Cormorant Garamond', serif;">
                Be the first to share your story.
            </p>
        </div>
        @endif

    </div>
</section>


{{-- Submit Review Form --}}
<section class="py-24 md:py-32" style="background-color: #0F172A;">
    <div class="section-padding">
        <div class="max-w-2xl mx-auto">

            <div class="text-center mb-16">
                <p class="section-subtitle mb-4" style="color: #D6B98C;">Share Your Experience</p>
                <h2 class="section-title" style="color: #F8F5F0;">Tell Your Flores Story</h2>
            </div>

            @if(session('success'))
            <div class="bg-[#2D5A4A]/30 border border-[#2D5A4A] text-[#F8F5F0] p-6 mb-10 text-center" style="font-family: 'Manrope', sans-serif;">
                <svg class="w-6 h-6 text-[#D6B98C] mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p>Thank you! Your review has been submitted and is awaiting approval.</p>
            </div>
            @endif

            <form method="POST" action="{{ route('testimonials.submit') }}"
                  x-data="{
                      rating: 0,
                      hoverRating: 0,
                      setRating(r) { this.rating = r; }
                  }">
                @csrf

                {{-- Name --}}
                <div class="mb-7">
                    <label class="block text-[#F8F5F0]/60 text-xs uppercase tracking-[0.2em] mb-3" for="name"
                           style="font-family: 'Manrope', sans-serif;">Your Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                           class="w-full bg-[#F8F5F0]/5 border border-[#F8F5F0]/15 text-[#F8F5F0] px-5 py-4 text-sm focus:outline-none focus:border-[#D6B98C] transition-colors duration-300 placeholder-[#F8F5F0]/25"
                           style="font-family: 'Inter', sans-serif;"
                           placeholder="Your full name">
                    @error('name')
                        <p class="text-red-400 text-xs mt-2" style="font-family: 'Inter', sans-serif;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Star Rating --}}
                <div class="mb-7">
                    <label class="block text-[#F8F5F0]/60 text-xs uppercase tracking-[0.2em] mb-3"
                           style="font-family: 'Manrope', sans-serif;">Your Rating</label>
                    <input type="hidden" name="rating" :value="rating">
                    <div class="flex gap-2">
                        @for($i = 1; $i <= 5; $i++)
                        <button type="button"
                                @click="setRating({{ $i }})"
                                @mouseenter="hoverRating = {{ $i }}"
                                @mouseleave="hoverRating = 0"
                                :class="(hoverRating >= {{ $i }} || rating >= {{ $i }}) ? 'text-[#D6B98C]' : 'text-[#F8F5F0]/20'"
                                class="text-4xl transition-colors duration-150 cursor-pointer focus:outline-none">
                            ★
                        </button>
                        @endfor
                    </div>
                    @error('rating')
                        <p class="text-red-400 text-xs mt-2" style="font-family: 'Inter', sans-serif;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Review --}}
                <div class="mb-10">
                    <label class="block text-[#F8F5F0]/60 text-xs uppercase tracking-[0.2em] mb-3" for="content"
                           style="font-family: 'Manrope', sans-serif;">Your Review</label>
                    <textarea id="content" name="content" rows="6" required minlength="10"
                              class="w-full bg-[#F8F5F0]/5 border border-[#F8F5F0]/15 text-[#F8F5F0] px-5 py-4 text-sm focus:outline-none focus:border-[#D6B98C] transition-colors duration-300 resize-none placeholder-[#F8F5F0]/25"
                              style="font-family: 'Inter', sans-serif;"
                              placeholder="Tell us about your experience in Flores...">{{ old('content') }}</textarea>
                    @error('content')
                        <p class="text-red-400 text-xs mt-2" style="font-family: 'Inter', sans-serif;">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                        :disabled="rating === 0"
                        :class="rating === 0 ? 'opacity-50 cursor-not-allowed' : 'hover:bg-[#1E3A5F]'"
                        class="btn-primary w-full justify-center py-5">
                    Submit My Review
                </button>
            </form>
        </div>
    </div>
</section>

@endsection

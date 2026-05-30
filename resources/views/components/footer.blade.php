@php
    $wa      = \App\Models\Setting::get('contact_wa', '6281239523657');
    $email   = \App\Models\Setting::get('contact_email', 'hello@floresvacationtour.com');
    $phone   = \App\Models\Setting::get('contact_phone', '+62 812-3952-3657');
    $address = \App\Models\Setting::get('contact_address', 'Labuan Bajo, Manggarai Barat, Flores, NTT');
    $ig      = \App\Models\Setting::get('social_instagram', 'floresvacationtour');
    $fb      = \App\Models\Setting::get('social_facebook', 'floresvacationtour');
    $logoUrl = \App\Models\Setting::get('general_logo', '');
@endphp

<footer style="background-color: #0F172A;" class="text-[#F8F5F0]">

    {{-- Main Footer --}}
    <div class="section-padding pt-20 pb-14">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-14">

            {{-- Brand Column --}}
            <div class="lg:col-span-1">
                <a href="{{ route('home') }}" class="flex items-center gap-3 mb-6">
                    <img src="{{ asset('images/logo-floresvaca.png') }}"
                         alt="PT. Flores Vacation Tour"
                         class="h-12 w-12 object-contain">
                    <div class="flex flex-col leading-tight">
                        <p class="text-[#D6B98C] text-lg font-medium leading-none"
                           style="font-family: 'Cormorant Garamond', serif;">PT. Flores Vacation</p>
                        <p class="text-[#F8F5F0]/60 text-[10px] uppercase tracking-[0.25em] mt-0.5"
                           style="font-family: 'Manrope', sans-serif;">Tour</p>
                    </div>
                </a>
                <p class="text-[#F8F5F0]/60 text-sm leading-relaxed mb-8" style="font-family: 'Inter', sans-serif;">
                    Authentic island experiences crafted by people who were born and raised in the heart of Flores.
                </p>
                {{-- Trust Badges --}}
                <div class="flex items-center gap-4 mb-6">
                    <img src="{{ asset('images/asita.jpeg') }}"
                         alt="ASITA Member"
                         class="h-12 w-auto object-contain opacity-80 hover:opacity-100 transition-opacity"
                         title="Association of the Indonesian Tours & Travel Agencies">
                    <img src="{{ asset('images/bcawise.webp') }}"
                         alt="BCA Wise"
                         class="h-10 w-auto object-contain opacity-80 hover:opacity-100 transition-opacity"
                         title="BCA Wise">
                </div>

                {{-- Social --}}
                <div class="flex items-center gap-4">
                    @if($ig)
                        <a href="https://instagram.com/{{ $ig }}" target="_blank" rel="noopener"
                           class="w-9 h-9 rounded-full border border-[#F8F5F0]/20 flex items-center justify-center hover:border-[#D6B98C] hover:text-[#D6B98C] transition-colors duration-300">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                    @endif
                    @if($fb)
                        <a href="https://facebook.com/{{ $fb }}" target="_blank" rel="noopener"
                           class="w-9 h-9 rounded-full border border-[#F8F5F0]/20 flex items-center justify-center hover:border-[#D6B98C] hover:text-[#D6B98C] transition-colors duration-300">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                    @endif
                    <a href="https://wa.me/{{ $wa }}" target="_blank" rel="noopener"
                       class="w-9 h-9 rounded-full border border-[#F8F5F0]/20 flex items-center justify-center hover:border-[#D6B98C] hover:text-[#D6B98C] transition-colors duration-300">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Explore Column --}}
            <div>
                <h4 class="text-[#D6B98C] text-xs uppercase tracking-[0.3em] mb-7" style="font-family: 'Manrope', sans-serif;">Explore</h4>
                <ul class="space-y-4">
                    @foreach([
                        ['Home',         route('home')],
                        ['About Us',     route('about')],
                        ['Destinations', route('destinations')],
                        ['Our Trips',    route('trips')],
                    ] as [$label, $href])
                        <li>
                            <a href="{{ $href }}"
                               class="text-[#F8F5F0]/60 text-sm hover:text-[#D6B98C] transition-colors duration-300"
                               style="font-family: 'Inter', sans-serif;">
                                {{ $label }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Info Column --}}
            <div>
                <h4 class="text-[#D6B98C] text-xs uppercase tracking-[0.3em] mb-7" style="font-family: 'Manrope', sans-serif;">Information</h4>
                <ul class="space-y-4">
                    @foreach([
                        ['Testimonials', route('testimonials')],
                        ['Gallery',      route('gallery')],
                        ['Contact Us',   route('contact')],
                    ] as [$label, $href])
                        <li>
                            <a href="{{ $href }}"
                               class="text-[#F8F5F0]/60 text-sm hover:text-[#D6B98C] transition-colors duration-300"
                               style="font-family: 'Inter', sans-serif;">
                                {{ $label }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Contact Column --}}
            <div>
                <h4 class="text-[#D6B98C] text-xs uppercase tracking-[0.3em] mb-7" style="font-family: 'Manrope', sans-serif;">Contact</h4>
                <ul class="space-y-4">
                    <li class="flex items-start gap-3">
                        <svg class="w-4 h-4 text-[#D6B98C] mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <a href="https://wa.me/{{ $wa }}" class="text-[#F8F5F0]/60 text-sm hover:text-[#D6B98C] transition-colors duration-300" style="font-family: 'Inter', sans-serif;">
                            {{ $phone }}
                        </a>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-4 h-4 text-[#D6B98C] mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <a href="mailto:{{ $email }}" class="text-[#F8F5F0]/60 text-sm hover:text-[#D6B98C] transition-colors duration-300 break-all" style="font-family: 'Inter', sans-serif;">
                            {{ $email }}
                        </a>
                    </li>
                    <li class="flex items-start gap-3">
                        <svg class="w-4 h-4 text-[#D6B98C] mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="text-[#F8F5F0]/60 text-sm leading-relaxed" style="font-family: 'Inter', sans-serif;">{{ $address }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Copyright Bar --}}
    <div class="border-t border-[#F8F5F0]/10 section-padding py-6">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-[#F8F5F0]/40 text-xs" style="font-family: 'Inter', sans-serif;">
                &copy; {{ date('Y') }} PT. Flores Vacation Tour. All rights reserved.
            </p>
            <p class="text-[#F8F5F0]/30 text-xs" style="font-family: 'Inter', sans-serif;">
                Crafted with love from Flores, Indonesia.
            </p>
        </div>
    </div>
</footer>

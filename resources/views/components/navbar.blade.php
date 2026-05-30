<header
    x-data="{ scrolled: false, open: false }"
    @scroll.window="scrolled = window.scrollY > 60"
    :class="scrolled || open ? 'bg-[#0F172A]/95 backdrop-blur-md shadow-lg' : 'bg-transparent'"
    class="fixed top-0 inset-x-0 z-50 transition-all duration-500">

    <div class="section-padding">
        <div class="flex items-center justify-between h-20">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 group shrink-0">
                <img src="{{ asset('images/logo-floresvaca.png') }}"
                     alt="PT. Flores Vacation Tour"
                     class="h-10 w-10 object-contain">
                <div class="flex flex-col leading-tight">
                    <span class="text-[#D6B98C] text-base font-medium leading-none tracking-wide"
                          style="font-family: 'Cormorant Garamond', serif;">PT. Flores Vacation</span>
                    <span class="text-[#F8F5F0]/80 text-[10px] uppercase tracking-[0.25em] mt-0.5"
                          style="font-family: 'Manrope', sans-serif;">Tour</span>
                </div>
            </a>

            {{-- Desktop Navigation --}}
            <nav class="hidden lg:flex items-center gap-8">
                @php
                    $navLinks = [
                        ['label' => 'Home',         'route' => 'home'],
                        ['label' => 'About',        'route' => 'about'],
                        ['label' => 'Destinations', 'route' => 'destinations'],
                        ['label' => 'Trips',        'route' => 'trips'],
                        ['label' => 'Testimonials', 'route' => 'testimonials'],
                        ['label' => 'Gallery',      'route' => 'gallery'],
                        ['label' => 'Contact',      'route' => 'contact'],
                    ];
                @endphp

                @foreach($navLinks as $link)
                    <a href="{{ route($link['route']) }}"
                       class="text-xs uppercase tracking-[0.2em] transition-colors duration-300 relative group
                              {{ request()->routeIs($link['route']) ? 'text-[#D6B98C]' : 'text-[#F8F5F0]/80 hover:text-[#D6B98C]' }}"
                       style="font-family: 'Manrope', sans-serif;">
                        {{ $link['label'] }}
                        <span class="absolute -bottom-1 left-0 w-0 h-px bg-[#D6B98C] transition-all duration-300 group-hover:w-full
                                     {{ request()->routeIs($link['route']) ? 'w-full' : '' }}"></span>
                    </a>
                @endforeach
            </nav>

            {{-- CTA + Mobile Toggle --}}
            <div class="flex items-center gap-4">
                <a href="{{ route('contact') }}" class="hidden lg:inline-flex btn-sand text-xs">
                    Book Now
                </a>

                {{-- Mobile Hamburger --}}
                <button @click="open = !open"
                        class="lg:hidden w-10 h-10 flex flex-col items-center justify-center gap-1.5 focus:outline-none"
                        aria-label="Toggle menu">
                    <span :class="open ? 'rotate-45 translate-y-2' : ''"
                          class="block w-6 h-px bg-[#F8F5F0] transition-all duration-300"></span>
                    <span :class="open ? 'opacity-0' : ''"
                          class="block w-6 h-px bg-[#F8F5F0] transition-all duration-300"></span>
                    <span :class="open ? '-rotate-45 -translate-y-2' : ''"
                          class="block w-6 h-px bg-[#F8F5F0] transition-all duration-300"></span>
                </button>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div x-show="open"
             x-transition:enter="transition-all duration-300"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition-all duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4"
             class="lg:hidden border-t border-[#F8F5F0]/10 py-6"
             style="display: none;">
            <nav class="flex flex-col gap-5">
                @foreach($navLinks as $link)
                    <a href="{{ route($link['route']) }}"
                       @click="open = false"
                       class="text-xs uppercase tracking-[0.2em] transition-colors duration-300
                              {{ request()->routeIs($link['route']) ? 'text-[#D6B98C]' : 'text-[#F8F5F0]/80 hover:text-[#D6B98C]' }}"
                       style="font-family: 'Manrope', sans-serif;">
                        {{ $link['label'] }}
                    </a>
                @endforeach
                <a href="{{ route('contact') }}" class="btn-sand mt-2 self-start text-xs">
                    Book Now
                </a>
            </nav>
        </div>
    </div>
</header>

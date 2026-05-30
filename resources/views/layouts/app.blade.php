<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'PT. Flores Vacation Tour — Discover the Real Flores')</title>
    <meta name="description" content="@yield('meta_description', 'Premium cinematic travel experiences across Flores Island, Indonesia. Phinisi cruises, overland adventures, and authentic cultural journeys.')">

    {{-- Google Fonts (non-blocking) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" as="style"
          href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500&family=Playfair+Display:ital,wght@0,400;0,500;1,400&family=Inter:wght@300;400;500;600&family=Manrope:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" media="print" onload="this.media='all'"
          href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500&family=Playfair+Display:ital,wght@0,400;0,500;1,400&family=Inter:wght@300;400;500;600&family=Manrope:wght@300;400;500;600;700&display=swap">
    <noscript>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500&family=Playfair+Display:ital,wght@0,400;0,500;1,400&family=Inter:wght@300;400;500;600&family=Manrope:wght@300;400;500;600;700&display=swap">
    </noscript>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('head')
</head>
<body class="antialiased bg-[#F8F5F0]" x-data="{ pageLoaded: false }" x-init="setTimeout(() => pageLoaded = true, 100)">

    {{-- Page transition overlay --}}
    <div x-show="!pageLoaded"
         x-transition:leave="transition-opacity duration-700"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-[9999] bg-[#0F172A] flex items-center justify-center"
         style="display: flex;">
        <div class="text-center">
            <p class="text-[#D6B98C] uppercase tracking-[0.4em] text-xs" style="font-family: 'Manrope', sans-serif;">Flores Vacation Tour</p>
        </div>
    </div>

    @include('components.navbar')

    <main>
        @yield('content')
    </main>

    @include('components.footer')

    @include('components.floating-whatsapp')

    @stack('scripts')
</body>
</html>

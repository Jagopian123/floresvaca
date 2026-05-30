@extends('layouts.app')

@section('title', 'Contact Us — PT. Flores Vacation Tour')
@section('meta_description', 'Get in touch with PT. Flores Vacation Tour. We\'ll help you plan your perfect Flores Island adventure.')

@section('content')

@php
    $wa      = \App\Models\Setting::get('contact_wa', '6281239523657');
    $email   = \App\Models\Setting::get('contact_email', 'hello@floresvacationtour.com');
    $phone   = \App\Models\Setting::get('contact_phone', '+62 812-3952-3657');
    $address = \App\Models\Setting::get('contact_address', 'Labuan Bajo, Manggarai Barat, Flores, NTT');
@endphp

{{-- Hero --}}
<section class="relative h-[60vh] min-h-[440px] flex items-end overflow-hidden">
    <div class="absolute inset-0">
        <img
            src="https://images.unsplash.com/photo-1518258722448-92a6a381b5d1?w=1920&q=85"
            alt="Contact us"
            class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-[#0F172A] via-[#0F172A]/40 to-[#0F172A]/10"></div>
    </div>

    <div class="relative z-10 section-padding pb-16 md:pb-24">
        <p class="text-[#D6B98C] text-xs uppercase tracking-[0.4em] mb-4" style="font-family: 'Manrope', sans-serif;">Let's Connect</p>
        <h1 class="text-[#F8F5F0] font-light leading-tight" style="font-family: 'Cormorant Garamond', serif; font-size: clamp(2.5rem, 5vw, 4rem);">
            We'd Love to Hear<br>from You.
        </h1>
    </div>
</section>


{{-- Contact Content --}}
<section class="py-24 md:py-32 bg-[#F8F5F0]">
    <div class="section-padding">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-20">

            {{-- Contact Form (3/5) --}}
            <div class="lg:col-span-3"
                 x-data="{
                     name: '',
                     email: '',
                     phone: '',
                     date: '',
                     pax: '',
                     tripInterest: '',
                     message: '',
                     submitToWA() {
                         if (!this.name || !this.phone) return;
                         const wa = '{{ $wa }}';
                         const text = 'Hello PT. Flores Vacation Tour! 👋\n\nI\'m interested in booking a trip to Flores:\n\n' +
                             '*Name:* ' + this.name + '\n' +
                             '*Email:* ' + (this.email || '-') + '\n' +
                             '*Phone:* ' + this.phone + '\n' +
                             (this.tripInterest ? '*Trip Interest:* ' + this.tripInterest + '\n' : '') +
                             (this.date ? '*Travel Date:* ' + this.date + '\n' : '') +
                             (this.pax ? '*Number of People:* ' + this.pax + ' pax\n' : '') +
                             (this.message ? '\n*Additional Notes:*\n' + this.message : '') +
                             '\n\nLooking forward to hearing from you!';
                         window.open('https://wa.me/' + wa + '?text=' + encodeURIComponent(text), '_blank');
                     }
                 }">

                <p class="section-subtitle mb-6">Send Us a Message</p>
                <h2 class="section-title mb-12">Plan Your<br>Dream Trip.</h2>

                <form @submit.prevent="submitToWA()" class="space-y-7">

                    {{-- Name & Email --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[#0F172A]/60 text-xs uppercase tracking-[0.2em] mb-3"
                                   style="font-family: 'Manrope', sans-serif;">Full Name *</label>
                            <input type="text" x-model="name" required
                                   class="w-full border border-[#0F172A]/15 bg-white text-[#0F172A] px-5 py-4 text-sm focus:outline-none focus:border-[#0F172A] transition-colors duration-300 placeholder-[#0F172A]/25"
                                   style="font-family: 'Inter', sans-serif;"
                                   placeholder="Your full name">
                        </div>
                        <div>
                            <label class="block text-[#0F172A]/60 text-xs uppercase tracking-[0.2em] mb-3"
                                   style="font-family: 'Manrope', sans-serif;">Email</label>
                            <input type="email" x-model="email"
                                   class="w-full border border-[#0F172A]/15 bg-white text-[#0F172A] px-5 py-4 text-sm focus:outline-none focus:border-[#0F172A] transition-colors duration-300 placeholder-[#0F172A]/25"
                                   style="font-family: 'Inter', sans-serif;"
                                   placeholder="your@email.com">
                        </div>
                    </div>

                    {{-- Phone & Trip Interest --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[#0F172A]/60 text-xs uppercase tracking-[0.2em] mb-3"
                                   style="font-family: 'Manrope', sans-serif;">WhatsApp / Phone *</label>
                            <input type="tel" x-model="phone" required
                                   class="w-full border border-[#0F172A]/15 bg-white text-[#0F172A] px-5 py-4 text-sm focus:outline-none focus:border-[#0F172A] transition-colors duration-300 placeholder-[#0F172A]/25"
                                   style="font-family: 'Inter', sans-serif;"
                                   placeholder="+62 xxx-xxxx-xxxx">
                        </div>
                        <div>
                            <label class="block text-[#0F172A]/60 text-xs uppercase tracking-[0.2em] mb-3"
                                   style="font-family: 'Manrope', sans-serif;">Trip Interest</label>
                            <select x-model="tripInterest"
                                    class="w-full border border-[#0F172A]/15 bg-white text-[#0F172A] px-5 py-4 text-sm focus:outline-none focus:border-[#0F172A] transition-colors duration-300 appearance-none"
                                    style="font-family: 'Inter', sans-serif;">
                                <option value="">Select a trip type</option>
                                <option value="Phinisi Ship">Phinisi Ship Cruise</option>
                                <option value="Overland">Overland Adventure</option>
                                <option value="Day Trip">Day Trip</option>
                                <option value="Custom">Custom Package</option>
                            </select>
                        </div>
                    </div>

                    {{-- Date & Pax --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[#0F172A]/60 text-xs uppercase tracking-[0.2em] mb-3"
                                   style="font-family: 'Manrope', sans-serif;">Estimated Travel Date</label>
                            <input type="date" x-model="date"
                                   class="w-full border border-[#0F172A]/15 bg-white text-[#0F172A] px-5 py-4 text-sm focus:outline-none focus:border-[#0F172A] transition-colors duration-300"
                                   style="font-family: 'Inter', sans-serif;">
                        </div>
                        <div>
                            <label class="block text-[#0F172A]/60 text-xs uppercase tracking-[0.2em] mb-3"
                                   style="font-family: 'Manrope', sans-serif;">Number of People</label>
                            <input type="number" x-model="pax" min="1" max="50"
                                   class="w-full border border-[#0F172A]/15 bg-white text-[#0F172A] px-5 py-4 text-sm focus:outline-none focus:border-[#0F172A] transition-colors duration-300 placeholder-[#0F172A]/25"
                                   style="font-family: 'Inter', sans-serif;"
                                   placeholder="e.g. 4">
                        </div>
                    </div>

                    {{-- Message --}}
                    <div>
                        <label class="block text-[#0F172A]/60 text-xs uppercase tracking-[0.2em] mb-3"
                               style="font-family: 'Manrope', sans-serif;">Your Message</label>
                        <textarea x-model="message" rows="5"
                                  class="w-full border border-[#0F172A]/15 bg-white text-[#0F172A] px-5 py-4 text-sm focus:outline-none focus:border-[#0F172A] transition-colors duration-300 resize-none placeholder-[#0F172A]/25"
                                  style="font-family: 'Inter', sans-serif;"
                                  placeholder="Tell us about your dream Flores experience..."></textarea>
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                            class="flex items-center gap-3 w-full justify-center py-5 text-white text-sm font-semibold transition-all duration-300 hover:opacity-90"
                            style="background-color: #25D366; font-family: 'Manrope', sans-serif;">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        Send via WhatsApp
                    </button>

                    <p class="text-[#0F172A]/40 text-xs text-center" style="font-family: 'Inter', sans-serif;">
                        This will open WhatsApp with your message pre-filled. We'll respond within a few hours.
                    </p>

                </form>
            </div>

            {{-- Contact Info (2/5) --}}
            <div class="lg:col-span-2">
                <div class="sticky top-28">
                    <p class="section-subtitle mb-8">Reach Us Directly</p>

                    <div class="space-y-8">

                        {{-- WhatsApp --}}
                        <div class="flex gap-5">
                            <div class="w-12 h-12 flex-shrink-0 flex items-center justify-center bg-[#25D366]">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[#0F172A]/50 text-xs uppercase tracking-[0.2em] mb-1.5" style="font-family: 'Manrope', sans-serif;">WhatsApp</p>
                                <a href="https://wa.me/{{ $wa }}" target="_blank" rel="noopener"
                                   class="text-[#0F172A] text-base hover:text-[#1E3A5F] transition-colors"
                                   style="font-family: 'Inter', sans-serif;">
                                    {{ $phone }}
                                </a>
                                <p class="text-[#0F172A]/40 text-xs mt-1" style="font-family: 'Inter', sans-serif;">Available 08.00 – 21.00 WITA</p>
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="flex gap-5">
                            <div class="w-12 h-12 flex-shrink-0 flex items-center justify-center" style="background-color: #1E3A5F;">
                                <svg class="w-5 h-5 text-[#D6B98C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[#0F172A]/50 text-xs uppercase tracking-[0.2em] mb-1.5" style="font-family: 'Manrope', sans-serif;">Email</p>
                                <a href="mailto:{{ $email }}"
                                   class="text-[#0F172A] text-base hover:text-[#1E3A5F] transition-colors break-all"
                                   style="font-family: 'Inter', sans-serif;">
                                    {{ $email }}
                                </a>
                                <p class="text-[#0F172A]/40 text-xs mt-1" style="font-family: 'Inter', sans-serif;">We reply within 24 hours</p>
                            </div>
                        </div>

                        {{-- Address --}}
                        <div class="flex gap-5">
                            <div class="w-12 h-12 flex-shrink-0 flex items-center justify-center" style="background-color: #2D5A4A;">
                                <svg class="w-5 h-5 text-[#D6B98C]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-[#0F172A]/50 text-xs uppercase tracking-[0.2em] mb-1.5" style="font-family: 'Manrope', sans-serif;">Office</p>
                                <p class="text-[#0F172A] text-base leading-relaxed" style="font-family: 'Inter', sans-serif;">{{ $address }}</p>
                            </div>
                        </div>

                    </div>

                    {{-- Separator --}}
                    <div class="border-t border-[#0F172A]/10 my-10"></div>

                    {{-- Quick WA Button --}}
                    <div style="background-color: #0F172A;" class="p-7">
                        <p class="text-[#F8F5F0] text-lg font-light mb-2" style="font-family: 'Cormorant Garamond', serif;">
                            Prefer to chat directly?
                        </p>
                        <p class="text-[#F8F5F0]/50 text-sm mb-6" style="font-family: 'Inter', sans-serif;">
                            Our team is ready to answer all your questions about Flores.
                        </p>
                        <a href="https://wa.me/{{ $wa }}" target="_blank" rel="noopener"
                           class="flex items-center justify-center gap-3 w-full py-4 text-white text-sm font-semibold"
                           style="background-color: #25D366; font-family: 'Manrope', sans-serif;">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                            Open WhatsApp
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection

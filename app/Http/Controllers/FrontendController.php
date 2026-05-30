<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Gallery;
use App\Models\Setting;
use App\Models\Testimonial;
use App\Models\Trip;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FrontendController extends Controller
{
    public function home(): View
    {
        $featuredTrips        = Trip::where('featured', true)->where('is_active', true)->orderBy('sort_order')->take(5)->get();
        $featuredDestinations = Destination::where('featured', true)->orderBy('sort_order')->take(4)->get();
        $featuredTestimonials = Testimonial::where('featured', true)->latest()->take(6)->get();
        $featuredGallery      = Gallery::where('featured', true)->latest()->take(6)->get();
        $settings             = Setting::allKeyed();

        return view('pages.home', compact(
            'featuredTrips',
            'featuredDestinations',
            'featuredTestimonials',
            'featuredGallery',
            'settings',
        ));
    }

    public function about(): View
    {
        $settings = Setting::allKeyed();

        return view('pages.about', compact('settings'));
    }

    public function destinations(): View
    {
        $destinations = Destination::orderBy('sort_order')->get();
        $settings     = Setting::allKeyed();

        return view('pages.destinations', compact('destinations', 'settings'));
    }

    public function destination(string $slug): View
    {
        $destination = Destination::where('slug', $slug)->firstOrFail();
        $destination->load('trips');
        $settings = Setting::allKeyed();

        return view('pages.destination-detail', compact('destination', 'settings'));
    }

    public function trips(): View
    {
        $trips    = Trip::where('is_active', true)->orderBy('sort_order')->get();
        $settings = Setting::allKeyed();

        return view('pages.trips', compact('trips', 'settings'));
    }

    public function trip(string $slug): View
    {
        $trip = Trip::where('slug', $slug)->firstOrFail();
        $trip->load(['itineraries', 'includes', 'excludes', 'thingsToBring']);
        $settings = Setting::allKeyed();

        return view('pages.trip-detail', compact('trip', 'settings'));
    }

    public function testimonials(): View
    {
        $testimonials = Testimonial::latest()->get();
        $settings     = Setting::allKeyed();

        return view('pages.testimonials', compact('testimonials', 'settings'));
    }

    public function gallery(): View
    {
        $gallery  = Gallery::latest()->get();
        $settings = Setting::allKeyed();

        return view('pages.gallery', compact('gallery', 'settings'));
    }

    public function contact(): View
    {
        $settings = Setting::allKeyed();

        return view('pages.contact', compact('settings'));
    }

    public function submitTestimonial(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'    => ['required', 'string', 'max:100'],
            'rating'  => ['required', 'integer', 'min:1', 'max:5'],
            'content' => ['required', 'string', 'min:10'],
        ]);

        Testimonial::create($validated);

        return back()->with('success', true);
    }
}

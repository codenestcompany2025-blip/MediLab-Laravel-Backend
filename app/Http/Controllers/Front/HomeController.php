<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Gallery;
use App\Models\Faq;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $services     = Service::latest()->get();
        $departments  = Department::latest()->get();
        $doctors      = Doctor::latest()->get();
        $galleries    = Gallery::latest()->get();
        $faqs         = Faq::orderBy('sort_order')->get();
        $testimonials = Testimonial::latest()->get();

        return view('front.index', compact(
            'services',
            'departments',
            'doctors',
            'galleries',
            'faqs',
            'testimonials'
        ));
    }
}

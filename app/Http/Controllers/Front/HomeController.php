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
    $services = \App\Models\Service::latest()->take(6)->get();
    $departments = \App\Models\Department::orderBy('name')->get();
    $doctors = \App\Models\Doctor::latest()->take(8)->get();
    $galleries = \App\Models\Gallery::latest()->take(8)->get();
    $faqs = \App\Models\Faq::orderBy('sort_order')->take(8)->get();
    $testimonials = \App\Models\Testimonial::latest()->take(6)->get();

    $allDepartments = \App\Models\Department::orderBy('name')->get();
    $allDoctors = \App\Models\Doctor::orderBy('name')->get();

    $doctorsCount = $allDoctors->count();
    $departmentsCount = $allDepartments->count();

    return view('front.index', compact(
        'services',
        'departments',
        'doctors',
        'galleries',
        'faqs',
        'testimonials',
        'allDepartments',
        'allDoctors',
        'doctorsCount',
        'departmentsCount'
    ));
}
}

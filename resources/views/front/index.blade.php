@extends('front.layouts.master')

@section('title', 'MediLab - Home')

@section('content')

{{-- Page Heading --}}
<div class="d-sm-flex align-items-center justify-content-between mb-4"></div>

{{-- Services --}}
<div id="services" class="mb-5">
    <h4 class="text-gray-800 mb-3">Services</h4>
    <div class="row">
        @forelse($services as $service)
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card shadow h-100">
                    <div class="card-body">
                        <h6 class="font-weight-bold text-primary">{{ $service->title }}</h6>
                        <p class="mb-0 text-gray-600">
                            {{ \Illuminate\Support\Str::limit($service->description, 120) }}
                        </p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-muted">No services found.</div>
        @endforelse
    </div>
</div>

{{-- Departments --}}
<div id="departments" class="mb-5">
    <h4 class="text-gray-800 mb-3">Departments</h4>
    <div class="row">
        @forelse($departments as $department)
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card shadow h-100">
                    @if($department->image)
                        <img src="{{ asset('storage/'.$department->image) }}" alt="department"
                             style="width:100%;height:180px;object-fit:cover;">
                    @endif
                    <div class="card-body">
                        <h6 class="font-weight-bold">{{ $department->name }}</h6>
                        <p class="mb-0 text-gray-600">
                            {{ \Illuminate\Support\Str::limit($department->description, 120) }}
                        </p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-muted">No departments found.</div>
        @endforelse
    </div>
</div>

{{-- Doctors --}}
<div id="doctors" class="mb-5">
    <h4 class="text-gray-800 mb-3">Doctors</h4>
    <div class="row">
        @forelse($doctors as $doctor)
            <div class="col-md-6 col-lg-3 mb-3">
                <div class="card shadow h-100">
                    @if($doctor->image)
                        <img src="{{ asset('storage/'.$doctor->image) }}" alt="doctor"
                             style="width:100%;height:200px;object-fit:cover;">
                    @endif
                    <div class="card-body">
                        <h6 class="font-weight-bold mb-1">{{ $doctor->name }}</h6>
                        <div class="text-muted small">{{ $doctor->specialty }}</div>
                        <div class="text-muted small">{{ optional($doctor->department)->name }}</div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-muted">No doctors found.</div>
        @endforelse
    </div>
</div>

{{-- Gallery --}}
<div id="gallery" class="mb-5">
    <h4 class="text-gray-800 mb-3">Gallery</h4>
    <div class="row">
        @forelse($galleries as $g)
            <div class="col-6 col-md-3 mb-3">
                <div class="card shadow">
                    <img src="{{ asset('storage/'.$g->path) }}" alt="gallery"
                         style="width:100%;height:160px;object-fit:cover;">
                </div>
            </div>
        @empty
            <div class="col-12 text-muted">No gallery images found.</div>
        @endforelse
    </div>
</div>

{{-- FAQ --}}
<div id="faq" class="mb-5">
    <h4 class="text-gray-800 mb-3">FAQ</h4>
    <div class="card shadow">
        <div class="card-body">
            @forelse($faqs as $faq)
                <div class="mb-3">
                    <div class="font-weight-bold">{{ $faq->question }}</div>
                    <div class="text-gray-600">{{ $faq->answer }}</div>
                </div>
            @empty
                <div class="text-muted">No FAQs found.</div>
            @endforelse
        </div>
    </div>
</div>

{{-- Testimonials --}}
<div id="testimonials" class="mb-5">
    <h4 class="text-gray-800 mb-3">Testimonials</h4>
    <div class="row">
        @forelse($testimonials as $t)
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card shadow h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            @if($t->image)
                                <img src="{{ asset('storage/'.$t->image) }}" alt="t"
                                     style="width:55px;height:55px;border-radius:50%;object-fit:cover;" class="mr-3">
                            @endif
                            <div>
                                <div class="font-weight-bold">{{ $t->name }}</div>
                                <div class="text-muted small">{{ $t->job_title }}</div>
                            </div>
                        </div>
                        <p class="mb-0 text-gray-600">“{{ $t->comment }}”</p>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-muted">No testimonials found.</div>
        @endforelse
    </div>
</div>

@endsection

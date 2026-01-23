@extends('front.layouts.master')

@section('title', 'MediLab - Home')

@section('content')

{{-- Hero Section --}}
<section id="hero" class="hero section light-background">
    <img src="{{ asset('medilab/assets/img/hero-bg.jpg') }}" alt="" data-aos="fade-in">

    <div class="container position-relative">
        <div class="welcome position-relative" data-aos="fade-down" data-aos-delay="100">
            <h2>WELCOME TO MEDILAB</h2>
            <p>We provide quality healthcare services</p>
        </div>

        <div class="content row gy-4">
            <div class="col-lg-4 d-flex align-items-stretch">
                <div class="why-box" data-aos="zoom-out" data-aos-delay="200">
                    <h3>Why Choose MediLab?</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    </p>
                    <div class="text-center">
                        <a href="#about" class="more-btn"><span>Learn More</span> <i class="bi bi-chevron-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 d-flex align-items-stretch">
                <div class="d-flex flex-column justify-content-center">
                    <div class="row gy-4">
                        <div class="col-xl-4 d-flex align-items-stretch">
                            <div class="icon-box" data-aos="zoom-out" data-aos-delay="300">
                                <i class="bi bi-clipboard-data"></i>
                                <h4>Fast & Reliable</h4>
                                <p>Quality medical services and professional staff.</p>
                            </div>
                        </div>

                        <div class="col-xl-4 d-flex align-items-stretch">
                            <div class="icon-box" data-aos="zoom-out" data-aos-delay="400">
                                <i class="bi bi-gem"></i>
                                <h4>Modern Equipment</h4>
                                <p>Up-to-date tools for better diagnosis.</p>
                            </div>
                        </div>

                        <div class="col-xl-4 d-flex align-items-stretch">
                            <div class="icon-box" data-aos="zoom-out" data-aos-delay="500">
                                <i class="bi bi-inboxes"></i>
                                <h4>Trusted Care</h4>
                                <p>Your health is our priority.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
{{-- /Hero Section --}}

{{-- About Section --}}
<section id="about" class="about section">
    <div class="container">
        <div class="row gy-4 gx-5">

            <div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="200">
                <img src="{{ asset('medilab/assets/img/about.jpg') }}" class="img-fluid" alt="">
                <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox pulsating-play-btn"></a>
            </div>

            <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
                <h3>About Us</h3>
                <p>
                    We are committed to providing excellent medical services with professional doctors and modern facilities.
                </p>
                <ul>
                    <li>
                        <i class="fa-solid fa-vial-circle-check"></i>
                        <div>
                            <h5>High quality services</h5>
                            <p>We ensure best standards in all departments.</p>
                        </div>
                    </li>
                    <li>
                        <i class="fa-solid fa-pump-medical"></i>
                        <div>
                            <h5>Clean & safe environment</h5>
                            <p>We follow strict hygiene and safety protocols.</p>
                        </div>
                    </li>
                    <li>
                        <i class="fa-solid fa-heart-circle-xmark"></i>
                        <div>
                            <h5>Care & empathy</h5>
                            <p>We treat our patients with care and respect.</p>
                        </div>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</section>
{{-- /About Section --}}

{{-- Stats Section --}}
<section id="stats" class="stats section light-background">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4">

            <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
                <i class="fa-solid fa-user-doctor"></i>
                <div class="stats-item">
                    <span data-purecounter-start="0" data-purecounter-end="{{ $doctorsCount ?? 0 }}" data-purecounter-duration="1" class="purecounter"></span>
                    <p>Doctors</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
                <i class="fa-regular fa-hospital"></i>
                <div class="stats-item">
                    <span data-purecounter-start="0" data-purecounter-end="{{ $departmentsCount ?? 0 }}" data-purecounter-duration="1" class="purecounter"></span>
                    <p>Departments</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
                <i class="fas fa-flask"></i>
                <div class="stats-item">
                    <span data-purecounter-start="0" data-purecounter-end="12" data-purecounter-duration="1" class="purecounter"></span>
                    <p>Research Labs</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
                <i class="fas fa-award"></i>
                <div class="stats-item">
                    <span data-purecounter-start="0" data-purecounter-end="150" data-purecounter-duration="1" class="purecounter"></span>
                    <p>Awards</p>
                </div>
            </div>

        </div>
    </div>
</section>
{{-- /Stats Section --}}

{{-- Services Section --}}
<section id="services" class="services section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Services</h2>
        <p>Our medical services</p>
    </div>

    <div class="container">
        <div class="row gy-4">
            @forelse($services as $service)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-item position-relative">
                        <div class="icon">
                            <i class="{{ $service->icon ?? 'fas fa-heartbeat' }}"></i>
                        </div>
                        <a href="#" class="stretched-link">
                            <h3>{{ $service->title }}</h3>
                        </a>
                        <p>{{ $service->description }}</p>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted">No services found.</div>
            @endforelse
        </div>
    </div>
</section>
{{-- /Services Section --}}

{{-- Appointment Section --}}
<section id="appointment" class="appointment section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Appointment</h2>
        <p>Book your appointment now</p>
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('front.appointments.store') }}" method="POST" role="form">
            @csrf

            <div class="row">
                <div class="col-md-4 form-group">
                    <input type="text" name="name" class="form-control" placeholder="Your Name" value="{{ old('name') }}" required>
                </div>
                <div class="col-md-4 form-group mt-3 mt-md-0">
                    <input type="email" class="form-control" name="email" placeholder="Your Email" value="{{ old('email') }}" required>
                </div>
                <div class="col-md-4 form-group mt-3 mt-md-0">
                    <input type="tel" class="form-control" name="phone" placeholder="Your Phone" value="{{ old('phone') }}" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 form-group mt-3">
                    <input type="datetime-local" name="appointment_at" class="form-control" value="{{ old('appointment_at') }}" required>
                </div>

                <div class="col-md-4 form-group mt-3">
                    <select name="department_id" class="form-select">
                        <option value="">Select Department</option>
                        @foreach($allDepartments as $d)
                            <option value="{{ $d->id }}" @selected(old('department_id') == $d->id)>{{ $d->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 form-group mt-3">
                    <select name="doctor_id" class="form-select">
                        <option value="">Select Doctor</option>
                        @foreach($allDoctors as $doc)
                            <option value="{{ $doc->id }}" @selected(old('doctor_id') == $doc->id)>{{ $doc->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" placeholder="Message (Optional)">{{ old('message') }}</textarea>
            </div>

            @if($errors->any())
                <div class="mt-3">
                    <div class="error-message" style="display:block;">
                        <ul class="mb-0">
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <div class="mt-3">
                <div class="text-center"><button type="submit">Make an Appointment</button></div>
            </div>
        </form>

    </div>
</section>
{{-- /Appointment Section --}}

{{-- Departments Section --}}
<section id="departments" class="departments section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Departments</h2>
        <p>Our departments</p>
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row">
            <div class="col-lg-3">
                <ul class="nav nav-tabs flex-column">
                    @forelse($departments as $dep)
                        <li class="nav-item">
                            <a class="nav-link @if($loop->first) active show @endif" data-bs-toggle="tab" href="#departments-tab-{{ $dep->id }}">
                                {{ $dep->name }}
                            </a>
                        </li>
                    @empty
                        <li class="nav-item">
                            <a class="nav-link active show" href="#">No departments</a>
                        </li>
                    @endforelse
                </ul>
            </div>

            <div class="col-lg-9 mt-4 mt-lg-0">
                <div class="tab-content">
                    @forelse($departments as $dep)
                        @php
                            $img = $dep->image ? asset('storage/'.$dep->image) : asset('medilab/assets/img/departments-1.jpg');
                        @endphp
                        <div class="tab-pane @if($loop->first) active show @endif" id="departments-tab-{{ $dep->id }}">
                            <div class="row">
                                <div class="col-lg-8 details order-2 order-lg-1">
                                    <h3>{{ $dep->name }}</h3>
                                    <p class="fst-italic">{{ \Illuminate\Support\Str::limit($dep->description, 120) }}</p>
                                    <p>{{ $dep->description }}</p>
                                </div>
                                <div class="col-lg-4 text-center order-1 order-lg-2">
                                    <img src="{{ $img }}" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="tab-pane active show">
                            <p class="text-muted">No departments found.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
{{-- /Departments Section --}}

{{-- Doctors Section --}}
<section id="doctors" class="doctors section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Doctors</h2>
        <p>Our professional doctors</p>
    </div>

    <div class="container">
        <div class="row gy-4">
            @forelse($doctors as $doctor)
                @php
                    $img = $doctor->image ? asset('storage/'.$doctor->image) : asset('medilab/assets/img/doctors/doctors-1.jpg');
                @endphp

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="team-member d-flex align-items-start">
                        <div class="pic">
                            <img src="{{ $img }}" class="img-fluid" alt="">
                        </div>
                        <div class="member-info">
                            <h4>{{ $doctor->name }}</h4>
                            <span>{{ $doctor->specialty }}</span>
                            <p>{{ $doctor->bio ?? '' }}</p>
                            <div class="social">
                                <a href="#"><i class="bi bi-twitter-x"></i></a>
                                <a href="#"><i class="bi bi-facebook"></i></a>
                                <a href="#"><i class="bi bi-instagram"></i></a>
                                <a href="#"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted">No doctors found.</div>
            @endforelse
        </div>
    </div>
</section>
{{-- /Doctors Section --}}

{{-- FAQ Section --}}
<section id="faq" class="faq section light-background">
    <div class="container section-title" data-aos="fade-up">
        <h2>Frequently Asked Questions</h2>
        <p>Frequently asked questions</p>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10" data-aos="fade-up" data-aos-delay="100">
                <div class="faq-container">
                    @forelse($faqs as $f)
                        <div class="faq-item @if($loop->first) faq-active @endif">
                            <h3>{{ $f->question }}</h3>
                            <div class="faq-content">
                                <p>{{ $f->answer }}</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div>
                    @empty
                        <p class="text-center text-muted mb-0">No FAQs found.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
{{-- /FAQ Section --}}

{{-- Testimonials Section --}}
<section id="testimonials" class="testimonials section">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-lg-5 info" data-aos="fade-up" data-aos-delay="100">
                <h3>Testimonials</h3>
                <p>
                    Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                    velit esse cillum dolore eu fugiat nulla pariatur.
                </p>
            </div>

            <div class="col-lg-7" data-aos="fade-up" data-aos-delay="200">
                <div class="swiper init-swiper">

                    <script type="application/json" class="swiper-config">
                        {
                          "loop": true,
                          "speed": 600,
                          "autoplay": { "delay": 5000 },
                          "slidesPerView": "auto",
                          "pagination": { "el": ".swiper-pagination", "type": "bullets", "clickable": true }
                        }
                    </script>

                    <div class="swiper-wrapper">
                        @forelse($testimonials as $t)
                            @php
                                $img = $t->image ? asset('storage/'.$t->image) : asset('medilab/assets/img/testimonials/testimonials-1.jpg');
                            @endphp
                            <div class="swiper-slide">
                                <div class="testimonial-item">
                                    <div class="d-flex">
                                        <img src="{{ $img }}" class="testimonial-img flex-shrink-0" alt="">
                                        <div>
                                            <h3>{{ $t->name }}</h3>
                                            <h4>{{ $t->job_title }}</h4>
                                            <div class="stars">
                                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <p>
                                        <i class="bi bi-quote quote-icon-left"></i>
                                        <span>{{ $t->comment }}</span>
                                        <i class="bi bi-quote quote-icon-right"></i>
                                    </p>
                                </div>
                            </div>
                        @empty
                            <div class="swiper-slide">
                                <div class="testimonial-item">
                                    <p class="text-center text-muted mb-0">No testimonials found.</p>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <div class="swiper-pagination"></div>
                </div>
            </div>

        </div>
    </div>
</section>
{{-- /Testimonials Section --}}

{{-- Gallery Section --}}
<section id="gallery" class="gallery section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Gallery</h2>
        <p>Clinic gallery images</p>
    </div>

    <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">
        <div class="row g-0">
            @forelse($galleries as $g)
                @php
                    $img = $g->path ? asset('storage/'.$g->path) : asset('medilab/assets/img/gallery/gallery-1.jpg');
                @endphp
                <div class="col-lg-3 col-md-4">
                    <div class="gallery-item">
                        <a href="{{ $img }}" class="glightbox" data-gallery="images-gallery">
                            <img src="{{ $img }}" alt="" class="img-fluid">
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted py-5">No gallery images found.</div>
            @endforelse
        </div>
    </div>
</section>
{{-- /Gallery Section --}}

{{-- Contact Section --}}
<section id="contact" class="contact section">
    <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
        <p>Get in touch</p>
    </div>

    <div class="mb-5" data-aos="fade-up" data-aos-delay="200">
        <iframe style="border:0; width: 100%; height: 270px;"
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d48389.78314118045!2d-74.006138!3d40.710059!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a22a3bda30d%3A0xb89d1fe6bc499443!2sDowntown%20Conference%20Center!5e0!3m2!1sen!2sus!4v1676961268712!5m2!1sen!2sus"
                frameborder="0" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4">

            <div class="col-lg-4">
                <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                    <i class="bi bi-geo-alt flex-shrink-0"></i>
                    <div>
                        <h3>Location</h3>
                        <p>Your Address</p>
                    </div>
                </div>

                <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                    <i class="bi bi-telephone flex-shrink-0"></i>
                    <div>
                        <h3>Call Us</h3>
                        <p>+970 599 000 000</p>
                    </div>
                </div>

                <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
                    <i class="bi bi-envelope flex-shrink-0"></i>
                    <div>
                        <h3>Email Us</h3>
                        <p>info@example.com</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">

                @if(session('contact_success'))
                    <div class="alert alert-success">{{ session('contact_success') }}</div>
                @endif

                <form action="{{ route('front.contact.store') }}" method="POST" role="form" data-aos="fade-up" data-aos-delay="200">
                    @csrf

                    <div class="row gy-4">
                        <div class="col-md-6">
                            <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                        </div>

                        <div class="col-md-6">
                            <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                        </div>

                        <div class="col-md-12">
                            <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                        </div>

                        <div class="col-md-12">
                            <textarea class="form-control" name="message" rows="6" placeholder="Message" required></textarea>
                        </div>

                        @if($errors->any())
                            <div class="col-md-12">
                                <div class="alert alert-danger mb-0">
                                    <ul class="mb-0">
                                        @foreach($errors->all() as $e)
                                            <li>{{ $e }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        <div class="col-md-12 text-center">
                            <button type="submit">Send Message</button>
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
</section>
{{-- /Contact Section --}}

@endsection

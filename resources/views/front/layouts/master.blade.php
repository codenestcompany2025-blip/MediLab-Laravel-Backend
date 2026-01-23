<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('title', 'MediLab')</title>
    <meta name="description" content="@yield('meta_description', '')">
    <meta name="keywords" content="@yield('meta_keywords', '')">

    <!-- Favicons -->
    <link href="{{ asset('medilab/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('medilab/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Raleway:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('medilab/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('medilab/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('medilab/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('medilab/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('medilab/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('medilab/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('medilab/assets/css/main.css') }}" rel="stylesheet">

    @stack('styles')

    <style>
        #gallery .gallery-item {
            height: 220px;
            overflow: hidden;
        }

        #gallery .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        /* Appointment Button Styling */
        #appointment button[type="submit"] {
            background: #1977cc;
            border: none;
            padding: 12px 36px;
            color: #fff;
            font-size: 16px;
            font-weight: 500;
            border-radius: 50px;
            transition: all 0.3s ease;
            box-shadow: 0 6px 18px rgba(25, 119, 204, 0.35);
        }

        /* Hover effect */
        #appointment button[type="submit"]:hover {
            background: #166ab5;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(25, 119, 204, 0.45);
        }

        /* Active (click) */
        #appointment button[type="submit"]:active {
            transform: translateY(0);
            box-shadow: 0 4px 12px rgba(25, 119, 204, 0.3);
        }

        /* Success alert styling */
        #appointment .alert-success {
            background: #e8f4ff;
            color: #0b5ed7;
            border: none;
            border-left: 5px solid #1977cc;
            padding: 15px 20px;
            border-radius: 8px;
            font-size: 15px;
        }

        /* Contact Form Button Styling */
        #contact button[type="submit"] {
            background: #1977cc;
            border: none;
            padding: 12px 34px;
            color: #fff;
            font-size: 16px;
            font-weight: 500;
            border-radius: 50px;
            transition: all 0.3s ease;
            box-shadow: 0 6px 18px rgba(25, 119, 204, 0.35);
        }

        /* Hover */
        #contact button[type="submit"]:hover {
            background: #166ab5;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(25, 119, 204, 0.45);
        }

        /* Active */
        #contact button[type="submit"]:active {
            transform: translateY(0);
            box-shadow: 0 4px 12px rgba(25, 119, 204, 0.3);
        }

        @media (max-width: 576px) {
    #contact button[type="submit"] {
        width: 100%;
    }
}

    </style>
</head>

<body class="@yield('body_class', 'index-page')">

    @include('front.partials.header')

    <main class="main">
        @yield('content')
    </main>

    @include('front.partials.footer')

    <!-- Vendor JS Files -->
    <script src="{{ asset('medilab/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('medilab/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('medilab/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('medilab/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('medilab/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('medilab/assets/js/main.js') }}"></script>

    @stack('scripts')
</body>

</html>
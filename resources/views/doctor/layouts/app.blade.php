<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>@yield('title', 'Doctor Panel')</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- FontAwesome (IMPORTANT for icons) -->
    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">

    <!-- SB Admin 2 -->
    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Small fixes -->
    <style>
        .sidebar-brand-text { white-space: nowrap; } 
    </style>
</head>

<body id="page-top">

<div id="wrapper">
    @include('doctor.partials.sidebar')

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            @include('doctor.partials.topbar')

            <div class="container-fluid pt-3">
                @yield('content')
            </div>
        </div>

        @include('doctor.partials.footer')
    </div>
</div>

<!-- JS -->
<script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>

@stack('scripts')
</body>
</html>

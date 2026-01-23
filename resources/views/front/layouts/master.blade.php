<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>@yield('title', 'MediLab')</title>

    {{-- FontAwesome --}}
    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">

    {{-- SB Admin 2 CSS --}}
    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Google Font: Nunito -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">

    @stack('styles')

    <style>
    body {
        font-family: 'Nunito', sans-serif;
    }

    .medilab-brand {
        font-family: 'Nunito', sans-serif;
        font-weight: 800;    
        font-size: 18px;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .sidebar-brand-icon i {
        font-size: 26px;
    }
</style>
</head>

<body id="page-top">

<div id="wrapper">

    {{-- Sidebar --}}
    @include('front.partials.sidebar')

    {{-- Content Wrapper --}}
    <div id="content-wrapper" class="d-flex flex-column">

        {{-- Main Content --}}
        <div id="content">

            {{-- Topbar --}}
            @include('front.partials.topbar')

            {{-- Page Content --}}
            <div class="container-fluid">
                @yield('content')
            </div>

        </div>

        {{-- Footer --}}
        @include('front.partials.footer')

    </div>
</div>

{{-- Scroll to Top Button--}}
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

{{-- jQuery --}}
<script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>

{{-- Bootstrap bundle --}}
<script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

{{-- SB Admin 2 --}}
<script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>

@stack('scripts')
</body>
</html>

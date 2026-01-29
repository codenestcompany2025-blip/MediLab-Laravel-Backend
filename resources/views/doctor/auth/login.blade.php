@extends('doctor.layouts.auth')

@section('title', 'Doctor Login')

@section('content')
    <div class="row no-gutters align-items-center" style="min-height: 420px;">
        {{-- Left Illustration --}}
        <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center" style="background:#ffffff;">
            <div style="padding: 30px;">
                <img src="{{ asset('doctor/img/login-illustration.png') }}" alt="Doctor Login Illustration"
                    style="max-width: 420px; width:100%; height:auto;">
            </div>
        </div>

        {{-- Right Form --}}
        <div class="col-lg-6 p-5">
            <div class="text-center mb-4">
                <h1 class="h4 text-gray-800 mb-2" style="font-weight: 700;">Welcome Back!</h1>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0 pl-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('doctor.login.submit') }}" method="POST">
                @csrf

                <div class="form-group">
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email"
                        required autofocus style="border-radius: 999px; padding: 14px 18px;">
                </div>

                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required
                        style="border-radius: 999px; padding: 14px 18px;">
                </div>

                <div class="form-group d-flex align-items-center justify-content-between">
                    <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                        <label class="custom-control-label" for="remember">Remember Me</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block"
                    style="border-radius: 999px; padding: 12px 18px; font-weight: 700;">
                    Login
                </button>
            </form>
        </div>
    </div>
@endsection
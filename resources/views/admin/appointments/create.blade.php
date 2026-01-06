@extends('admin.layouts.app')

@section('title', 'Add Appointment')
@section('page_title', 'Add Appointment')

@section('page_actions')
    <a href="{{ route('admin.appointments.index') }}" class="btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back
    </a>
@endsection

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Create Appointment</h6>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.appointments.store') }}" method="POST">
            @csrf

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Patient Name</label>
                    <input type="text" name="name" class="form-control"
                           value="{{ old('name') }}" required>
                </div>

                <div class="form-group col-md-6">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control"
                           value="{{ old('email') }}" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control"
                           value="{{ old('phone') }}" required>
                </div>

                <div class="form-group col-md-6">
                    <label>Appointment Date & Time</label>
                    <input type="datetime-local" name="appointment_at" class="form-control"
                           value="{{ old('appointment_at') }}" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Department</label>
                    <select name="department_id" class="form-control" required>
                        <option value="">-- Select Department --</option>
                        @foreach($departments as $dep)
                            <option value="{{ $dep->id }}" {{ old('department_id') == $dep->id ? 'selected' : '' }}>
                                {{ $dep->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label>Doctor</label>
                    <select name="doctor_id" class="form-control" required>
                        <option value="">-- Select Doctor --</option>
                        @foreach($doctors as $doc)
                            <option value="{{ $doc->id }}" {{ old('doctor_id') == $doc->id ? 'selected' : '' }}>
                                {{ $doc->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        <option value="pending" {{ old('status', 'pending') == 'pending' ? 'selected' : '' }}>pending</option>
                        <option value="confirmed" {{ old('status') == 'confirmed' ? 'selected' : '' }}>confirmed</option>
                        <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>cancelled</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>Message (optional)</label>
                <textarea name="message" rows="4" class="form-control">{{ old('message') }}</textarea>
            </div>

            <button class="btn btn-primary">Create</button>
            <a href="{{ route('admin.appointments.index') }}" class="btn btn-light">Cancel</a>
        </form>
    </div>
</div>

@endsection

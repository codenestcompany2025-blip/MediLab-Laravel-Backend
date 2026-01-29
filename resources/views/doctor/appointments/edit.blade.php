@extends('doctor.layouts.app')

@section('title', 'Update Appointment')

@section('content')

<h1 class="h3 mb-3 text-gray-800">Update Appointment Status</h1>

<div class="card shadow mb-4">
    <div class="card-body">

        <div class="mb-3">
            <strong>Patient:</strong> {{ $appointment->name }} <br>
            <strong>Phone:</strong> {{ $appointment->phone }} <br>
            <strong>Date & Time:</strong> {{ optional($appointment->appointment_at)->format('Y-m-d H:i') }} <br>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('doctor.appointments.update', $appointment) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control" required>
                    <option value="pending"   {{ $appointment->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ $appointment->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                    <option value="cancelled" {{ $appointment->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <button class="btn btn-primary">Save</button>
            <a href="{{ route('doctor.appointments.index') }}" class="btn btn-secondary">Back</a>
        </form>

    </div>
</div>

@endsection

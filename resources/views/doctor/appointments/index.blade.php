@extends('doctor.layouts.app')

@section('title', 'My Appointments')

@section('content')

<div class="d-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0 text-gray-800">My Appointments</h1>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow mb-4">
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Patient</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Date & Time</th>
                        <th>Department</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->id }}</td>
                            <td>{{ $appointment->name }}</td>
                            <td>{{ $appointment->email }}</td>
                            <td>{{ $appointment->phone }}</td>
                            <td>{{ optional($appointment->appointment_at)->format('Y-m-d H:i') }}</td>
                            <td>{{ $appointment->department->name ?? '-' }}</td>
                            <td>
                                <span class="badge badge-{{ $appointment->status === 'pending' ? 'warning' : ($appointment->status === 'confirmed' ? 'success' : 'danger') }}">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('doctor.appointments.edit', $appointment) }}" class="btn btn-sm btn-primary">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">No appointments found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $appointments->links() }}
        </div>
    </div>
</div>

@endsection

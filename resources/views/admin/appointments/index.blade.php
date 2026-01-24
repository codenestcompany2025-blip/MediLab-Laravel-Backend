@extends('admin.layouts.app')

@section('title', 'Appointments')
@section('page_title', 'Appointments')

@section('page_actions')
    <a href="{{ route('admin.appointments.create') }}" class="btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> New Appointment
    </a>
@endsection

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Appointments List</h6>
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success mb-3">{{ session('success') }}</div>
            @endif

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
                            <th>Doctor</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th style="width: 160px;">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($appointments as $appointment)
                            <tr>
                                <td>
                                    {{ $appointments->count() - $loop->index }}
                                </td>

                                <td>{{ $appointment->name }}</td>
                                <td>{{ $appointment->email }}</td>
                                <td>{{ $appointment->phone }}</td>
                                <td>{{ optional($appointment->appointment_at)->format('Y-m-d H:i') }}</td>
                                <td>{{ optional($appointment->department)->name ?? '-' }}</td>
                                <td>{{ optional($appointment->doctor)->name ?? '-' }}</td>

                                <td>
                                    @php
                                        $badgeClass = $appointment->status === 'pending' ? 'warning' : ($appointment->status === 'confirmed' ? 'success' : 'danger');
                                    @endphp
                                    <span class="badge badge-{{ $badgeClass }}">{{ ucfirst($appointment->status) }}</span>
                                </td>

                                <td>{{ optional($appointment->created_at)->format('Y-m-d') }}</td>

                                <td>
                                    <a href="{{ route('admin.appointments.edit', $appointment) }}"
                                        class="btn btn-sm btn-info">Edit</a>

                                    <form action="{{ route('admin.appointments.destroy', $appointment) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this appointment?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center text-muted">No appointments found.</td>
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
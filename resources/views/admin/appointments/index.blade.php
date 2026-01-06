@extends('admin.layouts.app')

@section('title', 'Appointments')
@section('page_title', 'Appointments')

@section('page_actions')
    <a href="{{ route('admin.appointments.create') }}" class="btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Add Appointment
    </a>
@endsection

@section('content')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

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
        <h6 class="m-0 font-weight-bold text-primary">Appointments List</h6>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>#</th>
                <th>Patient</th>
                <th>Phone</th>
                <th>Date</th>
                <th>Department</th>
                <th>Doctor</th>
                <th>Status</th>
                <th width="330">Actions</th>
            </tr>
            </thead>

            <tbody>
            @forelse($appointments as $appointment)
                <tr>
                    <td>{{ ($appointments->currentPage() - 1) * $appointments->perPage() + $loop->iteration }}</td>
                    <td>
                        <strong>{{ $appointment->name }}</strong><br>
                        <small class="text-muted">{{ $appointment->email }}</small>
                    </td>

                    <td>{{ $appointment->phone }}</td>

                    <td>
                        {{ $appointment->appointment_at ? \Carbon\Carbon::parse($appointment->appointment_at)->format('Y-m-d H:i') : '-' }}
                    </td>

                    <td>{{ $appointment->department?->name ?? '-' }}</td>
                    <td>{{ $appointment->doctor?->name ?? '-' }}</td>

                    <td>
                        @php
                            $badge = match($appointment->status) {
                                'confirmed' => 'success',
                                'cancelled' => 'danger',
                                default => 'warning'
                            };
                        @endphp
                        <span class="badge badge-{{ $badge }}">{{ $appointment->status }}</span>
                    </td>

                    <td>
                        {{-- Edit --}}
                        <a href="{{ route('admin.appointments.edit', $appointment) }}"
                           class="btn btn-sm btn-warning mb-1">
                            Edit
                        </a>

                        {{-- Quick status update --}}
                        <form action="{{ route('admin.appointments.status', $appointment) }}"
                              method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')

                            <select name="status"
                                    class="form-control form-control-sm d-inline-block"
                                    style="width: 140px; vertical-align: middle;">
                                <option value="pending" {{ $appointment->status=='pending'?'selected':'' }}>pending</option>
                                <option value="confirmed" {{ $appointment->status=='confirmed'?'selected':'' }}>confirmed</option>
                                <option value="cancelled" {{ $appointment->status=='cancelled'?'selected':'' }}>cancelled</option>
                            </select>

                            <button class="btn btn-sm btn-primary mb-1" type="submit">Save</button>
                        </form>

                        {{-- Delete --}}
                        <form action="{{ route('admin.appointments.destroy', $appointment) }}"
                              method="POST" class="d-inline"
                              onsubmit="return confirm('Delete this appointment?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger mb-1">Delete</button>
                        </form>
                    </td>
                </tr>

                @if($appointment->message)
                    <tr>
                        <td colspan="8">
                            <strong>Message:</strong>
                            <div class="text-muted">{{ $appointment->message }}</div>
                        </td>
                    </tr>
                @endif

            @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">No appointments found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $appointments->links() }}
        </div>
    </div>
</div>

@endsection

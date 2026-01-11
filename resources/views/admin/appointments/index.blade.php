@extends('admin.layouts.app')

@section('title', 'Appointments')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0 text-gray-800">Appointments</h1>
    <a href="{{ route('admin.appointments.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Appointment
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
        </ul>
    </div>
@endif

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width:60px">#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Appointment At</th>
                        <th>Department</th>
                        <th>Doctor</th>
                        <th>Status</th>
                        <th style="width:160px;">Actions</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($appointments as $appointment)
                    <tr>
                        <td>
                            {{ ($appointments->currentPage() - 1) * $appointments->perPage() + $loop->iteration }}
                        </td>
                        <td>{{ $appointment->name }}</td>
                        <td>{{ $appointment->email }}</td>
                        <td>{{ $appointment->phone }}</td>
                        <td>{{ \Carbon\Carbon::parse($appointment->appointment_at)->format('Y-m-d H:i') }}</td>
                        <td>{{ $appointment->department?->name }}</td>
                        <td>{{ $appointment->doctor?->name }}</td>
                        <td>
                            <span class="badge badge-secondary">{{ $appointment->status }}</span>
                        </td>
                        <td>
                            <a href="{{ route('admin.appointments.edit', $appointment) }}" class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('admin.appointments.destroy', $appointment) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Delete?')" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted">No appointments found.</td>
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

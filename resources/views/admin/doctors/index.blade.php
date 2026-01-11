@extends('admin.layouts.app')

@section('title', 'Doctors')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0 text-gray-800">Doctors</h1>
    <a href="{{ route('admin.doctors.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Doctor
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th style="width:70px;">#</th>
                        <th style="width:120px;">Image</th>
                        <th>Name</th>
                        <th>Specialty</th>
                        <th>Department</th>
                        <th>Email</th>
                        <th style="width:180px;">Actions</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($doctors as $doctor)
                    <tr>
                        <td>
                            {{ ($doctors->currentPage() - 1) * $doctors->perPage() + $loop->iteration }}
                        </td>

                        <td>
                            @if($doctor->image)
                                <img
                                    src="{{ asset('storage/'.$doctor->image) }}"
                                    alt="doctor"
                                    style="width:70px;height:70px;object-fit:cover;border-radius:50%;"
                                >
                            @else
                                <span class="text-muted">No image</span>
                            @endif
                        </td>

                        <td>{{ $doctor->name }}</td>
                        <td>{{ $doctor->specialty }}</td>
                        <td>{{ optional($doctor->department)->name ?? '-' }}</td>
                        <td>{{ $doctor->email }}</td>

                        <td>
                            <a href="{{ route('admin.doctors.edit', $doctor) }}" class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('admin.doctors.destroy', $doctor) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Delete this doctor?')" class="btn btn-danger btn-sm">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">No doctors found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $doctors->links() }}
        </div>
    </div>
</div>
@endsection

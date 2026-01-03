@extends('admin.layouts.app')

@section('title', 'Doctors')
@section('page_title', 'Doctors')

@section('page_actions')
    <a href="{{ route('admin.doctors.create') }}" class="btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Add Doctor
    </a>
@endsection

@section('content')

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Doctors List</h6>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Specialty</th>
                    <th>Department</th>
                    <th width="180">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($doctors as $doctor)
                    <tr>
                        <td>{{ $doctor->id }}</td>
                        <td>
                            @if($doctor->image)
                                <img src="{{ asset('storage/'.$doctor->image) }}" width="60" height="60"
                                     style="object-fit:cover;border-radius:8px;">
                            @else
                                <span class="text-muted">No image</span>
                            @endif
                        </td>
                        <td>{{ $doctor->name }}</td>
                        <td>{{ $doctor->specialty }}</td>
                        <td>{{ $doctor->department?->name ?? '-' }}</td>
                        <td>
                            <a class="btn btn-sm btn-warning" href="{{ route('admin.doctors.edit', $doctor) }}">Edit</a>

                            <form class="d-inline" method="POST" action="{{ route('admin.doctors.destroy', $doctor) }}"
                                  onsubmit="return confirm('Delete this doctor?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center text-muted">No doctors found.</td></tr>
                @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $doctors->links() }}
            </div>
        </div>
    </div>

@endsection

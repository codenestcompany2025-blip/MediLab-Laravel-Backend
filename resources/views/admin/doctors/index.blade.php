@extends('admin.layouts.app')

@section('title', 'Doctors')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0 text-gray-800">Doctors</h1>
    <a href="{{ route('admin.doctors.create') }}" class="btn btn-primary btn-sm">
        <i class="fas fa-plus"></i> Add Doctor
    </a>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow mb-4">
    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover mb-0">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Specialty</th>
                    <th>Department</th>
                    <th>Email</th>
                    <th style="width:140px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($doctors as $d)
                    <tr>
                        <td>{{ ($doctors->currentPage() - 1) * $doctors->perPage() + $loop->iteration }}</td>
                        <td>
                            <img src="{{ $d->image ? asset('storage/'.$d->image) : asset('admin/img/undraw_profile.svg') }}"
                                 style="width:60px;height:60px;object-fit:cover;border-radius:12px;">
                        </td>
                        <td>{{ $d->name }}</td>
                        <td>{{ $d->specialty }}</td>
                        <td>{{ $d->department?->name }}</td>
                        <td>{{ $d->email }}</td>
                        <td>
                            <a href="{{ route('admin.doctors.edit', $d) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.doctors.destroy', $d) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center text-muted">No doctors.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{ $doctors->links() }}
@endsection

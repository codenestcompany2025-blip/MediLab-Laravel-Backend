@extends('admin.layouts.app')

@section('title', 'Departments')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0 text-gray-800">Departments</h1>
    <a href="{{ route('admin.departments.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Department
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
                        <th style="width:140px;">Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th style="width:180px;">Actions</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($departments as $department)
                    <tr>
                        <td>
                            {{ ($departments->currentPage() - 1) * $departments->perPage() + $loop->iteration }}
                        </td>

                        <td>
                            @if($department->image)
                                <img
                                    src="{{ asset('storage/'.$department->image) }}"
                                    alt="department"
                                    style="width:90px;height:60px;object-fit:cover;border-radius:6px;"
                                >
                            @else
                                <span class="text-muted">No image</span>
                            @endif
                        </td>

                        <td>{{ $department->name }}</td>

                        <td>
                            {{ \Illuminate\Support\Str::limit($department->description, 80) }}
                        </td>

                        <td>
                            <a href="{{ route('admin.departments.edit', $department) }}" class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('admin.departments.destroy', $department) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Delete this department?')" class="btn btn-danger btn-sm">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">No departments found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $departments->links() }}
        </div>
    </div>
</div>
@endsection

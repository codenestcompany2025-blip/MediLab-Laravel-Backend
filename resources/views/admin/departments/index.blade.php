@extends('admin.layouts.app')

@section('title', 'Departments')
@section('page_title', 'Departments')

@section('page_actions')
    <a href="{{ route('admin.departments.create') }}" class="btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Add Department
    </a>
@endsection

@section('content')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Departments List</h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th width="180">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($departments as $department)
                    @php
                        $imgUrl = $department->image ? \Illuminate\Support\Facades\Storage::disk('public')->url($department->image) : null;
                    @endphp
                    <tr>
                        <td>{{ ($departments->currentPage() - 1) * $departments->perPage() + $loop->iteration }}</td>
                        <td>
                            <img
                                src="{{ $department->image ? asset('storage/'.$department->image) : asset('admin/img/undraw_posting_photo.svg') }}"
                                style="width:60px;height:60px;object-fit:cover;border-radius:10px;"
                                alt="img"
                                />
                        </td>
                        <td>{{ $department->name }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($department->description, 90) }}</td>
                        <td>
                            <a href="{{ route('admin.departments.edit', $department) }}" class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('admin.departments.destroy', $department) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Delete this department?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-muted">No departments found.</td></tr>
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

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
        <div class="card-header py-3">
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
                        <tr>
                            <td>{{ $department->id }}</td>
                            <td>
                                @if($department->image)
                                    <img src="{{ asset('storage/'.$department->image) }}" width="60" height="60" style="object-fit:cover;border-radius:8px;">
                                @else
                                    <span class="text-muted">No image</span>
                                @endif
                            </td>
                            <td>{{ $department->name }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($department->description, 80) }}</td>
                            <td>
                                <a href="{{ route('admin.departments.edit', $department) }}" class="btn btn-sm btn-warning">
                                    Edit
                                </a>

                                <form action="{{ route('admin.departments.destroy', $department) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Are you sure you want to delete this department?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" type="submit">Delete</button>
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

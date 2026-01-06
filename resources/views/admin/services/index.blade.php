@extends('admin.layouts.app')

@section('title', 'Services')
@section('page_title', 'Services')

@section('page_actions')
    <a href="{{ route('admin.services.create') }}" class="btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Add Service
    </a>
@endsection

@section('content')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Services List</h6>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Icon</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th width="180">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($services as $service)
                    <tr>
                        <td>{{ ($services->currentPage() - 1) * $services->perPage() + $loop->iteration }}</td>
                        <td>
                            <i class="{{ $service->icon }}"></i>
                            <span class="text-muted ml-2">{{ $service->icon }}</span>
                        </td>
                        <td>{{ $service->title }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($service->description, 90) }}</td>
                        <td>
                            <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Delete this service?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-muted">No services found.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $services->links() }}
        </div>
    </div>
</div>

@endsection

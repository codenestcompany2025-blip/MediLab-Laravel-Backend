@extends('admin.layouts.app')

@section('title', 'Galleries')
@section('page_title', 'Galleries')

@section('page_actions')
    <a href="{{ route('admin.galleries.create') }}" class="btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Add Gallery Image
    </a>
@endsection

@section('content')

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Gallery List</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Sort Order</th>
                        <th width="180">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($galleries as $gallery)
                        <tr>
                            <td>{{ $gallery->id }}</td>
                            <td>
                                @if($gallery->image)
                                    <img src="{{ asset('storage/'.$gallery->image) }}" width="80" height="60"
                                         style="object-fit:cover;border-radius:8px;">
                                @else
                                    <span class="text-muted">No image</span>
                                @endif
                            </td>
                            <td>{{ $gallery->title }}</td>
                            <td>{{ $gallery->sort_order }}</td>
                            <td>
                                <a href="{{ route('admin.galleries.edit', $gallery) }}" class="btn btn-sm btn-warning">
                                    Edit
                                </a>

                                <form action="{{ route('admin.galleries.destroy', $gallery) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Are you sure you want to delete this image?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" type="submit">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No gallery images found.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $galleries->links() }}
            </div>
        </div>
    </div>

@endsection

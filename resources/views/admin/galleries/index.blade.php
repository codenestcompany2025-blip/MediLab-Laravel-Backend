@extends('admin.layouts.app')

@section('title', 'Gallery')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0 text-gray-800">Gallery</h1>
    <a href="{{ route('admin.galleries.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Image
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
                        <th style="width:160px;">Image</th>
                        <th>Caption</th>
                        <th style="width:180px;">Actions</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($galleries as $g)
                    <tr>
                        <td>
                            {{ ($galleries->currentPage() - 1) * $galleries->perPage() + $loop->iteration }}
                        </td>

                        <td>
                            @if(!empty($g->path))
                                <img
                                    src="{{ asset('storage/'.$g->path) }}"
                                    alt="gallery"
                                    style="width:140px;height:100px;object-fit:contain;border-radius:8px;background:#f8f9fa;padding:4px;"
                                >
                            @else
                                <span class="text-muted">No image</span>
                            @endif
                        </td>

                        <td>
                            {{ $g->caption ?? '-' }}
                        </td>

                        <td>
                            <a href="{{ route('admin.galleries.edit', $g) }}" class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('admin.galleries.destroy', $g) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Delete this image?')" class="btn btn-danger btn-sm">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">No images found.</td>
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

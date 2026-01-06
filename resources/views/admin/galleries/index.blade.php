@extends('admin.layouts.app')

@section('title', 'Galleries')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0 text-gray-800">Galleries</h1>
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
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Preview</th>
                        <th>Caption</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($galleries as $gallery)
                    <tr>
                        <td>{{ ($galleries->currentPage() - 1) * $galleries->perPage() + $loop->iteration }}</td>
                        <td style="width:160px">
                            @if($gallery->path)
                                <img
                                    src="{{ \Illuminate\Support\Facades\Storage::url($gallery->path) }}"
                                    alt="gallery"
                                    style="width:140px;height:80px;object-fit:cover;border-radius:8px;"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='block';"
                                >
                                <span style="display:none;color:#999;">Image not found</span>
                            @else
                                <span class="text-muted">No image</span>
                            @endif
                        </td>
                        <td>{{ $gallery->caption }}</td>
                        <td style="width:180px">
                            <a href="{{ route('admin.galleries.edit', $gallery) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Delete?')" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center text-muted">No images found.</td></tr>
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

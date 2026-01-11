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
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th style="width:70px;">#</th>
                        <th style="width:200px;">Preview</th>
                        <th>Caption</th>
                        <th style="width:180px;">Actions</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($galleries as $gallery)
                    <tr>
                        <td>{{ ($galleries->currentPage() - 1) * $galleries->perPage() + $loop->iteration }}</td>

                        <td>
                            @if($gallery->path)
                                <img src="{{ asset('storage/'.$gallery->path) }}"
                                     style="width:180px;height:110px;object-fit:cover;border-radius:6px;">
                            @else
                                <span class="text-muted">No image</span>
                            @endif
                        </td>

                        <td>{{ $gallery->caption }}</td>

                        <td>
                            <a href="{{ route('admin.galleries.edit', $gallery) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Delete this image?')" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">No gallery images found.</td>
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

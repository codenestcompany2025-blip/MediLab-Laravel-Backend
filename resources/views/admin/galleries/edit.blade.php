@extends('admin.layouts.app')

@section('title', 'Edit Gallery Image')
@section('page_title', 'Edit Gallery Image')

@section('page_actions')
    <a href="{{ route('admin.galleries.index') }}" class="btn btn-sm btn-secondary">
        Back
    </a>
@endsection

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Gallery Image</h6>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.galleries.update', $gallery) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Title (optional)</label>
                    <input type="text" name="title" value="{{ old('title', $gallery->title) }}"
                           class="form-control @error('title') is-invalid @enderror">
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $gallery->sort_order) }}"
                           class="form-control @error('sort_order') is-invalid @enderror">
                    @error('sort_order') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Current Image</label><br>
                    @if($gallery->image)
                        <img src="{{ asset('storage/'.$gallery->image) }}" width="160"
                             style="object-fit:cover;border-radius:10px;">
                    @else
                        <span class="text-muted">No image</span>
                    @endif
                </div>

                <div class="form-group">
                    <label>Change Image (optional)</label>
                    <input type="file" name="image"
                           class="form-control-file @error('image') is-invalid @enderror">
                    @error('image') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                </div>

                <button class="btn btn-primary" type="submit">Update</button>
            </form>
        </div>
    </div>

@endsection

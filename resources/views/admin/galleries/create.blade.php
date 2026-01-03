@extends('admin.layouts.app')

@section('title', 'Add Gallery Image')
@section('page_title', 'Add Gallery Image')

@section('page_actions')
    <a href="{{ route('admin.galleries.index') }}" class="btn btn-sm btn-secondary">
        Back
    </a>
@endsection

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Create Gallery Image</h6>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>Title (optional)</label>
                    <input type="text" name="title" value="{{ old('title') }}"
                           class="form-control @error('title') is-invalid @enderror">
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}"
                           class="form-control @error('sort_order') is-invalid @enderror">
                    @error('sort_order') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="image"
                           class="form-control-file @error('image') is-invalid @enderror" required>
                    @error('image') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                </div>

                <button class="btn btn-primary" type="submit">Save</button>
            </form>
        </div>
    </div>

@endsection

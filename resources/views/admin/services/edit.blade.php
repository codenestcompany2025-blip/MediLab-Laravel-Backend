@extends('admin.layouts.app')

@section('title', 'Edit Service')
@section('page_title', 'Edit Service')

@section('page_actions')
    <a href="{{ route('admin.services.index') }}" class="btn btn-sm btn-secondary">
        Back
    </a>
@endsection

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Service</h6>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.services.update', $service) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Icon class</label>
                    <input type="text" name="icon" value="{{ old('icon', $service->icon) }}"
                           class="form-control @error('icon') is-invalid @enderror"
                           placeholder="مثال: fas fa-heartbeat">
                    @error('icon') <div class="invalid-feedback">{{ $message }}</div> @enderror

                    <div class="mt-2">
                        <span class="text-muted">Preview:</span>
                        <i class="{{ $service->icon }} ml-2"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" value="{{ old('title', $service->title) }}"
                           class="form-control @error('title') is-invalid @enderror">
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" rows="5"
                              class="form-control @error('description') is-invalid @enderror">{{ old('description', $service->description) }}</textarea>
                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <button class="btn btn-primary" type="submit">Update</button>
            </form>
        </div>
    </div>

@endsection

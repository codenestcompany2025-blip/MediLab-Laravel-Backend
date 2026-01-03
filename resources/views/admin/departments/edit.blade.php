@extends('admin.layouts.app')

@section('title', 'Edit Department')
@section('page_title', 'Edit Department')

@section('page_actions')
    <a href="{{ route('admin.departments.index') }}" class="btn btn-sm btn-secondary">
        Back
    </a>
@endsection

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Department</h6>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.departments.update', $department) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" value="{{ old('name', $department->name) }}"
                           class="form-control @error('name') is-invalid @enderror">
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" rows="5"
                              class="form-control @error('description') is-invalid @enderror">{{ old('description', $department->description) }}</textarea>
                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Current Image</label><br>
                    @if($department->image)
                        <img src="{{ asset('storage/'.$department->image) }}" width="120" style="object-fit:cover;border-radius:10px;">
                    @else
                        <span class="text-muted">No image</span>
                    @endif
                </div>

                <div class="form-group">
                    <label>Change Image (optional)</label>
                    <input type="file" name="image" class="form-control-file @error('image') is-invalid @enderror">
                    @error('image') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                </div>

                <button class="btn btn-primary" type="submit">Update</button>
            </form>
        </div>
    </div>

@endsection

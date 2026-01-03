@extends('admin.layouts.app')

@section('title', 'Add Service')
@section('page_title', 'Add Service')

@section('page_actions')
    <a href="{{ route('admin.services.index') }}" class="btn btn-sm btn-secondary">
        Back
    </a>
@endsection

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Create Service</h6>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.services.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Icon class</label>
                    <input type="text" name="icon" value="{{ old('icon') }}"
                           class="form-control @error('icon') is-invalid @enderror"
                           placeholder="مثال: fas fa-heartbeat">
                    @error('icon') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    <small class="text-muted">اكتبي كلاس الأيقونة (FontAwesome) مثل: <code>fas fa-heartbeat</code></small>
                </div>

                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" value="{{ old('title') }}"
                           class="form-control @error('title') is-invalid @enderror">
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" rows="5"
                              class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <button class="btn btn-primary" type="submit">Save</button>
            </form>
        </div>
    </div>

@endsection

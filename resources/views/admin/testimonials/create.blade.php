@extends('admin.layouts.app')

@section('title', 'Add Testimonial')
@section('page_title', 'Add Testimonial')

@section('page_actions')
    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-sm btn-secondary">
        Back
    </a>
@endsection

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Create Testimonial</h6>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                           class="form-control @error('name') is-invalid @enderror">
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Job Title</label>
                    <input type="text" name="job_title" value="{{ old('job_title') }}"
                           class="form-control @error('job_title') is-invalid @enderror">
                    @error('job_title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Comment</label>
                    <textarea name="comment" rows="5"
                              class="form-control @error('comment') is-invalid @enderror">{{ old('comment') }}</textarea>
                    @error('comment') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Image (optional)</label>
                    <input type="file" name="image"
                           class="form-control-file @error('image') is-invalid @enderror">
                    @error('image') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                </div>

                <button class="btn btn-primary" type="submit">Save</button>
            </form>
        </div>
    </div>

@endsection

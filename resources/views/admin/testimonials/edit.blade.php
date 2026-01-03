@extends('admin.layouts.app')

@section('title', 'Edit Testimonial')
@section('page_title', 'Edit Testimonial')

@section('page_actions')
    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-sm btn-secondary">
        Back
    </a>
@endsection

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Testimonial</h6>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" value="{{ old('name', $testimonial->name) }}"
                           class="form-control @error('name') is-invalid @enderror">
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Job Title</label>
                    <input type="text" name="job_title" value="{{ old('job_title', $testimonial->job_title) }}"
                           class="form-control @error('job_title') is-invalid @enderror">
                    @error('job_title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Comment</label>
                    <textarea name="comment" rows="5"
                              class="form-control @error('comment') is-invalid @enderror">{{ old('comment', $testimonial->comment) }}</textarea>
                    @error('comment') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Current Image</label><br>
                    @if($testimonial->image)
                        <img src="{{ asset('storage/'.$testimonial->image) }}" width="120"
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

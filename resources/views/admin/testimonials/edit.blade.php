@extends('admin.layouts.app')

@section('title', 'Edit Testimonial')

@section('content')
<h1 class="h3 mb-3 text-gray-800">Edit Testimonial</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
        </ul>
    </div>
@endif

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="form-group">
                <label>Name *</label>
                <input type="text" name="name" class="form-control"
                       value="{{ old('name', $testimonial->name) }}" required>
            </div>

            <div class="form-group">
                <label>Job Title *</label>
                <input type="text" name="job_title" class="form-control"
                       value="{{ old('job_title', $testimonial->job_title) }}" required>
            </div>

            <div class="form-group">
                <label>Comment *</label>
                <textarea name="comment" class="form-control" rows="5" required>{{ old('comment', $testimonial->comment) }}</textarea>
            </div>

            <div class="form-group">
                <label>Current Image</label><br>
                <img
                    src="{{ $testimonial->image ? asset('storage/'.$testimonial->image) : asset('admin/img/undraw_profile.svg') }}"
                    alt="img"
                    style="width:80px;height:80px;object-fit:cover;border-radius:12px;"
                >
            </div>

            <div class="form-group">
                <label>Change Image</label>
                <input type="file" name="image" class="form-control-file" accept="image/*">
            </div>

            <button class="btn btn-primary">Update</button>
            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection

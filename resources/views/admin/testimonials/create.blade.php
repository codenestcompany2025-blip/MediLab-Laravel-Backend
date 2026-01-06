@extends('admin.layouts.app')

@section('title', 'Add Testimonial')

@section('content')
<h1 class="h3 mb-3 text-gray-800">Add Testimonial</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
        </ul>
    </div>
@endif

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Name *</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label>Job Title *</label>
                <input type="text" name="job_title" class="form-control" value="{{ old('job_title') }}" required>
            </div>

            <div class="form-group">
                <label>Comment *</label>
                <textarea name="comment" class="form-control" rows="5" required>{{ old('comment') }}</textarea>
            </div>

            <div class="form-group">
                <label>Image</label>
                <input type="file" name="image" class="form-control-file" accept="image/*">
            </div>

            <button class="btn btn-primary">Save</button>
            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection

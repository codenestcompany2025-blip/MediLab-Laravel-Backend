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
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required value="{{ old('name', $testimonial->name) }}">
            </div>

            <div class="mb-3">
                <label>Job Title</label>
                <input type="text" name="job_title" class="form-control" required value="{{ old('job_title', $testimonial->job_title) }}">
            </div>

            <div class="mb-3">
                <label>Comment</label>
                <textarea name="comment" class="form-control" required>{{ old('comment', $testimonial->comment) }}</textarea>
            </div>

            <div class="mb-3">
                <label>Current Image</label><br>
                @if($testimonial->image)
                    <img src="{{ asset('storage/'.$testimonial->image) }}" style="width:90px;height:90px;object-fit:cover;border-radius:50%;">
                @else
                    <span class="text-muted">No image</span>
                @endif
            </div>

            <div class="mb-3">
                <label>New Image (optional)</label>
                <input type="file" name="image" class="form-control">
            </div>

            <button class="btn btn-primary">Update</button>
        </form>

    </div>
</div>
@endsection

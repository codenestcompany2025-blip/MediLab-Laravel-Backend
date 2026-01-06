@extends('admin.layouts.app')

@section('title', 'Add Gallery Image')

@section('content')
<h1 class="h3 mb-3 text-gray-800">Add Gallery Image</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
        </ul>
    </div>
@endif

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label>Caption</label>
                <input type="text" name="caption" class="form-control" value="{{ old('caption') }}">
            </div>

            <div class="form-group">
                <label>Image *</label>
                <input type="file" name="image" class="form-control-file" accept="image/*" required>
            </div>

            <button class="btn btn-primary">Save</button>
            <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection

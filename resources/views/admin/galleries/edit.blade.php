@extends('admin.layouts.app')

@section('title', 'Edit Gallery Image')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0 text-gray-800">Edit Gallery Image</h1>
    <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary btn-sm">Back</a>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card shadow">
    <div class="card-body">
        <form action="{{ route('admin.galleries.update', $gallery) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Caption</label>
            <input type="text" name="caption" value="{{ $gallery->caption }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Current Image</label><br>
            <img src="{{ Storage::url($gallery->path) }}" width="120">
        </div>

        <div class="mb-3">
            <label>New Image</label>
            <input type="file" name="path" class="form-control">
        </div>

        <button class="btn btn-primary">Update</button>
    </form>

    </div>
</div>
@endsection

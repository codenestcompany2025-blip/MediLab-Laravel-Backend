@extends('admin.layouts.app')

@section('title', 'Edit Gallery Image')

@section('content')
<h1 class="h3 mb-3 text-gray-800">Edit Gallery Image</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
        </ul>
    </div>
@endif

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('admin.galleries.update', $gallery) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="form-group">
                <label>Current Image</label><br>
                <img src="{{ asset('storage/'.$gallery->path) }}"
                     alt="img"
                     style="width:160px;height:100px;object-fit:cover;border-radius:12px;">
            </div>

            <div class="form-group">
                <label>Caption</label>
                <input type="text" name="caption" class="form-control"
                       value="{{ old('caption', $gallery->caption) }}">
            </div>

            <div class="form-group">
                <label>Change Image</label>
                <input type="file" name="image" class="form-control-file" accept="image/*">
            </div>

            <button class="btn btn-primary">Update</button>
            <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection

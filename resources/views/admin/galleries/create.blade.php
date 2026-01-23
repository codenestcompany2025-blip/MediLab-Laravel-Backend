@extends('admin.layouts.app')

@section('title', 'Add Gallery Image')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0 text-gray-800">Add Gallery Image</h1>
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
        <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Caption</label>
            <input type="text" name="caption" class="form-control">
        </div>

        <div class="mb-3">
            <label>Image</label>
            <input type="file" name="path" class="form-control" required>
        </div>

        <button class="btn btn-primary">Save</button>
    </form>

    </div>
</div>
@endsection

@extends('admin.layouts.app')

@section('title', 'Edit Department')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0 text-gray-800">Edit Department</h1>
    <a href="{{ route('admin.departments.index') }}" class="btn btn-secondary">Back</a>
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
        <form action="{{ route('admin.departments.update', $department) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Name *</label>
                <input type="text" name="name" class="form-control"
                       value="{{ old('name', $department->name) }}" required>
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" class="form-control" rows="4">{{ old('description', $department->description) }}</textarea>
            </div>

            <div class="form-group">
                <label>Image</label>
                <input type="file" name="image" class="form-control-file">

                @if($department->image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/'.$department->image) }}"
                             style="width:120px;height:90px;object-fit:cover;border-radius:6px;"
                             alt="department">
                    </div>
                @endif
            </div>

            <button class="btn btn-primary">Update</button>
            <a href="{{ route('admin.departments.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection

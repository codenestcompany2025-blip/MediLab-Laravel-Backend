@extends('admin.layouts.app')

@section('title', 'Edit Department')
@section('page_title', 'Edit Department')

@section('page_actions')
    <a href="{{ route('admin.departments.index') }}" class="btn btn-sm btn-secondary">
        Back
    </a>
@endsection

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Department</h6>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.departments.update', $department) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <input type="text" name="name" value="{{ $department->name }}" class="form-control mb-3" required>

            <textarea name="description" class="form-control mb-3" required>{{ $department->description }}</textarea>

            <img src="{{ asset('storage/'.$department->image) }}" width="120" class="mb-3">

            <input type="file" name="image" class="form-control mb-3">

            <button class="btn btn-primary">Update</button>
        </form>

        </div>
    </div>

@endsection

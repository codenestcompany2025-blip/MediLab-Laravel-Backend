@extends('admin.layouts.app')

@section('title', 'Add Department')
@section('page_title', 'Add Department')

@section('page_actions')
    <a href="{{ route('admin.departments.index') }}" class="btn btn-sm btn-secondary">
        Back
    </a>
@endsection

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Create Department</h6>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.departments.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="text" name="name" class="form-control mb-3" placeholder="Name" required>

            <textarea name="description" class="form-control mb-3" placeholder="Description" required></textarea>

            <input type="file" name="image" class="form-control mb-3" required>

            <button class="btn btn-primary">Save</button>
        </form>

        </div>
    </div>

@endsection

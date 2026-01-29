@extends('admin.layouts.app')

@section('title', 'Add Doctor')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0 text-gray-800">Add Doctor</h1>
    <a href="{{ route('admin.doctors.index') }}" class="btn btn-secondary btn-sm">Back</a>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
        </ul>
    </div>
@endif

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('admin.doctors.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Name *</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <div class="form-group col-md-6">
                    <label>Specialty *</label>
                    <input type="text" name="specialty" class="form-control" value="{{ old('specialty') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label>Department *</label>
                <select name="department_id" class="form-control" required>
                    <option value="" disabled selected>Choose department</option>
                    @foreach($departments as $dep)
                        <option value="{{ $dep->id }}" @selected(old('department_id') == $dep->id)>{{ $dep->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="">
                <small class="text-muted">Leave empty if not needed.</small>
            </div>

            <div class="form-group">
                <label>Bio (optional)</label>
                <textarea name="bio" class="form-control" rows="5">{{ old('bio') }}</textarea>
            </div>

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label>Facebook</label>
                    <input type="text" name="facebook" class="form-control" value="{{ old('facebook') }}">
                </div>
                <div class="form-group col-md-3">
                    <label>Twitter</label>
                    <input type="text" name="twitter" class="form-control" value="{{ old('twitter') }}">
                </div>
                <div class="form-group col-md-3">
                    <label>Instagram</label>
                    <input type="text" name="instagram" class="form-control" value="{{ old('instagram') }}">
                </div>
                <div class="form-group col-md-3">
                    <label>LinkedIn</label>
                    <input type="text" name="linkedin" class="form-control" value="{{ old('linkedin') }}">
                </div>
            </div>

            <div class="form-group">
                <label>Image *</label>
                <input type="file" name="image" class="form-control-file" accept="image/*" required>
            </div>

            <button class="btn btn-primary">Save</button>
            <a href="{{ route('admin.doctors.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection

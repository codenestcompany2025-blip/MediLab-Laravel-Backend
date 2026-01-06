@extends('admin.layouts.app')

@section('title', 'Edit Doctor')

@section('content')
<h1 class="h3 mb-3 text-gray-800">Edit Doctor</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
        </ul>
    </div>
@endif

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('admin.doctors.update', $doctor) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="form-group">
                <label>Current Image</label><br>
                <img src="{{ $doctor->image ? asset('storage/'.$doctor->image) : asset('admin/img/undraw_profile.svg') }}"
                     style="width:100px;height:100px;object-fit:cover;border-radius:12px;">
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Name *</label>
                    <input type="text" name="name" class="form-control"
                           value="{{ old('name', $doctor->name) }}" required>
                </div>
                <div class="form-group col-md-6">
                    <label>Specialty *</label>
                    <input type="text" name="specialty" class="form-control"
                           value="{{ old('specialty', $doctor->specialty) }}" required>
                </div>
            </div>

            <div class="form-group">
                <label>Department *</label>
                <select name="department_id" class="form-control" required>
                    @foreach($departments as $dep)
                        <option value="{{ $dep->id }}" @selected(old('department_id', $doctor->department_id) == $dep->id)>{{ $dep->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Email (optional)</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $doctor->email) }}">
            </div>

            <div class="form-group">
                <label>New Password (optional)</label>
                <input type="password" name="password" class="form-control" value="">
                <small class="text-muted">Leave empty to keep current password.</small>
            </div>

            <div class="form-group">
                <label>Bio</label>
                <textarea name="bio" class="form-control" rows="5">{{ old('bio', $doctor->bio) }}</textarea>
            </div>

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label>Facebook</label>
                    <input type="text" name="facebook" class="form-control" value="{{ old('facebook', $doctor->facebook) }}">
                </div>
                <div class="form-group col-md-3">
                    <label>Twitter</label>
                    <input type="text" name="twitter" class="form-control" value="{{ old('twitter', $doctor->twitter) }}">
                </div>
                <div class="form-group col-md-3">
                    <label>Instagram</label>
                    <input type="text" name="instagram" class="form-control" value="{{ old('instagram', $doctor->instagram) }}">
                </div>
                <div class="form-group col-md-3">
                    <label>LinkedIn</label>
                    <input type="text" name="linkedin" class="form-control" value="{{ old('linkedin', $doctor->linkedin) }}">
                </div>
            </div>

            <div class="form-group">
                <label>Change Image</label>
                <input type="file" name="image" class="form-control-file" accept="image/*">
            </div>

            <button class="btn btn-primary">Update</button>
            <a href="{{ route('admin.doctors.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection

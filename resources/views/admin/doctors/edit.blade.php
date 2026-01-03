@extends('admin.layouts.app')

@section('title', 'Edit Doctor')
@section('page_title', 'Edit Doctor')

@section('page_actions')
    <a href="{{ route('admin.doctors.index') }}" class="btn btn-sm btn-secondary">Back</a>
@endsection

@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Doctor</h6>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.doctors.update', $doctor) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Name</label>
                <input class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $doctor->name) }}">
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label>Specialty</label>
                <input class="form-control @error('specialty') is-invalid @enderror" name="specialty" value="{{ old('specialty', $doctor->specialty) }}">
                @error('specialty') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label>Department</label>
                <select class="form-control @error('department_id') is-invalid @enderror" name="department_id">
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}" {{ old('department_id', $doctor->department_id) == $department->id ? 'selected' : '' }}>
                            {{ $department->name }}
                        </option>
                    @endforeach
                </select>
                @error('department_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label>Bio (optional)</label>
                <textarea class="form-control @error('bio') is-invalid @enderror" name="bio" rows="4">{{ old('bio', $doctor->bio) }}</textarea>
                @error('bio') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Facebook</label>
                    <input class="form-control" name="facebook" value="{{ old('facebook', $doctor->facebook) }}">
                </div>
                <div class="form-group col-md-6">
                    <label>Twitter</label>
                    <input class="form-control" name="twitter" value="{{ old('twitter', $doctor->twitter) }}">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Instagram</label>
                    <input class="form-control" name="instagram" value="{{ old('instagram', $doctor->instagram) }}">
                </div>
                <div class="form-group col-md-6">
                    <label>LinkedIn</label>
                    <input class="form-control" name="linkedin" value="{{ old('linkedin', $doctor->linkedin) }}">
                </div>
            </div>

            <div class="form-group">
                <label>Current Image</label><br>
                @if($doctor->image)
                    <img src="{{ asset('storage/'.$doctor->image) }}" width="120" style="object-fit:cover;border-radius:10px;">
                @else
                    <span class="text-muted">No image</span>
                @endif
            </div>

            <div class="form-group">
                <label>Change Image (optional)</label>
                <input type="file" class="form-control-file @error('image') is-invalid @enderror" name="image">
                @error('image') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
            </div>

            <button class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

@endsection

@extends('admin.layouts.app')

@section('title', 'Add FAQ')

@section('content')
<h1 class="h3 mb-3 text-gray-800">Add FAQ</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
        </ul>
    </div>
@endif

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('admin.faqs.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Order (sort_order) *</label>
                <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}" required min="0">
            </div>

            <div class="form-group">
                <label>Question *</label>
                <input type="text" name="question" class="form-control" value="{{ old('question') }}" required>
            </div>

            <div class="form-group">
                <label>Answer *</label>
                <textarea name="answer" class="form-control" rows="5" required>{{ old('answer') }}</textarea>
            </div>

            <button class="btn btn-primary">Save</button>
            <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection

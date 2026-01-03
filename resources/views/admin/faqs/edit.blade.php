@extends('admin.layouts.app')

@section('title', 'Edit FAQ')
@section('page_title', 'Edit FAQ')

@section('page_actions')
    <a href="{{ route('admin.faqs.index') }}" class="btn btn-sm btn-secondary">Back</a>
@endsection

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit FAQ</h6>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.faqs.update', $faq) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Question</label>
                    <input class="form-control @error('question') is-invalid @enderror"
                           name="question" value="{{ old('question', $faq->question) }}">
                    @error('question') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Answer</label>
                    <textarea class="form-control @error('answer') is-invalid @enderror"
                              name="answer" rows="5">{{ old('answer', $faq->answer) }}</textarea>
                    @error('answer') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Sort Order</label>
                    <input type="number" class="form-control @error('sort_order') is-invalid @enderror"
                           name="sort_order" value="{{ old('sort_order', $faq->sort_order) }}">
                    @error('sort_order') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <button class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>

@endsection

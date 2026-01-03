@extends('admin.layouts.app')

@section('title', $title ?? 'Page')
@section('page_title', $title ?? 'Page')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <h5 class="mb-2">{{ $title ?? 'Page' }}</h5>
            <p class="text-muted mb-0">
                Placeholder page from SB Admin 2 template (safe page to prevent errors).
            </p>
        </div>
    </div>
@endsection

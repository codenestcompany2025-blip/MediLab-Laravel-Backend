@extends('admin.layouts.app')

@section('title', 'FAQs')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0 text-gray-800">FAQs</h1>
    <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary btn-sm">
        <i class="fas fa-plus"></i> Add FAQ
    </a>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow mb-4">
    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover mb-0">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Order</th>
                    <th>Question</th>
                    <th style="width:140px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($faqs as $faq)
                    <tr>
                        <td>{{ ($faqs->currentPage() - 1) * $faqs->perPage() + $loop->iteration }}</td>
                        <td><span class="badge badge-info">{{ $faq->sort_order }}</span></td>
                        <td>{{ $faq->question }}</td>
                        <td>
                            <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn btn-sm btn-warning">
                                Edit
                            </a>
                            <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this FAQ?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center text-muted">No FAQs found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{ $faqs->links() }}
@endsection

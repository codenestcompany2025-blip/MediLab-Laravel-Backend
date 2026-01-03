@extends('admin.layouts.app')

@section('title', 'FAQs')
@section('page_title', 'FAQs')

@section('page_actions')
    <a href="{{ route('admin.faqs.create') }}" class="btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Add FAQ
    </a>
@endsection

@section('content')

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">FAQs List</h6>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Question</th>
                    <th>Order</th>
                    <th width="180">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($faqs as $faq)
                    <tr>
                        <td>{{ $faq->id }}</td>
                        <td>{{ $faq->question }}</td>
                        <td>{{ $faq->sort_order }}</td>
                        <td>
                            <a class="btn btn-sm btn-warning" href="{{ route('admin.faqs.edit', $faq) }}">Edit</a>

                            <form class="d-inline" method="POST" action="{{ route('admin.faqs.destroy', $faq) }}"
                                  onsubmit="return confirm('Delete this FAQ?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center text-muted">No FAQs found.</td></tr>
                @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $faqs->links() }}
            </div>
        </div>
    </div>

@endsection

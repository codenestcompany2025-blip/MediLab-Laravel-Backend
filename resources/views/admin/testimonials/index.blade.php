@extends('admin.layouts.app')

@section('title', 'Testimonials')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0 text-gray-800">Testimonials</h1>
    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add Testimonial
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Job Title</th>
                        <th>Comment</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($testimonials as $t)
                    <tr>
                        <td>
                            {{ ($testimonials->currentPage() - 1) * $testimonials->perPage() + $loop->iteration }}
                        </td>

                        <td style="width:140px">
                            @if($t->image)
                                <img
                                src="{{ $t->image ? asset('storage/'.$t->image) : asset('admin/img/undraw_posting_photo.svg') }}"
                                alt="testimonial"
                                style="width:80px;height:80px;object-fit:cover;border-radius:50%;"
                            >
                                <span style="display:none;color:#999;">Image not found</span>
                            @else
                                <span class="text-muted">No image</span>
                            @endif
                        </td>

                        <td>{{ $t->name }}</td>
                        <td>{{ $t->job_title }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($t->comment, 80) }}</td>

                        <td style="width:180px">
                            <a href="{{ route('admin.testimonials.edit', $t) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('admin.testimonials.destroy', $t) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Delete?')" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">No testimonials found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $testimonials->links() }}
        </div>
    </div>
</div>
@endsection

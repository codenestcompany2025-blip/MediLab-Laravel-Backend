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
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th style="width:70px;">#</th>
                        <th style="width:120px;">Image</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th style="width:260px;">Message</th>
                        <th style="width:180px;">Actions</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($testimonials as $t)
                    <tr>
                        <td>
                            {{ ($testimonials->currentPage() - 1) * $testimonials->perPage() + $loop->iteration }}
                        </td>

                        <td>
                            @if(!empty($t->image))
                                <img
                                    src="{{ asset('storage/'.$t->image) }}"
                                    alt="testimonial"
                                    style="width:70px;height:70px;object-fit:cover;border-radius:50%;"
                                >
                            @else
                                <img
                                    src="{{ asset('admin/img/undraw_posting_photo.svg') }}"
                                    alt="no image"
                                    style="width:70px;height:70px;object-fit:cover;border-radius:50%;"
                                >
                            @endif
                        </td>

                        <td>{{ $t->name }}</td>
                        <td>{{ $t->job_title }}</td>
                        <td style="max-width:260px;">
                            {{ \Illuminate\Support\Str::limit($t->comment, 80) }}
                        </td>

                        <td>
                            <a href="{{ route('admin.testimonials.edit', $t) }}" class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('admin.testimonials.destroy', $t) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Delete this testimonial?')" class="btn btn-danger btn-sm">
                                    Delete
                                </button>
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

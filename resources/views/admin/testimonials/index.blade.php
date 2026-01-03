@extends('admin.layouts.app')

@section('title', 'Testimonials')
@section('page_title', 'Testimonials')

@section('page_actions')
    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Add Testimonial
    </a>
@endsection

@section('content')

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Testimonials List</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Job Title</th>
                        <th>Comment</th>
                        <th width="180">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($testimonials as $testimonial)
                        <tr>
                            <td>{{ $testimonial->id }}</td>
                            <td>
                                @if($testimonial->image)
                                    <img src="{{ asset('storage/'.$testimonial->image) }}" width="60" height="60"
                                         style="object-fit:cover;border-radius:8px;">
                                @else
                                    <span class="text-muted">No image</span>
                                @endif
                            </td>
                            <td>{{ $testimonial->name }}</td>
                            <td>{{ $testimonial->job_title }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($testimonial->comment, 80) }}</td>
                            <td>
                                <a href="{{ route('admin.testimonials.edit', $testimonial) }}"
                                   class="btn btn-sm btn-warning">
                                    Edit
                                </a>

                                <form action="{{ route('admin.testimonials.destroy', $testimonial) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Are you sure you want to delete this testimonial?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" type="submit">
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

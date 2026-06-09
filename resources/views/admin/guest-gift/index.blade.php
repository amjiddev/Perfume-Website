@extends('layout.master')

@section('content')
<x-default-layout>

    @section('title')
        Guest Gift Management
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('dashboard') }}
    @endsection

    <div class="row">
        <div class="col-md-10 offset-md-1">
            <!-- Guest Gift Management Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Guest Gift Management</h5>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th style="display: flex; justify-content: space-between; align-items: center;">
                                        Actions
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addGiftModal" style="margin-right: 80px;">
                                            <i class="bx bx-plus me-2"></i>Add Gift
                                        </button>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($guestGifts as $gift)
                                    <tr>
                                        <td>
                                            @if($gift->image)
                                                <img src="{{ asset($gift->image) }}" alt="{{ $gift->title }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                                            @else
                                                <span class="badge bg-secondary">No Image</span>
                                            @endif
                                        </td>
                                        <td>{{ $gift->title }}</td>
                                        <td>
                                            @if($gift->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-secondary">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editGiftModal{{ $gift->id }}">
                                                Edit
                                            </button>
                                            <form action="{{ route('admin.guest-gift.delete', $gift) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">
                                            No guest gifts found. <a href="#" data-bs-toggle="modal" data-bs-target="#addGiftModal">Add one</a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                    <i class="bx bx-arrow-back me-2"></i>Back
                </a>
            </div>
        </div>
    </div>

    <!-- Add Gift Modal -->
    <div class="modal fade" id="addGiftModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Guest Gift</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.guest-gift.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="modal-body" style="padding: 1rem;">
                        <div class="mb-3">
                            <label for="title" class="form-label">Gift Title *</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Gift Image *</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*" required>
                            @error('image')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" checked>
                                <label class="form-check-label" for="is_active">
                                    Active
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Gift</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Gift Modals -->
    @foreach($guestGifts as $gift)
        <div class="modal fade" id="editGiftModal{{ $gift->id }}" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Guest Gift</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('admin.guest-gift.update', $gift) }}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="modal-body" style="padding: 1rem;">
                            <div class="mb-3">
                                <label for="title{{ $gift->id }}" class="form-label">Gift Title *</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title{{ $gift->id }}" name="title" value="{{ old('title', $gift->title) }}" required>
                                @error('title')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="image{{ $gift->id }}" class="form-label">Gift Image</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image{{ $gift->id }}" name="image" accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                @if($gift->image)
                                    <div class="mt-2">
                                        <small class="text-muted">Current image:</small>
                                        <img src="{{ asset($gift->image) }}" alt="{{ $gift->title }}" style="max-width: 100px; max-height: 100px; border-radius: 4px;">
                                    </div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_active{{ $gift->id }}" name="is_active" {{ $gift->is_active ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active{{ $gift->id }}">
                                        Active
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update Gift</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

</x-default-layout>
@endsection

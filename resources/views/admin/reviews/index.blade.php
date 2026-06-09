@extends('layout.master')
@section('content')
<x-default-layout>
@section('title')
Reviews Management
@endsection
@section('breadcrumbs')
{{ Breadcrumbs::render('dashboard') }}
@endsection
<div class="row">
<div class="col-md-10 offset-md-1">
<div class="card mb-4">
<div class="card-header">
<h5 class="card-title mb-0">Reviews Management</h5>
</div>
<div class="card-body">
<div class="d-flex justify-content-between align-items-center mb-3">
<h6 class="card-title mb-0">All Reviews</h6>
<button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addReviewModal">Add Review</button>
</div>
<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr>
<th>Image</th>
<th>Author</th>
<th>Email</th>
<th>Rating</th>
<th>Review Text</th>
<th>Display Section</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
@forelse($reviews as $review)
<tr>
<td>
@if($review->image)
<img src="{{ asset($review->image) }}" alt="{{ $review->author }}" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
@else
<span class="badge bg-secondary">No Image</span>
@endif
</td>
<td>{{ $review->author }}</td>
<td>{{ $review->email }}</td>
<td>
<div class="rating">
@for($i = 0; $i < floor($review->rating); $i++)
<i class="fas fa-star" style="color: #ffc107;"></i>
@endfor
@if($review->rating % 1 != 0)
<i class="fas fa-star-half-alt" style="color: #ffc107;"></i>
@endif
</div>
</td>
<td>
<small>{{ Str::limit($review->text, 50) }}</small>
</td>
<td>
@if($review->display_section === 'home')
<span class="badge bg-info">Home Page</span>
@elseif($review->display_section === 'attar')
<span class="badge bg-warning">Attar Page</span>
@else
<span class="badge bg-success">Both Pages</span>
@endif
</td>
<td>
<div class="d-flex gap-2">
<button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editReviewModal{{ $review->id }}">Edit</button>
<form action="{{ route('admin.reviews.delete', $review) }}" method="POST">
@csrf
@method('DELETE')
<button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
</form>
</div>
</td>
</tr>
@empty
<tr>
<td colspan="7" class="text-center text-muted py-4">No reviews found.</td>
</tr>
@endforelse
</tbody>
</table>
</div>
</div>
</div>
<div class="d-flex gap-2 mt-4">
<a href="{{ route('dashboard') }}" class="btn btn-secondary">Back</a>
</div>
</div>
</div>

<!-- Add Review Modal -->
<div class="modal fade" id="addReviewModal" tabindex="-1">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Add New Review</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>
<form id="addReviewForm" action="{{ route('admin.reviews.store') }}" method="POST" enctype="multipart/form-data" novalidate>
@csrf
<div class="modal-body">
<div class="mb-3">
<label for="author" class="form-label">Author Name *</label>
<input type="text" class="form-control" id="author" name="author" value="{{ old('author') }}" required>
</div>
<div class="mb-3">
<label for="email" class="form-label">Email Address *</label>
<input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
</div>
<div class="mb-3">
<label for="rating" class="form-label">Rating (0-5) *</label>
<input type="number" step="0.5" min="0" max="5" class="form-control" id="rating" name="rating" value="{{ old('rating', 5) }}" required>
</div>
<div class="mb-3">
<label for="image" class="form-label">Profile Image</label>
<input type="file" class="form-control" id="image" name="image">
</div>
<div class="mb-3">
<label for="text" class="form-label">Review Text *</label>
<textarea class="form-control" id="text" name="text" rows="4" required>{{ old('text') }}</textarea>
</div>
<div class="mb-3">
<label for="display_section" class="form-label">Display Section *</label>
<select class="form-select" id="display_section" name="display_section" required>
<option value="">Select Display Section</option>
<option value="home">Show Only on Home Page</option>
<option value="attar">Show Only on Attar Page</option>
<option value="both">Show on Both Pages</option>
</select>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary">Add Review</button>
</div>
</form>
</div>
</div>
</div>

<!-- Edit Review Modals -->
@foreach($reviews as $review)
<div class="modal fade" id="editReviewModal{{ $review->id }}" tabindex="-1">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Edit Review</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>
<form id="editReviewForm{{ $review->id }}" action="{{ route('admin.reviews.update', $review) }}" method="POST" enctype="multipart/form-data" novalidate>
@csrf
@method('PUT')
<div class="modal-body">
<div class="mb-3">
<label for="author{{ $review->id }}" class="form-label">Author Name *</label>
<input type="text" class="form-control" id="author{{ $review->id }}" name="author" value="{{ old('author', $review->author) }}" required>
</div>
<div class="mb-3">
<label for="email{{ $review->id }}" class="form-label">Email Address *</label>
<input type="email" class="form-control" id="email{{ $review->id }}" name="email" value="{{ old('email', $review->email) }}" required>
</div>
<div class="mb-3">
<label for="rating{{ $review->id }}" class="form-label">Rating (0-5) *</label>
<input type="number" step="0.5" min="0" max="5" class="form-control" id="rating{{ $review->id }}" name="rating" value="{{ old('rating', $review->rating) }}" required>
</div>
<div class="mb-3">
<label for="image{{ $review->id }}" class="form-label">Profile Image</label>
<input type="file" class="form-control" id="image{{ $review->id }}" name="image">
@if($review->image)
<div class="mt-2">
<small class="text-muted">Current image:</small>
<img src="{{ asset($review->image) }}" alt="{{ $review->author }}" style="max-width: 100px; border-radius: 50%;">
</div>
@endif
</div>
<div class="mb-3">
<label for="text{{ $review->id }}" class="form-label">Review Text *</label>
<textarea class="form-control" id="text{{ $review->id }}" name="text" rows="4" required>{{ old('text', $review->text) }}</textarea>
</div>
<div class="mb-3">
<label for="display_section{{ $review->id }}" class="form-label">Display Section *</label>
<select class="form-select" id="display_section{{ $review->id }}" name="display_section" required>
<option value="home" @if(old('display_section', $review->display_section) === 'home') selected @endif>Show Only on Home Page</option>
<option value="attar" @if(old('display_section', $review->display_section) === 'attar') selected @endif>Show Only on Attar Page</option>
<option value="both" @if(old('display_section', $review->display_section) === 'both') selected @endif>Show on Both Pages</option>
</select>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary">Update Review</button>
</div>
</form>
</div>
</div>
</div>
@endforeach
</x-default-layout>
@endsection

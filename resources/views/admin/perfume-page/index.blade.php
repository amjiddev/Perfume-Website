@extends('layout.master')
@section('content')
<x-default-layout>
@section('title')
Perfume Page Settings
@endsection
@section('breadcrumbs')
{{ Breadcrumbs::render('dashboard') }}
@endsection
<div class="row">
<div class="col-md-10 offset-md-1">
<div class="card mb-4">
<div class="card-header">
<h5 class="card-title mb-0">Perfume Page Settings</h5>
</div>
<div class="card-body">
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
{{ session('success') }}
<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif
@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
<ul class="mb-0">
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif
<form action="{{ route('admin.perfume-page.update') }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')
<div class="card mb-4">
<div class="card-header">
<h6 class="card-title mb-0">Hero Section</h6>
</div>
<div class="card-body">
<div class="mb-3">
<label for="hero_heading" class="form-label">Hero Heading</label>
<input type="text" class="form-control" id="hero_heading" name="hero_heading" value="{{ old('hero_heading', $perfumePage->hero_heading) }}">
</div>
<div class="mb-3">
<label for="hero_subheading" class="form-label">Hero Subheading</label>
<textarea class="form-control" id="hero_subheading" name="hero_subheading" rows="3">{{ old('hero_subheading', $perfumePage->hero_subheading) }}</textarea>
</div>
<div class="mb-3">
<label for="hero_image" class="form-label">Hero Background Image</label>
<input type="file" class="form-control" id="hero_image" name="hero_image" accept="image/*">
@if($perfumePage->hero_image)
<div class="mt-2">
<small class="text-muted">Current image:</small>
<img src="{{ asset($perfumePage->hero_image) }}" alt="Hero" style="max-width: 200px;">
</div>
@endif
</div>
</div>
</div>
<div class="card mb-4">
<div class="card-header">
<h6 class="card-title mb-0">Best Sellers Section</h6>
</div>
<div class="card-body">
<div class="mb-3">
<label for="best_sellers_subtitle" class="form-label">Subtitle</label>
<input type="text" class="form-control" id="best_sellers_subtitle" name="best_sellers_subtitle" value="{{ old('best_sellers_subtitle', $perfumePage->best_sellers_subtitle) }}">
</div>
<div class="mb-3">
<label for="best_sellers_title" class="form-label">Title</label>
<input type="text" class="form-control" id="best_sellers_title" name="best_sellers_title" value="{{ old('best_sellers_title', $perfumePage->best_sellers_title) }}">
</div>
</div>
</div>

<button type="submit" class="btn btn-primary">Save Changes</button>
</form>
<div class="mt-5 pt-4 border-top">
<div class="d-flex justify-content-between align-items-center mb-3">
<h6 class="card-title mb-0">Manage Perfumes</h6>
<button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addPerfumeModal">Add Perfume</button>
</div>
<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr>
<th>Image</th>
<th>Name</th>
<th>Category</th>
<th>Price</th>
<th>Discount</th>
<th>Rating</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
@forelse($perfumes as $perfume)
<tr>
<td>
@if($perfume->image)
<img src="{{ asset($perfume->image) }}" alt="{{ $perfume->name }}" style="width: 50px; height: 50px; object-fit: cover;">
@else
<span class="badge bg-secondary">No Image</span>
@endif
</td>
<td>{{ $perfume->name }}</td>
<td><span class="badge bg-info">{{ ucfirst($perfume->category) }}</span></td>
<td>Rs {{ number_format($perfume->price ?? $perfume->original_price, 0) }}</td>
<td>
@if($perfume->discount_percentage)
<span class="badge bg-danger">-{{ $perfume->discount_percentage }}%</span>
@else
<span class="text-muted">-</span>
@endif
</td>
<td>
<div class="rating">
@for($i = 0; $i < floor($perfume->rating); $i++)
<i class="fas fa-star" style="color: #ffc107;"></i>
@endfor
<small>({{ $perfume->reviews_count }})</small>
</div>
</td>
<td>
<button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editPerfumeModal{{ $perfume->id }}">Edit</button>
<form action="{{ route('admin.perfume-page.delete-perfume', $perfume) }}" method="POST" style="display: inline;">
@csrf
@method('DELETE')
<button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
</form>
</td>
</tr>
@empty
<tr>
<td colspan="7" class="text-center text-muted py-4">No perfumes found.</td>
</tr>
@endforelse
</tbody>
</table>
</div>
</div>
</div>
</div>
<div class="d-flex gap-2 mt-4">
<a href="{{ route('dashboard') }}" class="btn btn-secondary">Back</a>
</div>
</div>
</div>
<div class="modal fade" id="addPerfumeModal" tabindex="-1">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Add New Perfume</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>
<form id="addPerfumeForm" action="{{ route('admin.perfume-page.store-perfume') }}" method="POST" enctype="multipart/form-data" novalidate>
@csrf
<div class="modal-body">
<div class="row">
<div class="col-md-6 mb-3">
<label for="name" class="form-label">Perfume Name *</label>
<input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
</div>
<div class="col-md-6 mb-3">
<label for="category" class="form-label">Category *</label>
<select class="form-select" id="category" name="category" required>
<option value="">Select Category</option>
<option value="men">For Men</option>
<option value="women">For Women</option>
<option value="unisex">Unisex</option>
<option value="arabic">Arabic Perfumes</option>
</select>
</div>
</div>
<div class="mb-3">
<label for="description" class="form-label">Description</label>
<textarea class="form-control" id="description" name="description" rows="2">{{ old('description') }}</textarea>
</div>
<div class="row">
<div class="col-md-4 mb-3">
<label for="price" class="form-label">Sale Price (Rs)</label>
<input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}">
@error('price')
<div class="invalid-feedback d-block">{{ $message }}</div>
@enderror
</div>
<div class="col-md-4 mb-3">
<label for="original_price" class="form-label">Original Price (Rs)</label>
<input type="number" step="0.01" class="form-control" id="original_price" name="original_price" value="{{ old('original_price') }}">
</div>
<div class="col-md-4 mb-3">
<label for="discount_percentage" class="form-label">Discount % (Auto)</label>
<input type="number" class="form-control" id="discount_percentage" name="discount_percentage" readonly>
</div>
</div>
<div class="row">
<div class="col-md-6 mb-3">
<label for="rating" class="form-label">Rating (0-5)</label>
<input type="number" step="0.1" min="0" max="5" class="form-control" id="rating" name="rating" value="{{ old('rating', 4.5) }}">
</div>
<div class="col-md-6 mb-3">
<label for="reviews_count" class="form-label">Reviews Count</label>
<input type="number" min="0" class="form-control" id="reviews_count" name="reviews_count" value="{{ old('reviews_count', 0) }}">
</div>
</div>
<div class="mb-3">
<label for="display_section" class="form-label">Display Section *</label>
<select class="form-select" id="display_section" name="display_section" required>
<option value="">Select Display Section</option>
<option value="perfume">Only Show in Perfume Section</option>
<option value="best_seller">Only Show in Best Seller Section</option>
<option value="both">Show in Both Sections</option>
</select>
</div>
<div class="mb-3">
<label for="image" class="form-label">Perfume Image</label>
<input type="file" class="form-control" id="image" name="image" accept="image/*">
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary">Add Perfume</button>
</div>
</form>
</div>
</div>
</div>
@foreach($perfumes as $perfume)
<div class="modal fade" id="editPerfumeModal{{ $perfume->id }}" tabindex="-1">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title">Edit Perfume</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>
<form id="editPerfumeForm{{ $perfume->id }}" action="{{ route('admin.perfume-page.update-perfume', $perfume) }}" method="POST" enctype="multipart/form-data" novalidate>
@csrf
@method('PUT')
<div class="modal-body">
<div class="row">
<div class="col-md-6 mb-3">
<label for="name{{ $perfume->id }}" class="form-label">Perfume Name *</label>
<input type="text" class="form-control" id="name{{ $perfume->id }}" name="name" value="{{ old('name', $perfume->name) }}" required>
</div>
<div class="col-md-6 mb-3">
<label for="category{{ $perfume->id }}" class="form-label">Category *</label>
<select class="form-select" id="category{{ $perfume->id }}" name="category" required>
<option value="men" @if(old('category', $perfume->category) == 'men') selected @endif>For Men</option>
<option value="women" @if(old('category', $perfume->category) == 'women') selected @endif>For Women</option>
<option value="unisex" @if(old('category', $perfume->category) == 'unisex') selected @endif>Unisex</option>
<option value="arabic" @if(old('category', $perfume->category) == 'arabic') selected @endif>Arabic Perfumes</option>
</select>
</div>
</div>
<div class="mb-3">
<label for="description{{ $perfume->id }}" class="form-label">Description</label>
<textarea class="form-control" id="description{{ $perfume->id }}" name="description" rows="2">{{ old('description', $perfume->description) }}</textarea>
</div>
<div class="row">
<div class="col-md-4 mb-3">
<label for="price{{ $perfume->id }}" class="form-label">Sale Price (Rs)</label>
<input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price{{ $perfume->id }}" name="price" value="{{ old('price', $perfume->price) }}">
@error('price')
<div class="invalid-feedback d-block">{{ $message }}</div>
@enderror
</div>
<div class="col-md-4 mb-3">
<label for="original_price{{ $perfume->id }}" class="form-label">Original Price (Rs)</label>
<input type="number" step="0.01" class="form-control" id="original_price{{ $perfume->id }}" name="original_price" value="{{ old('original_price', $perfume->original_price) }}">
</div>
<div class="col-md-4 mb-3">
<label for="discount_percentage{{ $perfume->id }}" class="form-label">Discount % (Auto)</label>
<input type="number" class="form-control" id="discount_percentage{{ $perfume->id }}" name="discount_percentage" value="{{ old('discount_percentage', $perfume->discount_percentage) }}" readonly>
</div>
</div>
<div class="row">
<div class="col-md-6 mb-3">
<label for="rating{{ $perfume->id }}" class="form-label">Rating (0-5)</label>
<input type="number" step="0.1" min="0" max="5" class="form-control" id="rating{{ $perfume->id }}" name="rating" value="{{ old('rating', $perfume->rating) }}">
</div>
<div class="col-md-6 mb-3">
<label for="reviews_count{{ $perfume->id }}" class="form-label">Reviews Count</label>
<input type="number" min="0" class="form-control" id="reviews_count{{ $perfume->id }}" name="reviews_count" value="{{ old('reviews_count', $perfume->reviews_count) }}">
</div>
</div>
<div class="mb-3">
<label for="display_section{{ $perfume->id }}" class="form-label">Display Section *</label>
<select class="form-select" id="display_section{{ $perfume->id }}" name="display_section" required>
<option value="perfume" @if(old('display_section', $perfume->display_section) == 'perfume') selected @endif>Only Show in Perfume Section</option>
<option value="best_seller" @if(old('display_section', $perfume->display_section) == 'best_seller') selected @endif>Only Show in Best Seller Section</option>
<option value="both" @if(old('display_section', $perfume->display_section) == 'both') selected @endif>Show in Both Sections</option>
</select>
</div>
<div class="mb-3">
<label for="image{{ $perfume->id }}" class="form-label">Perfume Image</label>
<input type="file" class="form-control" id="image{{ $perfume->id }}" name="image" accept="image/*">
@if($perfume->image)
<div class="mt-2">
<small class="text-muted">Current image:</small>
<img src="{{ asset($perfume->image) }}" alt="{{ $perfume->name }}" style="max-width: 100px;">
</div>
@endif
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary">Update Perfume</button>
</div>
</form>
</div>
</div>
</div>
@endforeach
</x-default-layout>
@endsection
<script>
document.addEventListener('DOMContentLoaded', function() {
const addForm = document.getElementById('addPerfumeForm');
const editForms = document.querySelectorAll('[id^="editPerfumeForm"]');

if (addForm) {
addForm.addEventListener('submit', function(e) {
if (!validateForm(this)) {
e.preventDefault();
e.stopPropagation();
return false;
}
});
}

editForms.forEach(form => {
form.addEventListener('submit', function(e) {
if (!validateForm(this)) {
e.preventDefault();
e.stopPropagation();
return false;
}
});
});
});

function validateForm(form) {
let isValid = true;
const nameInput = form.querySelector('input[name="name"]');
const categoryInput = form.querySelector('select[name="category"]');
const priceInput = form.querySelector('input[name="price"]');
const originalPriceInput = form.querySelector('input[name="original_price"]');

// Clear previous error states
priceInput.classList.remove('is-invalid');
const existingError = priceInput.parentElement.querySelector('.invalid-feedback');
if (existingError) {
existingError.remove();
}

if (!nameInput.value.trim()) {
isValid = false;
}

if (!categoryInput.value) {
isValid = false;
}

const price = parseFloat(priceInput.value) || 0;
const originalPrice = parseFloat(originalPriceInput.value) || 0;

if (originalPrice > 0 && price > 0 && originalPrice <= price) {
isValid = false;
priceInput.classList.add('is-invalid');
const errorDiv = document.createElement('div');
errorDiv.className = 'invalid-feedback d-block';
errorDiv.textContent = 'Sale price must be less than original price.';
priceInput.parentElement.appendChild(errorDiv);
}

return isValid;
}

const priceInput = document.getElementById('price');
const originalPriceInput = document.getElementById('original_price');
const discountInput = document.getElementById('discount_percentage');

if (priceInput && originalPriceInput && discountInput) {
const calculateDiscount = () => {
const salePrice = parseFloat(priceInput.value) || 0;
const originalPrice = parseFloat(originalPriceInput.value) || 0;
if (originalPrice > 0 && salePrice > 0) {
const discount = ((originalPrice - salePrice) / originalPrice) * 100;
discountInput.value = Math.round(discount);
} else {
discountInput.value = '';
}
};
originalPriceInput.addEventListener('input', calculateDiscount);
priceInput.addEventListener('input', calculateDiscount);
}
</script>

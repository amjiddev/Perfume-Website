@extends('layout.master')

@section('content')
<x-default-layout>

    @section('title')
        Shop Page Settings
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('dashboard') }}
    @endsection

    <div class="row">
        <div class="col-md-10 offset-md-1">
            <!-- Shop Page Settings Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Shop Page Settings</h5>
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

                    <form action="{{ route('admin.shop-page.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Hero Section -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Hero Section</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="hero_heading" class="form-label">Hero Heading</label>
                                    <input type="text" class="form-control @error('hero_heading') is-invalid @enderror" 
                                           id="hero_heading" name="hero_heading" 
                                           value="{{ old('hero_heading', $shopPage->hero_heading) }}" placeholder="e.g., Our Collection">
                                    @error('hero_heading')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="hero_subheading" class="form-label">Hero Subheading</label>
                                    <textarea class="form-control @error('hero_subheading') is-invalid @enderror" 
                                              id="hero_subheading" name="hero_subheading" rows="3">{{ old('hero_subheading', $shopPage->hero_subheading) }}</textarea>
                                    @error('hero_subheading')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="hero_image" class="form-label">Hero Background Image</label>
                                    <input type="file" class="form-control @error('hero_image') is-invalid @enderror" 
                                           id="hero_image" name="hero_image" accept="image/*">
                                    @error('hero_image')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    @if($shopPage->hero_image)
                                        <div class="mt-2">
                                            <small class="text-muted">Current image:</small>
                                            <img src="{{ asset($shopPage->hero_image) }}" alt="Hero" style="max-width: 200px; max-height: 150px;">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="d-flex gap-2 mb-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-save me-2"></i>Save Changes
                            </button>
                        </div>
                    </form>

                    <!-- Products Management Section -->
                    <div class="mt-5 pt-4 border-top">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="card-title mb-0">Manage Products</h6>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addProductModal">
                                <i class="bx bx-plus me-2"></i>Add Product
                            </button>
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
                                    @forelse($products as $product)
                                        <tr>
                                            <td>
                                                @if($product->image)
                                                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                                                @else
                                                    <span class="badge bg-secondary">No Image</span>
                                                @endif
                                            </td>
                                            <td>{{ $product->name }}</td>
                                            <td>
                                                <span class="badge bg-info">{{ ucfirst($product->category) }}</span>
                                            </td>
                                            <td>Rs {{ number_format($product->price, 0) }}</td>
                                            <td>
                                                @if($product->discount_percentage)
                                                    <span class="badge bg-danger">-{{ $product->discount_percentage }}%</span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="rating">
                                                    @for($i = 0; $i < floor($product->rating); $i++)
                                                        <i class="fas fa-star" style="color: #ffc107;"></i>
                                                    @endfor
                                                    @if($product->rating % 1 != 0)
                                                        <i class="fas fa-star-half-alt" style="color: #ffc107;"></i>
                                                    @endif
                                                    <small>({{ $product->reviews_count }})</small>
                                                </div>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editProductModal{{ $product->id }}">
                                                     Edit
                                                </button>
                                                <form action="{{ route('admin.shop-page.delete-product', $product) }}" method="POST" style="display: inline;">
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
                                            <td colspan="7" class="text-center text-muted py-4">
                                                No products found. <a href="#" data-bs-toggle="modal" data-bs-target="#addProductModal">Add one</a>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
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

    <!-- Add Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.shop-page.store-product') }}" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Product Name *</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="category" class="form-label">Category *</label>
                                <select class="form-select @error('category') is-invalid @enderror" id="category" name="category" required>
                                    <option value="">Select Category</option>
                                    <option value="men" {{ old('category') == 'men' ? 'selected' : '' }}>For Men</option>
                                    <option value="women" {{ old('category') == 'women' ? 'selected' : '' }}>For Women</option>
                                    <option value="unisex" {{ old('category') == 'unisex' ? 'selected' : '' }}>Unisex</option>
                                    <option value="arabic" {{ old('category') == 'arabic' ? 'selected' : '' }}>Arabic Perfumes</option>
                                </select>
                                @error('category')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="2">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="price" class="form-label">Sale Price (Rs) *</label>
                                <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" required>
                                @error('price')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="original_price" class="form-label">Original Price (Rs)</label>
                                <input type="number" step="0.01" class="form-control @error('original_price') is-invalid @enderror" id="original_price" name="original_price" value="{{ old('original_price') }}">
                                @error('original_price')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="discount_percentage" class="form-label">Discount % (Auto)</label>
                                <input type="number" class="form-control" id="discount_percentage" name="discount_percentage" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="rating" class="form-label">Rating (0-5)</label>
                                <input type="number" step="0.1" min="0" max="5" class="form-control @error('rating') is-invalid @enderror" id="rating" name="rating" value="{{ old('rating', 4.5) }}">
                                @error('rating')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="reviews_count" class="form-label">Reviews Count</label>
                                <input type="number" min="0" class="form-control @error('reviews_count') is-invalid @enderror" id="reviews_count" name="reviews_count" value="{{ old('reviews_count', 0) }}">
                                @error('reviews_count')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Product Image</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Product Modals -->
    @foreach($products as $product)
        <div class="modal fade" id="editProductModal{{ $product->id }}" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('admin.shop-page.update-product', $product) }}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name{{ $product->id }}" class="form-label">Product Name *</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name{{ $product->id }}" name="name" value="{{ old('name', $product->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="category{{ $product->id }}" class="form-label">Category *</label>
                                    <select class="form-select @error('category') is-invalid @enderror" id="category{{ $product->id }}" name="category" required>
                                        <option value="men" {{ old('category', $product->category) == 'men' ? 'selected' : '' }}>For Men</option>
                                        <option value="women" {{ old('category', $product->category) == 'women' ? 'selected' : '' }}>For Women</option>
                                        <option value="unisex" {{ old('category', $product->category) == 'unisex' ? 'selected' : '' }}>Unisex</option>
                                        <option value="arabic" {{ old('category', $product->category) == 'arabic' ? 'selected' : '' }}>Arabic Perfumes</option>
                                    </select>
                                    @error('category')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="description{{ $product->id }}" class="form-label">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description{{ $product->id }}" name="description" rows="2">{{ old('description', $product->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="price{{ $product->id }}" class="form-label">Sale Price (Rs) *</label>
                                    <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price{{ $product->id }}" name="price" value="{{ old('price', $product->price) }}" required>
                                    @error('price')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="original_price{{ $product->id }}" class="form-label">Original Price (Rs)</label>
                                    <input type="number" step="0.01" class="form-control @error('original_price') is-invalid @enderror" id="original_price{{ $product->id }}" name="original_price" value="{{ old('original_price', $product->original_price) }}">
                                    @error('original_price')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="discount_percentage{{ $product->id }}" class="form-label">Discount % (Auto)</label>
                                    <input type="number" class="form-control" id="discount_percentage{{ $product->id }}" name="discount_percentage" value="{{ old('discount_percentage', $product->discount_percentage) }}" readonly>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="rating{{ $product->id }}" class="form-label">Rating (0-5)</label>
                                    <input type="number" step="0.1" min="0" max="5" class="form-control @error('rating') is-invalid @enderror" id="rating{{ $product->id }}" name="rating" value="{{ old('rating', $product->rating) }}">
                                    @error('rating')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="reviews_count{{ $product->id }}" class="form-label">Reviews Count</label>
                                    <input type="number" min="0" class="form-control @error('reviews_count') is-invalid @enderror" id="reviews_count{{ $product->id }}" name="reviews_count" value="{{ old('reviews_count', $product->reviews_count) }}">
                                    @error('reviews_count')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="image{{ $product->id }}" class="form-label">Product Image</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image{{ $product->id }}" name="image" accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                                @if($product->image)
                                    <div class="mt-2">
                                        <small class="text-muted">Current image:</small>
                                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" style="max-width: 100px; max-height: 100px; border-radius: 4px;">
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

</x-default-layout>
@endsection


<script>
// Keep modal open if there are validation errors
document.addEventListener('DOMContentLoaded', function() {
    @if ($errors->any())
        // Check if any error fields exist in the add product modal
        const addModalFields = ['name', 'category', 'price', 'original_price', 'description', 'rating', 'reviews_count', 'image'];
        let hasAddError = false;
        
        addModalFields.forEach(field => {
            if (document.getElementById(field) && document.getElementById(field).classList.contains('is-invalid')) {
                hasAddError = true;
            }
        });
        
        if (hasAddError) {
            const modal = new bootstrap.Modal(document.getElementById('addProductModal'));
            modal.show();
        }
        
        // Check edit modals
        @foreach($products as $product)
            const editFields{{ $product->id }} = ['name{{ $product->id }}', 'category{{ $product->id }}', 'price{{ $product->id }}', 'original_price{{ $product->id }}', 'description{{ $product->id }}', 'rating{{ $product->id }}', 'reviews_count{{ $product->id }}', 'image{{ $product->id }}'];
            let hasEditError{{ $product->id }} = false;
            
            editFields{{ $product->id }}.forEach(field => {
                if (document.getElementById(field) && document.getElementById(field).classList.contains('is-invalid')) {
                    hasEditError{{ $product->id }} = true;
                }
            });
            
            if (hasEditError{{ $product->id }}) {
                const editModal = new bootstrap.Modal(document.getElementById('editProductModal{{ $product->id }}'));
                editModal.show();
            }
        @endforeach
    @endif
});

// Auto-calculate discount percentage for Add Product Modal
const priceInput = document.getElementById('price');
const originalPriceInput = document.getElementById('original_price');
const discountInput = document.getElementById('discount_percentage');

if (priceInput && originalPriceInput && discountInput) {
    originalPriceInput.addEventListener('input', function() {
        const salePrice = parseFloat(priceInput.value) || 0;
        const originalPrice = parseFloat(this.value) || 0;
        
        if (originalPrice > 0 && salePrice > 0) {
            const discount = ((originalPrice - salePrice) / originalPrice) * 100;
            discountInput.value = Math.round(discount);
        } else {
            discountInput.value = '';
        }
    });

    priceInput.addEventListener('input', function() {
        const salePrice = parseFloat(this.value) || 0;
        const originalPrice = parseFloat(originalPriceInput.value) || 0;
        
        if (originalPrice > 0 && salePrice > 0) {
            const discount = ((originalPrice - salePrice) / originalPrice) * 100;
            discountInput.value = Math.round(discount);
        } else {
            discountInput.value = '';
        }
    });
}

// Auto-calculate discount for each edit modal
@foreach($products as $product)
    const editPrice{{ $product->id }} = document.getElementById('price{{ $product->id }}');
    const editOriginalPrice{{ $product->id }} = document.getElementById('original_price{{ $product->id }}');
    const editDiscount{{ $product->id }} = document.getElementById('discount_percentage{{ $product->id }}');
    
    if (editOriginalPrice{{ $product->id }} && editPrice{{ $product->id }} && editDiscount{{ $product->id }}) {
        editOriginalPrice{{ $product->id }}.addEventListener('input', function() {
            const salePrice = parseFloat(editPrice{{ $product->id }}.value) || 0;
            const originalPrice = parseFloat(this.value) || 0;
            
            if (originalPrice > 0 && salePrice > 0) {
                const discount = ((originalPrice - salePrice) / originalPrice) * 100;
                editDiscount{{ $product->id }}.value = Math.round(discount);
            } else {
                editDiscount{{ $product->id }}.value = '';
            }
        });

        editPrice{{ $product->id }}.addEventListener('input', function() {
            const salePrice = parseFloat(this.value) || 0;
            const originalPrice = parseFloat(editOriginalPrice{{ $product->id }}.value) || 0;
            
            if (originalPrice > 0 && salePrice > 0) {
                const discount = ((originalPrice - salePrice) / originalPrice) * 100;
                editDiscount{{ $product->id }}.value = Math.round(discount);
            } else {
                editDiscount{{ $product->id }}.value = '';
            }
        });
    }
@endforeach
</script>

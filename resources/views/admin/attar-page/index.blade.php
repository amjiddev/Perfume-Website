@extends('layout.master')
@section('content')
<x-default-layout>
@section('title')
Attar Page Settings
@endsection
@section('breadcrumbs')
{{ Breadcrumbs::render('dashboard') }}
@endsection
<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Attar Page Settings</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.attar-page.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Hero Section -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h6 class="card-title mb-0">Hero Section (4 Auto-Changing Images)</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="hero_heading" class="form-label">Hero Heading</label>
                                <input type="text" class="form-control @error('hero_heading') is-invalid @enderror" 
                                       id="hero_heading" name="hero_heading" 
                                       value="{{ old('hero_heading', $attarPage->hero_heading) }}" 
                                       placeholder="e.g., Premium Attar">
                                @error('hero_heading')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="hero_subheading" class="form-label">Hero Subheading</label>
                                <textarea class="form-control @error('hero_subheading') is-invalid @enderror" 
                                          id="hero_subheading" name="hero_subheading" rows="3">{{ old('hero_subheading', $attarPage->hero_subheading) }}</textarea>
                                @error('hero_subheading')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                @for($i = 1; $i <= 4; $i++)
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="hero_image_{{ $i }}" class="form-label">Hero Image {{ $i }}</label>
                                        <input type="file" class="form-control" id="hero_image_{{ $i }}" name="hero_image_{{ $i }}" accept="image/*">
                                        @php $heroImage = 'hero_image_' . $i; @endphp
                                        @if($attarPage->$heroImage)
                                        <div class="mt-2">
                                            <small class="text-muted">Current image:</small>
                                            <div style="position: relative; width: fit-content; margin-top: 0.5rem;">
                                                <img src="{{ asset($attarPage->$heroImage) }}" alt="Hero {{ $i }}" style="max-width: 200px; max-height: 150px; display: block;">
                                                <button type="button" class="btn btn-danger" onclick="deletePageImage('attar_page', '{{ $heroImage }}')" title="Remove image" style="position: absolute; top: -10px; right: -10px; padding: 0; border-radius: 50%; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; font-size: 20px; z-index: 10; border: 2px solid white; box-shadow: 0 2px 8px rgba(0,0,0,0.3);">
                                                    ×
                                                </button>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @endfor
                            </div>
                        </div>
                    </div>

                    <!-- Why Choose Attar Section -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h6 class="card-title mb-0">Why Choose Attar Section</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="why_choose_subtitle" class="form-label">Subtitle</label>
                                <input type="text" class="form-control @error('why_choose_subtitle') is-invalid @enderror" 
                                       id="why_choose_subtitle" name="why_choose_subtitle" 
                                       value="{{ old('why_choose_subtitle', $attarPage->why_choose_subtitle) }}"
                                       placeholder="e.g., BENEFITS">
                                @error('why_choose_subtitle')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="why_choose_title" class="form-label">Title</label>
                                <input type="text" class="form-control @error('why_choose_title') is-invalid @enderror" 
                                       id="why_choose_title" name="why_choose_title" 
                                       value="{{ old('why_choose_title', $attarPage->why_choose_title) }}"
                                       placeholder="e.g., Why Choose Attar?">
                                @error('why_choose_title')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="benefits_section_enabled" class="form-label">
                                    <input type="checkbox" id="benefits_section_enabled" name="benefits_section_enabled" value="1" 
                                           {{ old('benefits_section_enabled', $attarPage->benefits_section_enabled) ? 'checked' : '' }}>
                                    Enable Benefits Section
                                </label>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>

                <!-- Manage Attar Products -->
                <div class="mt-5 pt-4 border-top">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="card-title mb-0">Manage Attar Products</h6>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addAttarProductModal">Add Product</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                    <th>Rating</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($attarProducts as $product)
                                    <tr>
                                        <td>
                                            @if($product->image)
                                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" style="width: 50px; height: 50px; object-fit: cover;">
                                            @else
                                                <span class="badge bg-secondary">No Image</span>
                                            @endif
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td><span class="badge bg-info">{{ $product->type }}</span></td>
                                        <td>Rs {{ number_format($product->price ?? $product->original_price, 0) }}</td>
                                        <td>
                                            @if($product->discount_percentage)
                                                <span class="badge bg-danger">-{{ $product->discount_percentage }}%</span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($product->rating && $product->rating > 0)
                                                <div style="color: #FFD700;">
                                                    @for($i = 0; $i < floor($product->rating); $i++)
                                                        <i class="fas fa-star"></i>
                                                    @endfor
                                                    @if($product->rating % 1 != 0)
                                                        <i class="fas fa-star-half-alt"></i>
                                                    @endif
                                                </div>
                                            @else
                                                <span class="text-muted">No rating</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editAttarProductModal" 
                                                    onclick="clearAttarErrors(); editAttarProduct({{ $product->id }}, '{{ $product->name }}', '{{ addslashes($product->description) }}', {{ $product->price ?? 'null' }}, {{ $product->original_price ?? 'null' }}, '{{ $product->type }}', {{ $product->rating ?? 'null' }}, {{ $product->reviews_count ?? 'null' }}, '{{ $product->image }}', {{ $product->sort_order ?? 0 }})">
                                                Edit
                                            </button>
                                            <form action="{{ route('admin.attar-page.delete-product', $product) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">No attar products added yet</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Attar Product Modal -->
<div class="modal fade" id="addAttarProductModal" tabindex="-1" aria-labelledby="addAttarProductLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAttarProductLabel">Add Attar Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addProductForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" required>
                        <div class="invalid-feedback d-block" id="error-name"></div>
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Product Type <span class="text-danger">*</span></label>
                        <select class="form-control" id="type" name="type" required>
                            <option value="">Select Type</option>
                            <option value="Oud">Oud</option>
                            <option value="Floral">Floral</option>
                            <option value="Musk">Musk</option>
                            <option value="Woody">Woody</option>
                        </select>
                        <div class="invalid-feedback d-block" id="error-type"></div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="2"></textarea>
                        <div class="invalid-feedback d-block" id="error-description"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="price" class="form-label">Sale Price</label>
                                <input type="number" class="form-control" id="price" name="price" step="0.01">
                                <div class="invalid-feedback d-block" id="error-price"></div>
                                <small class="text-muted d-block mt-1">Leave empty if no discount</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="original_price" class="form-label">Original Price <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="original_price" name="original_price" step="0.01" required>
                                <div class="invalid-feedback d-block" id="error-original_price"></div>
                                <small class="text-muted d-block mt-1">Product price</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="discount_percentage" class="form-label">Discount % (Auto)</label>
                                <input type="number" class="form-control" id="discount_percentage" name="discount_percentage" readonly>
                                <div class="invalid-feedback d-block" id="error-discount_percentage"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="rating" class="form-label">Rating (0-5)</label>
                                <input type="number" class="form-control" id="rating" name="rating" step="0.1" min="0" max="5">
                                <div class="invalid-feedback d-block" id="error-rating"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="reviews_count" class="form-label">Number of Reviews</label>
                                <input type="number" class="form-control" id="reviews_count" name="reviews_count" min="0">
                                <div class="invalid-feedback d-block" id="error-reviews_count"></div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Product Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        <div class="invalid-feedback d-block" id="error-image"></div>
                    </div>

                    <div class="mb-3">
                        <label for="sort_order" class="form-label">Sort Order</label>
                        <input type="number" class="form-control" id="sort_order" name="sort_order" min="0" value="0">
                        <div class="invalid-feedback d-block" id="error-sort_order"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="submitAddProductForm()">Add Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Attar Product Modal -->
<div class="modal fade" id="editAttarProductModal" tabindex="-1" aria-labelledby="editAttarProductLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAttarProductLabel">Edit Attar Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editAttarProductForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Product Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_type" class="form-label">Product Type <span class="text-danger">*</span></label>
                        <select class="form-control" id="edit_type" name="type" required>
                            <option value="">Select Type</option>
                            <option value="Oud">Oud</option>
                            <option value="Floral">Floral</option>
                            <option value="Musk">Musk</option>
                            <option value="Woody">Woody</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Description</label>
                        <textarea class="form-control" id="edit_description" name="description" rows="2"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="edit_price" class="form-label">Sale Price</label>
                                <input type="number" class="form-control" id="edit_price" name="price" step="0.01">
                                <div id="edit_price_error" class="invalid-feedback d-block" style="display: none; color: #dc3545; font-size: 0.875em; margin-top: 0.25rem;"></div>
                                <small class="text-muted d-block mt-1">Leave empty if no discount</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="edit_original_price" class="form-label">Original Price <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="edit_original_price" name="original_price" step="0.01" required>
                                <small class="text-muted d-block mt-1">Product price</small>
                                <div id="edit_original_price_error" class="invalid-feedback d-block" style="display: none; color: #dc3545; font-size: 0.875em; margin-top: 0.25rem;"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="edit_discount_percentage" class="form-label">Discount % (Auto)</label>
                                <input type="number" class="form-control" id="edit_discount_percentage" name="discount_percentage" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_rating" class="form-label">Rating (0-5)</label>
                                <input type="number" class="form-control" id="edit_rating" name="rating" step="0.1" min="0" max="5">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_reviews_count" class="form-label">Number of Reviews</label>
                                <input type="number" class="form-control" id="edit_reviews_count" name="reviews_count" min="0">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="edit_image" class="form-label">Product Image</label>
                        <input type="file" class="form-control" id="edit_image" name="image" accept="image/*">
                        <div id="edit_image_preview" class="mt-2"></div>
                    </div>

                    <div class="mb-3">
                        <label for="edit_sort_order" class="form-label">Sort Order</label>
                        <input type="number" class="form-control" id="edit_sort_order" name="sort_order" min="0">
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

<script>
    let currentProductId = null;

    // Clear attar product errors when opening edit modal
    function clearAttarErrors() {
        const priceInput = document.getElementById('edit_price');
        const originalPriceInput = document.getElementById('edit_original_price');
        const priceErrorDiv = document.getElementById('edit_price_error');
        const originalPriceErrorDiv = document.getElementById('edit_original_price_error');

        // Clear error states
        if (priceInput) {
            priceInput.classList.remove('is-invalid');
        }
        if (originalPriceInput) {
            originalPriceInput.classList.remove('is-invalid');
        }
        if (priceErrorDiv) {
            priceErrorDiv.style.display = 'none';
            priceErrorDiv.textContent = '';
        }
        if (originalPriceErrorDiv) {
            originalPriceErrorDiv.style.display = 'none';
            originalPriceErrorDiv.textContent = '';
        }
    }

    function editAttarProduct(id, name, description, price, originalPrice, type, rating, reviewsCount, image, sortOrder) {
        currentProductId = id;
        document.getElementById('edit_name').value = name || '';
        document.getElementById('edit_description').value = description || '';
        document.getElementById('edit_price').value = (price && price !== 'null') ? price : '';
        document.getElementById('edit_original_price').value = (originalPrice && originalPrice !== 'null') ? originalPrice : '';
        document.getElementById('edit_type').value = type || '';
        document.getElementById('edit_rating').value = (rating && rating !== 'null' && rating !== 0) ? rating : '';
        document.getElementById('edit_reviews_count').value = (reviewsCount && reviewsCount !== 'null' && reviewsCount !== 0) ? reviewsCount : '';
        document.getElementById('edit_sort_order').value = (sortOrder !== null && sortOrder !== undefined) ? sortOrder : 0;

        // Calculate discount percentage
        const discountInput = document.getElementById('edit_discount_percentage');
        if (originalPrice && originalPrice > 0 && price && price > 0) {
            const discount = ((originalPrice - price) / originalPrice) * 100;
            discountInput.value = Math.round(discount);
        } else {
            discountInput.value = '';
        }

        // Update form action
        document.getElementById('editAttarProductForm').action = `/admin/attar-page/products/${id}`;

        // Show image preview
        const previewDiv = document.getElementById('edit_image_preview');
        if (image) {
            previewDiv.innerHTML = `
                <small class="text-muted">Current image:</small>
                <div style="position: relative; width: fit-content; margin-top: 0.5rem;">
                    <img src="{{ asset('${image}') }}" alt="Product" style="max-width: 150px; display: block;">
                </div>
            `;
        } else {
            previewDiv.innerHTML = '<small class="text-muted text-danger">No image</small>';
        }
    }

    function deletePageImage(pageType, imageField) {
        if (!confirm('Are you sure you want to delete this image?')) {
            return;
        }

        // Save scroll position before operation
        sessionStorage.setItem('scrollPosition', window.scrollY);

        fetch('{{ route("admin.attar-page.delete-image") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                image_field: imageField
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Image deleted successfully!');
                location.reload();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while deleting the image');
        });
    }

    // Auto-open add product modal if there are errors
    document.addEventListener('DOMContentLoaded', function() {
        // Restore scroll position from sessionStorage
        const savedScrollY = sessionStorage.getItem('scrollPosition');
        if (savedScrollY) {
            window.scrollTo(0, parseInt(savedScrollY));
            sessionStorage.removeItem('scrollPosition');
        }

        @if($errors->any())
            const addModal = new bootstrap.Modal(document.getElementById('addAttarProductModal'));
            addModal.show();
        @endif

        // Add discount calculation to add form
        const addForm = document.getElementById('addProductForm');
        if (addForm) {
            const addPriceInput = addForm.querySelector('input[name="price"]');
            const addOriginalPriceInput = addForm.querySelector('input[name="original_price"]');
            const addDiscountInput = addForm.querySelector('input[name="discount_percentage"]');

            if (addPriceInput && addOriginalPriceInput && addDiscountInput) {
                const calculateDiscount = () => {
                    const salePrice = parseFloat(addPriceInput.value) || 0;
                    const originalPrice = parseFloat(addOriginalPriceInput.value) || 0;
                    if (originalPrice > 0 && salePrice > 0) {
                        const discount = ((originalPrice - salePrice) / originalPrice) * 100;
                        addDiscountInput.value = Math.round(discount);
                    } else {
                        addDiscountInput.value = '';
                    }
                };
                addOriginalPriceInput.addEventListener('input', calculateDiscount);
                addPriceInput.addEventListener('input', calculateDiscount);
            }
        }

        // Add validation to edit form
        const editForm = document.getElementById('editAttarProductForm');
        if (editForm) {
            editForm.addEventListener('submit', function(e) {
                const priceInput = document.getElementById('edit_price');
                const originalPriceInput = document.getElementById('edit_original_price');
                const priceErrorDiv = document.getElementById('edit_price_error');
                const originalPriceErrorDiv = document.getElementById('edit_original_price_error');
                
                const price = parseFloat(priceInput.value) || 0;
                const originalPrice = parseFloat(originalPriceInput.value) || 0;

                // Reset all errors
                priceInput.classList.remove('is-invalid');
                originalPriceInput.classList.remove('is-invalid');
                priceErrorDiv.style.display = 'none';
                priceErrorDiv.textContent = '';
                originalPriceErrorDiv.style.display = 'none';
                originalPriceErrorDiv.textContent = '';

                // Validate: sale price must be less than original price (if original price is provided)
                if (originalPrice > 0 && price >= originalPrice) {
                    e.preventDefault();
                    e.stopPropagation();

                    // Show errors on both fields
                    priceInput.classList.add('is-invalid');
                    originalPriceInput.classList.add('is-invalid');
                    
                    priceErrorDiv.textContent = 'Sale price must be less than original price.';
                    priceErrorDiv.style.display = 'block';
                    
                    originalPriceErrorDiv.textContent = 'Original price must be greater than sale price.';
                    originalPriceErrorDiv.style.display = 'block';

                    // Scroll to error
                    priceInput.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    priceInput.focus();

                    return false;
                }
            });

            // Add discount calculation to edit form
            const editPriceInput = editForm.querySelector('input[name="price"]');
            const editOriginalPriceInput = editForm.querySelector('input[name="original_price"]');
            const editDiscountInput = editForm.querySelector('input[name="discount_percentage"]');

            if (editPriceInput && editOriginalPriceInput && editDiscountInput) {
                const calculateDiscount = () => {
                    const salePrice = parseFloat(editPriceInput.value) || 0;
                    const originalPrice = parseFloat(editOriginalPriceInput.value) || 0;
                    if (originalPrice > 0 && salePrice > 0) {
                        const discount = ((originalPrice - salePrice) / originalPrice) * 100;
                        editDiscountInput.value = Math.round(discount);
                    } else {
                        editDiscountInput.value = '';
                    }
                };
                editOriginalPriceInput.addEventListener('input', calculateDiscount);
                editPriceInput.addEventListener('input', calculateDiscount);
            }
        }

        // Save scroll position before form submission
        document.addEventListener('submit', function(e) {
            sessionStorage.setItem('scrollPosition', window.scrollY);
        });
    });

    function submitAddProductForm() {
        const form = document.getElementById('addProductForm');
        const formData = new FormData(form);

        // Clear all previous errors and reset form styling
        const errorDivs = document.querySelectorAll('[id^="error-"]');
        errorDivs.forEach(div => div.innerHTML = '');
        
        const inputs = form.querySelectorAll('input, select, textarea');
        inputs.forEach(input => input.classList.remove('is-invalid'));

        fetch('{{ route("admin.attar-page.store-product") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => response.json().then(data => ({ status: response.status, body: data })))
        .then(({ status, body }) => {
            if (status === 200 || status === 201) {
                // Success
                alert('Product added successfully!');
                form.reset();
                
                // Close modal after success
                const modal = bootstrap.Modal.getInstance(document.getElementById('addAttarProductModal'));
                modal.hide();
                
                // Reload page after modal closes
                setTimeout(() => {
                    location.reload();
                }, 500);
            } else if (status === 422) {
                // Validation error - show errors under each field
                throw body;
            } else {
                throw body;
            }
        })
        .catch(error => {
            console.log('Error caught:', error);
            
            if (error.errors) {
                // Display validation errors under each field
                Object.keys(error.errors).forEach(fieldName => {
                    const errorDiv = document.getElementById('error-' + fieldName);
                    const field = document.getElementById(fieldName);
                    
                    if (errorDiv && field) {
                        // Add red border to field
                        field.classList.add('is-invalid');
                        
                        // Display error message
                        const errorMessages = error.errors[fieldName];
                        if (Array.isArray(errorMessages)) {
                            errorDiv.innerHTML = errorMessages[0];
                            errorDiv.style.color = '#dc3545';
                            errorDiv.style.fontSize = '0.875em';
                            errorDiv.style.marginTop = '0.25rem';
                        }
                    }
                });
                
                // Scroll to first error
                const firstErrorField = Object.keys(error.errors)[0];
                const firstErrorElement = document.getElementById(firstErrorField);
                if (firstErrorElement) {
                    firstErrorElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstErrorElement.focus();
                }
            } else if (error.message) {
                alert('Error: ' + error.message);
            } else {
                alert('An error occurred. Please try again.');
            }
            console.error('Error:', error);
        });
    }
</script>
</x-default-layout>
@endsection

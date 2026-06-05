@extends('frontend.layouts.app')

@section('title', (isset($product['name']) ? $product['name'] : 'Product') . ' - Almukhtar Perfume')

@section('content')
    <!-- Product Quick View Section -->
    <section class="product-quick-view-section">
        @if($product)
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-5">
                    <div class="product-quick-image">
                        <img src="{{ asset($product['image'] ?? 'frontend/images/perfume1.jpg') }}" alt="{{ $product['name'] ?? 'Product' }}" id="mainImage">
                    </div>
                </div>
                <div class="col-lg-8 col-md-7">
                    <div class="product-quick-details">
                        <h1>{{ $product['name'] ?? 'Product' }}</h1>
                        
                        <div class="product-rating-section">
                            <div class="product-rating">
                                @for ($i = 0; $i < ($product['rating'] ?? 0); $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                            </div>
                            <span class="rating-count">({{ $product['reviews_count'] ?? 0 }} reviews)</span>
                        </div>

                        <div class="product-price-section">
                            @if (($product['price'] ?? 0) > 0)
                                <div class="product-price">Rs {{ number_format($product['price']) }}</div>
                                @if (($product['discount_percentage'] ?? 0) > 0)
                                    <div class="product-original-price"><s>Rs {{ number_format($product['original_price'] ?? 0) }}</s></div>
                                    <span class="discount-badge">{{ $product['discount_percentage'] }}% OFF</span>
                                @endif
                            @else
                                <div class="product-price">Rs {{ number_format($product['original_price'] ?? 0) }}</div>
                            @endif
                        </div>

                        <p class="product-short-description">
                            {{ $product['description'] ?? 'Premium fragrance' }}
                        </p>

                        <div class="product-quick-actions">
                            <div class="quantity-control">
                                <button class="qty-btn-minus" onclick="decreaseQtyDetail()">-</button>
                                <input type="number" id="detailQuantity" value="1" min="1" readonly>
                                <button class="qty-btn-plus" onclick="increaseQtyDetail()">+</button>
                            </div>
                            <button class="btn-add-to-cart-detail" onclick="goToCheckout()">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                            <button class="btn-wishlist-detail" title="Add to Wishlist">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="container">
            <div class="row">
                <div class="col-12 text-center py-5">
                    <h2>Product Not Found</h2>
                    <p class="text-muted">The product you're looking for doesn't exist.</p>
                    <a href="{{ route('home') }}" class="btn btn-primary">Back to Home</a>
                </div>
            </div>
        </div>
        @endif
    </section>

    <!-- Product Details Section -->
    @if($product)
    <section class="product-details-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="product-details-tabs">
                        <h3>Product Description</h3>
                        <p>{{ $product['description'] ?? 'Premium fragrance' }}</p>
                        
                        @if(isset($product['features']) && is_array($product['features']) && count($product['features']) > 0)
                            <h4 class="mt-4">Features</h4>
                            <ul class="features-list">
                                @foreach($product['features'] as $feature)
                                    <li><i class="fas fa-check"></i> {{ $feature }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="product-sidebar">
                        <div class="sidebar-box">
                            <i class="fas fa-truck"></i>
                            <div>
                                <h4>Free Shipping</h4>
                                <p>On orders above Rs 2,000</p>
                            </div>
                        </div>

                        <div class="sidebar-box">
                            <i class="fas fa-undo"></i>
                            <div>
                                <h4>Easy Returns</h4>
                                <p>30-day return policy</p>
                            </div>
                        </div>

                        <div class="sidebar-box">
                            <i class="fas fa-lock"></i>
                            <div>
                                <h4>Secure Payment</h4>
                                <p>100% safe checkout</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Related Products Section -->
    @if($product && $relatedProducts && count($relatedProducts) > 0)
    <section class="related-products-section">
        <div class="container">
            <p class="collection-label">YOU MIGHT ALSO LIKE</p>
            <h2 class="section-title">Related Products</h2>
            
            <div class="row">
                @foreach ($relatedProducts as $relatedProduct)
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="product-card">
                            <div class="product-image">
                                <img src="{{ asset($relatedProduct['image'] ?? 'frontend/images/perfume1.jpg') }}" alt="{{ $relatedProduct['name'] ?? 'Product' }}" loading="lazy">
                                @if (($relatedProduct['discount_percentage'] ?? 0) > 0)
                                    <span class="sale-badge">-{{ $relatedProduct['discount_percentage'] }}%</span>
                                @endif
                                <button class="wishlist-btn" title="Add to Wishlist"><i class="far fa-heart"></i></button>
                            </div>
                            <h5>{{ $relatedProduct['name'] ?? 'Product' }}</h5>
                            <p class="product-description">{{ $relatedProduct['description'] ?? '' }}</p>
                            <div class="product-footer">
                                <div class="price-section">
                                    @if (($relatedProduct['price'] ?? 0) > 0)
                                        <p class="price">Rs {{ number_format($relatedProduct['price']) }}</p>
                                        @if($relatedProduct['original_price'] ?? 0)
                                            <p class="original-price"><s>Rs {{ number_format($relatedProduct['original_price']) }}</s></p>
                                        @endif
                                    @else
                                        <p class="price">Rs {{ number_format($relatedProduct['original_price'] ?? 0) }}</p>
                                    @endif
                                </div>
                                <a href="{{ route('product.detail', $relatedProduct['id']) }}" class="btn-view-details">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Checkout Modal -->
    <!-- Modal removed - direct checkout flow implemented -->

    <style>
        .features-list {
            list-style: none;
            padding: 0;
        }

        .features-list li {
            padding: 0.5rem 0;
            color: #666666;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .features-list i {
            color: #00aa00;
            font-weight: 700;
        }
    </style>

    <script>
        function increaseQtyDetail() {
            const qty = document.getElementById('detailQuantity');
            qty.value = parseInt(qty.value) + 1;
        }

        function decreaseQtyDetail() {
            const qty = document.getElementById('detailQuantity');
            if (parseInt(qty.value) > 1) {
                qty.value = parseInt(qty.value) - 1;
            }
        }

        function goToCheckout() {
            @if($product)
                // Validate product data
                const productId = {{ $product['id'] ?? 'null' }};
                const productName = '{{ $product['name'] ?? 'Product' }}';
                const productPrice = {{ $product['price'] ?? $product['original_price'] ?? 0 }};
                const productImage = '{{ asset($product['image'] ?? 'frontend/images/perfume1.jpg') }}';
                const quantity = parseInt(document.getElementById('detailQuantity').value);

                if (!productId || productPrice <= 0) {
                    alert('Error: Invalid product information');
                    return;
                }

                const product = {
                    id: productId,
                    name: productName.trim(),
                    price: parseFloat(productPrice),
                    image: productImage,
                    quantity: quantity
                };
                
                // Check cart manager
                if (typeof cartManager === 'undefined' || !cartManager) {
                    console.error('Cart manager not available');
                    alert('Error: Cart system not loaded. Please refresh the page.');
                    return;
                }

                try {
                    cartManager.addItem(product);
                    showNotification('Added to cart!');
                    console.log('Product added:', product);
                } catch (error) {
                    console.error('Error adding to cart:', error);
                    alert('Error adding to cart. Please try again.');
                }
            @else
                alert('Product not found');
            @endif
        }

        function showNotification(message) {
            const notification = document.createElement('div');
            notification.className = 'cart-notification';
            notification.innerHTML = `
                <i class="fas fa-check-circle"></i>
                <span>${message}</span>
            `;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.classList.add('show');
            }, 10);

            setTimeout(() => {
                notification.classList.remove('show');
                setTimeout(() => notification.remove(), 300);
            }, 2000);
        }

        // Wishlist button functionality
        document.querySelectorAll('.btn-wishlist-detail').forEach(btn => {
            btn.addEventListener('click', function() {
                this.classList.toggle('active');
                const icon = this.querySelector('i');
                if (this.classList.contains('active')) {
                    icon.classList.remove('far');
                    icon.classList.add('fas');
                } else {
                    icon.classList.remove('fas');
                    icon.classList.add('far');
                }
            });
        });

        // Related products wishlist
        document.querySelectorAll('.wishlist-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                this.classList.toggle('active');
                const icon = this.querySelector('i');
                if (this.classList.contains('active')) {
                    icon.classList.remove('far');
                    icon.classList.add('fas');
                } else {
                    icon.classList.remove('fas');
                    icon.classList.add('far');
                }
            });
        });
    </script>
@endsection

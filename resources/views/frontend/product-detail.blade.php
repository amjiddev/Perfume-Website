@extends('frontend.layouts.app')

@section('title', ($product['name'] ?? 'Product') . ' - Almukhtar Perfume')

@section('content')
    <!-- Product Quick View Section -->
    <section class="product-quick-view-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-5">
                    <div class="product-quick-image">
                        <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}">
                    </div>
                </div>
                <div class="col-lg-8 col-md-7">
                    <div class="product-quick-details">
                        <h1>{{ $product['name'] }}</h1>
                        
                        <div class="product-rating-section">
                            <div class="product-rating">
                                @for ($i = 0; $i < $product['rating']; $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                            </div>
                            <span class="rating-count">({{ $product['reviews'] }} reviews)</span>
                        </div>

                        <div class="product-price-section">
                            <div class="product-price">Rs {{ number_format($product['price']) }}</div>
                            @if ($product['discount'] > 0)
                                <div class="product-original-price"><s>Rs {{ number_format($product['original_price']) }}</s></div>
                                <span class="discount-badge">{{ $product['discount'] }}% OFF</span>
                            @endif
                        </div>

                        <p class="product-short-description">
                            {{ $product['description'] }}
                        </p>

                        <div class="product-quick-actions">
                            <div class="quantity-control">
                                <button class="qty-btn-minus" onclick="decreaseQtyDetail()">-</button>
                                <input type="number" id="detailQuantity" value="1" min="1" readonly>
                                <button class="qty-btn-plus" onclick="increaseQtyDetail()">+</button>
                            </div>
                            <button class="btn-add-to-cart-detail">
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
    </section>

    <!-- Product Details Section -->
    <section class="product-details-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="product-details-tabs">
                        <h3>Product Description</h3>
                        <p>{{ $product['long_description'] }}</p>
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

    <!-- Related Products Section -->
    <section class="related-products-section">
        <div class="container">
            <p class="collection-label">YOU MIGHT ALSO LIKE</p>
            <h2 class="section-title">Related Products</h2>
            
            <div class="row">
                @foreach ($relatedProducts as $relatedProduct)
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="product-card">
                            <div class="product-image">
                                <img src="{{ asset($relatedProduct['image']) }}" alt="{{ $relatedProduct['name'] }}" loading="lazy">
                                @if ($relatedProduct['discount'] > 0)
                                    <span class="sale-badge">-{{ $relatedProduct['discount'] }}%</span>
                                @endif
                                <button class="wishlist-btn" title="Add to Wishlist"><i class="far fa-heart"></i></button>
                            </div>
                            <h5>{{ $relatedProduct['name'] }}</h5>
                            <p class="product-description">{{ $relatedProduct['description'] }}</p>
                            <div class="product-footer">
                                <div class="price-section">
                                    <p class="price">Rs {{ number_format($relatedProduct['price']) }}</p>
                                    <p class="original-price"><s>Rs {{ number_format($relatedProduct['original_price']) }}</s></p>
                                </div>
                                <a href="{{ route('product.detail', $relatedProduct['id']) }}" class="btn-view-details">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

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

        // Add to cart functionality
        document.querySelectorAll('.btn-add-to-cart-detail').forEach(btn => {
            btn.addEventListener('click', function() {
                const qty = document.getElementById('detailQuantity').value;
                alert('Added ' + qty + ' item(s) to cart!');
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

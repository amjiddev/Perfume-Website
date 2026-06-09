@extends('frontend.layouts.app')

@section('title', $product->name . ' - Premium Attar | Almukhtar Perfume')

@section('content')
    <!-- Product Detail Section -->
    <section class="product-detail-section">
        <div class="container">
            <div class="row align-items-center">
                <!-- Product Image Left -->
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="product-image-detail">
                        @if($product->image)
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="img-fluid">
                        @else
                            <div style="width: 100%; height: 400px; background-color: #f5f5f5; display: flex; align-items: center; justify-content: center; color: #ccc; font-size: 1rem; border-radius: 8px;">
                                No Image
                            </div>
                        @endif
                        
                        @if($product->discount_percentage)
                            <span class="sale-badge-detail">{{ $product->discount_percentage }}% OFF</span>
                        @endif
                    </div>
                </div>

                <!-- Product Info Center -->
                <div class="col-lg-4">
                    <div class="product-info-center">
                        <!-- Product Name -->
                        <h1 class="product-name-detail">{{ $product->name }}</h1>
                        
                        <!-- Type Badge -->
                        <span class="attar-type-badge">{{ $product->type }}</span>

                        <!-- Rating -->
                        <div class="rating-section-detail">
                            <div class="stars-detail">
                                @for($i = 0; $i < floor($product->rating); $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                                @if($product->rating % 1 != 0)
                                    <i class="fas fa-star-half-alt"></i>
                                @endif
                            </div>
                            <span class="review-count">({{ $product->reviews_count }} reviews)</span>
                        </div>

                        <!-- Price Section -->
                        <div class="price-section-detail">
                            <p class="price-main-detail">Rs {{ number_format($product->price, 0) }}</p>
                            @if($product->original_price)
                                <p class="price-original-detail">Rs {{ number_format($product->original_price, 0) }}</p>
                            @endif
                        </div>

                        <!-- Quantity + Add to Cart Row -->
                        <div class="cart-action-row">
                            <div class="quantity-input-detail">
                                <button class="qty-btn" onclick="decrementQty()">−</button>
                                <input type="number" id="quantity" value="1" min="1" readonly>
                                <button class="qty-btn" onclick="incrementQty()">+</button>
                            </div>
                            <button type="button" class="btn-add-to-cart" onclick="addToCart()">
                                <i class="fas fa-shopping-cart"></i> ADD TO CART
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Empty Right Column (for layout) -->
                <div class="col-lg-4">
                </div>
            </div>

            <!-- Product Description Section -->
            <div class="row mt-5 pt-4 border-top">
                <div class="col-lg-8">
                    <h3 class="section-title">Product Description</h3>
                    @if($product->description)
                        <p class="description-text">{{ $product->description }}</p>
                    @endif
                </div>
                <div class="col-lg-4"></div>
            </div>

            <!-- Side Features Section (Below Description) -->
            <div class="row mt-5 pt-4">
                <div class="col-lg-8 offset-lg-0">
                </div>
                <div class="col-lg-4">
                    <div class="features-side">
                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-truck"></i>
                            </div>
                            <div class="feature-text">
                                <h6>Free Shipping</h6>
                                <p>On orders above Rs 2,000</p>
                            </div>
                        </div>

                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-redo"></i>
                            </div>
                            <div class="feature-text">
                                <h6>Easy Returns</h6>
                                <p>30-day return policy</p>
                            </div>
                        </div>

                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="fas fa-lock"></i>
                            </div>
                            <div class="feature-text">
                                <h6>Secure Payment</h6>
                                <p>100% safe checkout</p>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </section>

    <!-- Related Products Section -->
    @if($relatedProducts->count() > 0)
    <section class="related-products-section">
        <div class="container">
            <h2 class="section-title">Related Products</h2>
            <div class="products-grid-related">
                @foreach($relatedProducts as $related)
                    <div class="product-card-related">
                        <div class="product-image-wrapper-related">
                            @if($related->image)
                                <img src="{{ asset($related->image) }}" alt="{{ $related->name }}">
                            @else
                                <div style="width: 100%; height: 100%; background-color: #f5f5f5; display: flex; align-items: center; justify-content: center; color: #ccc;">
                                    No Image
                                </div>
                            @endif
                            @if($related->discount_percentage)
                                <span class="sale-badge">{{ $related->discount_percentage }}% OFF</span>
                            @endif
                        </div>
                        <div class="product-info-related">
                            <h5>{{ $related->name }}</h5>
                            <p class="type-badge">{{ $related->type }}</p>
                            <div class="price-related">
                                <span class="price">Rs {{ number_format($related->price, 0) }}</span>
                                @if($related->original_price)
                                    <span class="original">Rs {{ number_format($related->original_price, 0) }}</span>
                                @endif
                            </div>
                            <a href="{{ route('attar.detail', $related->id) }}" class="btn-view-related">View Details</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <style>
        /* Product Detail Section */
        .product-detail-section {
            padding: 3rem 0;
        }

        .product-image-detail {
            position: relative;
            text-align: center;
        }

        .product-image-detail img {
            width: 100%;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .sale-badge-detail {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #C8A96A;
            color: white;
            padding: 8px 15px;
            border-radius: 4px;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .product-info-center {
            padding: 0 2rem;
        }

        .product-name-detail {
            font-size: 2.2rem;
            font-weight: 700;
            color: #000;
            margin: 0.5rem 0 0.8rem 0;
            line-height: 1.2;
        }

        .attar-type-badge {
            display: inline-block;
            background-color: #f0f0f0;
            color: #333;
            padding: 0.4rem 0.8rem;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.8rem;
        }

        /* Rating */
        .rating-section-detail {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .stars-detail {
            color: #C8A96A;
            font-size: 1rem;
            letter-spacing: 2px;
        }

        .review-count {
            color: #666;
            font-size: 0.9rem;
        }

        /* Price */
        .price-section-detail {
            margin-bottom: 2rem;
        }

        .price-main-detail {
            font-size: 1.8rem;
            font-weight: 700;
            color: #C8A96A;
            margin: 0;
        }

        .price-original-detail {
            color: #999;
            margin: 0.3rem 0 0 0;
            font-size: 1rem;
        }

        /* Cart Action Row */
        .cart-action-row {
            display: flex;
            gap: 1.5rem;
            align-items: center;
            margin-bottom: 2rem;
        }

        .quantity-input-detail {
            display: flex;
            border: 1px solid #ddd;
            border-radius: 4px;
            overflow: hidden;
            align-items: center;
        }

        .qty-btn {
            background: #f5f5f5;
            border: none;
            padding: 0.6rem 1rem;
            cursor: pointer;
            font-size: 1.1rem;
            color: #333;
            transition: background 0.3s;
        }

        .qty-btn:hover {
            background: #e8e8e8;
        }

        #quantity {
            border: none;
            width: 50px;
            text-align: center;
            font-size: 1rem;
            font-weight: 600;
            background: white;
        }

        .btn-add-to-cart {
            background-color: #C8A96A;
            color: #fff;
            border: 2px solid #C8A96A;
            padding: 0.7rem 1.8rem;
            border-radius: 4px;
            font-weight: 700;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            white-space: nowrap;
        }

        .btn-add-to-cart:hover {
            background-color: #b3945a;
            border-color: #b3945a;
        }

        /* Side Features */
        .features-side {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .feature-item {
            display: flex;
            gap: 1rem;
            padding: 1.5rem;
            background-color: #f9f9f9;
            border-left: 4px solid #C8A96A;
            border-radius: 4px;
        }

        .feature-icon {
            font-size: 1.8rem;
            color: #C8A96A;
            min-width: 40px;
            text-align: center;
        }

        .feature-text h6 {
            font-weight: 700;
            color: #000;
            margin: 0 0 0.3rem 0;
            font-size: 0.95rem;
        }

        .feature-text p {
            color: #666;
            margin: 0;
            font-size: 0.85rem;
        }

        /* Description Section */
        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #000;
            margin-bottom: 1.5rem;
        }

        .description-text {
            color: #666;
            line-height: 1.8;
            font-size: 0.95rem;
        }

        .border-top {
            border-top-color: #f0f0f0 !important;
        }

        /* Related Products */
        .related-products-section {
            background-color: #f9f9f9;
            padding: 4rem 0;
            margin-top: 4rem;
        }

        .products-grid-related {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 2rem;
        }

        .product-card-related {
            background: white;
            border: 1px solid #e8e8e8;
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .product-card-related:hover {
            border-color: #C8A96A;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .product-image-wrapper-related {
            position: relative;
            width: 100%;
            height: 250px;
            overflow: hidden;
        }

        .product-image-wrapper-related img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-card-related:hover .product-image-wrapper-related img {
            transform: scale(1.05);
        }

        .sale-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #C8A96A;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .product-info-related {
            padding: 1.5rem;
        }

        .product-info-related h5 {
            font-weight: 700;
            color: #000;
            margin: 0 0 0.5rem 0;
        }

        .type-badge {
            display: inline-block;
            background: #f0f0f0;
            color: #333;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .price-related {
            display: flex;
            gap: 0.8rem;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .price-related .original {
            color: #999;
            font-weight: 400;
        }

        .btn-view-related {
            display: block;
            width: 100%;
            text-align: center;
            background-color: #C8A96A;
            color: white;
            padding: 0.8rem;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 600;
            transition: background 0.3s ease;
        }

        .btn-view-related:hover {
            background-color: #b3945a;
            text-decoration: none;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .product-info-center {
                padding: 0;
                margin-top: 2rem;
            }

            .features-side {
                margin-top: 2rem;
            }
        }

        @media (max-width: 768px) {
            .product-name-detail {
                font-size: 1.8rem;
            }

            .price-main-detail {
                font-size: 1.5rem;
            }

            .cart-action-row {
                flex-direction: column;
                align-items: stretch;
            }

            .btn-add-to-cart {
                width: 100%;
            }

            .products-grid-related {
                grid-template-columns: repeat(2, 1fr);
                gap: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .product-name-detail {
                font-size: 1.5rem;
            }

            .price-main-detail {
                font-size: 1.3rem;
            }

            .products-grid-related {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <script>
        function incrementQty() {
            const qty = document.getElementById('quantity');
            qty.value = parseInt(qty.value) + 1;
        }

        function decrementQty() {
            const qty = document.getElementById('quantity');
            if (parseInt(qty.value) > 1) {
                qty.value = parseInt(qty.value) - 1;
            }
        }

        function addToCart() {
            const quantity = document.getElementById('quantity').value;
            const productName = '{{ $product->name }}';
            const price = '{{ $product->price }}';
            
            // Store in localStorage or session
            alert(`✓ ${productName} (Qty: ${quantity}) added to cart!\n\nPrice: Rs ${price}`);
            
            // You can implement actual cart functionality here later
        }
    </script>
@endsection

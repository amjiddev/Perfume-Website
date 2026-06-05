@extends('frontend.layouts.app')

@section('title', isset($product['name']) ? $product['name'] . ' - Almukhtar Perfume' : 'Product Details')

@section('content')
<div class="perfume-detail-container">
    <div class="container">
        <!-- Back Button -->
        <div class="back-button-section">
            <a href="{{ route('perfumes') }}" class="back-link">
                <i class="fas fa-arrow-left"></i> Back to Perfumes
            </a>
        </div>

        <!-- Product Detail Section -->
        <div class="product-detail-section">
            <div class="row">
                <!-- Product Image -->
                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="product-image-container">
                        <img src="https://images.pexels.com/photos/3962286/pexels-photo-3962286.jpeg?w=600&h=700&fit=crop" 
                             alt="{{ $product['name'] ?? 'Product' }}" 
                             class="product-main-image">
                        @if(isset($product['discount_percentage']) && $product['discount_percentage'] > 0)
                            <span class="discount-badge-detail">-{{ $product['discount_percentage'] }}%</span>
                        @endif
                        <button class="wishlist-btn-detail" title="Add to Wishlist">
                            <i class="far fa-heart"></i>
                        </button>
                    </div>
                </div>

                <!-- Product Details -->
                <div class="col-lg-6 col-md-12">
                    <div class="product-details-content">
                        <!-- Product Name -->
                        <h1 class="product-name-detail">{{ $product['name'] ?? 'Product Name' }}</h1>

                        <!-- Rating -->
                        <div class="rating-section-detail">
                            <div class="stars-detail">
                                @for($i = 0; $i < floor($product['rating'] ?? 0); $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                                @if(($product['rating'] ?? 0) % 1 != 0)
                                    <i class="fas fa-star-half-alt"></i>
                                @endif
                            </div>
                            <span class="reviews-count-detail">({{ $product['reviews_count'] ?? 0 }} reviews)</span>
                        </div>

                        <!-- Price Section -->
                        <div class="price-section-detail">
                            <div class="price-display">
                                @if(isset($product['price']) && $product['price'] > 0)
                                    <span class="current-price">Rs {{ number_format($product['price']) }}</span>
                                    @if(isset($product['original_price']) && $product['original_price'] > 0)
                                        <span class="original-price">
                                            <s>Rs {{ number_format($product['original_price']) }}</s>
                                        </span>
                                    @endif
                                @else
                                    <span class="current-price">Rs {{ number_format($product['original_price'] ?? 0) }}</span>
                                @endif
                            </div>
                        </div>

                        <!-- Description -->
                        <p class="product-description-detail">
                            {{ $product['description'] ?? 'Premium fragrance' }}
                        </p>

                        <!-- Features -->
                        @if(isset($product['features']) && is_array($product['features']) && count($product['features']) > 0)
                            <div class="features-section-detail">
                                <h4>Key Features:</h4>
                                <ul class="features-list-detail">
                                    @foreach($product['features'] as $feature)
                                        <li>
                                            <i class="fas fa-check"></i> {{ $feature }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Quantity and Add to Cart -->
                        <div class="cart-actions-detail">
                            <div class="quantity-selector-detail">
                                <label>Quantity:</label>
                                <div class="quantity-input-detail">
                                    <button class="qty-minus" onclick="decreaseQty()">-</button>
                                    <input type="number" id="quantityInput" value="1" min="1" readonly>
                                    <button class="qty-plus" onclick="increaseQty()">+</button>
                                </div>
                            </div>

                            <button class="btn-add-to-cart-detail" onclick="addToCartNow()">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                        </div>

                        <!-- Product Info -->
                        <div class="product-info-detail">
                            <div class="info-item">
                                <i class="fas fa-truck"></i>
                                <div>
                                    <h5>Free Shipping</h5>
                                    <p>On orders above Rs 4,000</p>
                                </div>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-shield-alt"></i>
                                <div>
                                    <h5>Authentic</h5>
                                    <p>100% Original Products</p>
                                </div>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-undo"></i>
                                <div>
                                    <h5>Easy Returns</h5>
                                    <p>15 days return policy</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .perfume-detail-container {
        background-color: #ffffff;
        padding: 3rem 0;
        min-height: 100vh;
    }

    .back-button-section {
        margin-bottom: 2rem;
    }

    .back-link {
        color: #000000;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        font-size: 1rem;
    }

    .back-link:hover {
        color: #000000;
        transform: translateX(-5px);
    }

    .product-detail-section {
        padding: 2rem 0;
    }

    .product-image-container {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        background: #f5f5f5;
        aspect-ratio: 3 / 4;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .product-main-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .product-image-container:hover .product-main-image {
        transform: scale(1.05);
    }

    .discount-badge-detail {
        position: absolute;
        top: 1.5rem;
        right: 1.5rem;
        background: linear-gradient(135deg, #ff6b6b 0%, #ff5252 100%);
        color: white;
        padding: 0.8rem 1rem;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.95rem;
        box-shadow: 0 4px 12px rgba(255, 107, 107, 0.3);
    }

    .wishlist-btn-detail {
        position: absolute;
        top: 1.5rem;
        left: 1.5rem;
        background: rgba(255, 255, 255, 0.95);
        border: none;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        color: #000;
        transition: all 0.3s ease;
    }

    .wishlist-btn-detail:hover {
        background: #000;
        color: white;
        transform: scale(1.1);
    }

    .product-details-content {
        padding: 2rem;
        background: #f9f9f9;
        border-radius: 12px;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
    }

    .product-name-detail {
        font-size: 2.2rem;
        font-weight: 700;
        color: #000;
        margin: 0 0 1rem 0;
        line-height: 1.3;
    }

    .rating-section-detail {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .stars-detail {
        font-size: 1.2rem;
        color: #ffc107;
        letter-spacing: 0.2rem;
    }

    .reviews-count-detail {
        color: #666;
        font-size: 0.95rem;
        font-weight: 600;
    }

    .price-section-detail {
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 2px solid #e0e0e0;
    }

    .price-display {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .current-price {
        font-size: 2rem;
        font-weight: 700;
        color: #000;
    }

    .original-price {
        font-size: 1.1rem;
        color: #999;
    }

    .product-description-detail {
        color: #666;
        font-size: 1rem;
        line-height: 1.8;
        margin-bottom: 1.5rem;
    }

    .features-section-detail {
        margin-bottom: 2rem;
    }

    .features-section-detail h4 {
        font-weight: 700;
        color: #000;
        margin-bottom: 1rem;
        font-size: 1.1rem;
    }

    .features-list-detail {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .features-list-detail li {
        color: #666;
        padding: 0.6rem 0;
        display: flex;
        align-items: center;
        gap: 0.8rem;
        font-size: 0.95rem;
    }

    .features-list-detail i {
        color: #667eea;
        font-weight: 600;
    }

    .cart-actions-detail {
        display: flex;
        gap: 1rem;
        align-items: flex-end;
        margin-bottom: 2rem;
    }

    .quantity-selector-detail {
        flex: 0 0 auto;
    }

    .quantity-selector-detail label {
        display: block;
        font-weight: 600;
        color: #000;
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }

    .quantity-input-detail {
        display: flex;
        border: 2px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
    }

    .quantity-input-detail button {
        background: #f5f5f5;
        border: none;
        width: 45px;
        height: 45px;
        cursor: pointer;
        font-weight: bold;
        font-size: 1.2rem;
        transition: all 0.3s ease;
    }

    .quantity-input-detail button:hover {
        background: #000000;
        color: white;
    }

    .quantity-input-detail input {
        border: none;
        width: 60px;
        text-align: center;
        font-weight: 700;
        font-size: 1rem;
    }

    .btn-add-to-cart-detail {
        flex: 1;
        background: #000000;
        color: white;
        border: none;
        padding: 1rem 2rem;
        border-radius: 8px;
        font-weight: 700;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.8rem;
        height: 45px;
    }

    .btn-add-to-cart-detail:hover {
        transform: translateY(-3px);
        box-shadow: #000000
    }

    .product-info-detail {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 2px solid #e0e0e0;
    }

    .info-item {
        display: flex;
        gap: 1rem;
        align-items: flex-start;
    }

    .info-item i {
        font-size: 1.5rem;
        color: #C8A96A;
        flex-shrink: 0;
        margin-top: 0.3rem;
    }

    .info-item h5 {
        font-size: 0.95rem;
        font-weight: 700;
        color: #000;
        margin: 0 0 0.3rem 0;
    }

    .info-item p {
        font-size: 0.85rem;
        color: #666;
        margin: 0;
    }

    @media (max-width: 768px) {
        .perfume-detail-container {
            padding: 1.5rem 0;
        }

        .product-details-content {
            padding: 1.5rem;
            margin-top: 2rem;
        }

        .product-name-detail {
            font-size: 1.8rem;
        }

        .current-price {
            font-size: 1.5rem;
        }

        .cart-actions-detail {
            flex-direction: column;
        }

        .quantity-selector-detail {
            width: 100%;
        }

        .quantity-input-detail {
            width: 100%;
        }

        .btn-add-to-cart-detail {
            width: 100%;
        }

        .product-info-detail {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
    }
</style>

<script>
    let currentQuantity = 1;

    function increaseQty() {
        currentQuantity++;
        document.getElementById('quantityInput').value = currentQuantity;
    }

    function decreaseQty() {
        if (currentQuantity > 1) {
            currentQuantity--;
            document.getElementById('quantityInput').value = currentQuantity;
        }
    }

    function addToCartNow() {
        const productName = document.querySelector('.product-name-detail').textContent;
        const priceText = document.querySelector('.current-price').textContent;
        const price = parseInt(priceText.replace(/[^0-9]/g, ''));
        const quantity = currentQuantity;

        // Use the existing addToCart function from the app layout
        addToCart(
            '{{ $product['id'] ?? 0 }}',
            productName,
            price,
            'https://images.pexels.com/photos/3962286/pexels-photo-3962286.jpeg?w=300&h=400&fit=crop'
        );

        alert('Product added to cart successfully!');
    }
</script>

@endsection

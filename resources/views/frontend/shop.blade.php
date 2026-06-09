@extends('frontend.layouts.app')

@section('title', 'Shop - Almukhtar Perfume')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section-centered" style="background-image: url('{{ asset($shopPage?->hero_image ?? 'frontend/images/perfume2.jpg') }}');">
        <div class="hero-overlay-light"></div>
        
        <div class="hero-content-centered">
            <div class="hero-text-centered">
                <h1>{{ $shopPage?->hero_heading ?? 'Our Collection' }}</h1>
                <p>{{ $shopPage?->hero_subheading ?? 'Browse our exclusive range of premium fragrances curated for every occasion and personality.' }}</p>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="page-content" id="products">
        <div class="container">
            <h2 class="section-title">All Fragrances</h2>
            
            <!-- Category Tabs -->
            <div class="shop-tabs-container">
                <ul class="nav nav-tabs shop-tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab" onclick="filterCategory('all')">All</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="men-tab" data-bs-toggle="tab" data-bs-target="#men" type="button" role="tab" onclick="filterCategory('men')">For Men</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="women-tab" data-bs-toggle="tab" data-bs-target="#women" type="button" role="tab" onclick="filterCategory('women')">For Women</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="unisex-tab" data-bs-toggle="tab" data-bs-target="#unisex" type="button" role="tab" onclick="filterCategory('unisex')">Unisex</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="arabic-tab" data-bs-toggle="tab" data-bs-target="#arabic" type="button" role="tab" onclick="filterCategory('arabic')">Arabic Perfumes</button>
                    </li>
                </ul>
            </div>
            
            <div class="row" id="shopProductsGrid">
                @forelse($products as $index => $product)
                    <div class="col-lg-4 col-md-6 mb-4 shop-product-item" data-index="{{ $index }}" data-category="all,{{ $product->category }}" style="display: {{ $index < 3 ? 'block' : 'none' }};">
                        <div class="product-card">
                            <div class="product-image-shop" onclick="goToProductDetail({{ $product->id }})">
                                <img src="{{ asset($product->image ?? 'frontend/images/perfume2.jpg') }}" alt="{{ $product->name }}" class="img-fluid" style="cursor: pointer;">
                                @if($product->discount_percentage && $product->discount_percentage > 0)
                                    <span class="sale-badge">-{{ $product->discount_percentage }}%</span>
                                @endif
                            </div>
                            <h5 class="mt-3">{{ $product->name }}</h5>
                            <p class="text-muted">{{ $product->description ?? 'Premium quality perfume' }}</p>
                            <div class="rating mb-2">
                                @for($i = 0; $i < floor($product->rating); $i++)
                                    <i class="fas fa-star" style="color: #FFD700;"></i>
                                @endfor
                                @if($product->rating % 1 != 0)
                                    <i class="fas fa-star-half" style="color: #FFD700;"></i>
                                @endif
                                <span class="ms-2">({{ $product->reviews_count }} reviews)</span>
                            </div>
                            <div class="price-section">
                                <p class="price">Rs {{ number_format($product->price, 0) }}</p>
                                @if($product->original_price)
                                    <p class="original-price"><s>Rs {{ number_format($product->original_price, 0) }}</s></p>
                                @endif
                            </div>
                            <button class="btn-primary-custom w-100 add-to-cart-btn" 
                                    data-product-id="{{ $product->id }}" 
                                    data-product-name="{{ $product->name }}" 
                                    data-product-price="{{ $product->price ?? 0 }}" 
                                    data-product-image="{{ asset($product->image ?? 'frontend/images/perfume2.jpg') }}">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">No products available</p>
                    </div>
                @endforelse
            </div>
            </div>

            <!-- Show More/Less Button -->
            <div class="show-more-container">
                <button class="btn-show-more" id="shopShowMoreBtn" onclick="toggleShop()">
                    <i class="fas fa-chevron-down"></i> Show More
                </button>
            </div>
        </div>
    </section>

    <style>
        .product-card {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 1.5rem;
            transition: all 0.3s ease;
            text-align: center;
        }

        .product-card:hover {
            border-color: #000000;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            transform: translateY(-5px);
        }

        .product-image-shop {
            position: relative;
            width: 100%;
            height: 300px;
            overflow: hidden;
            background-color: #f5f5f5;
            border-radius: 5px;
            margin-bottom: 1rem;
        }

        .product-image-shop img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 5px;
        }

        .sale-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #ff0000;
            color: #ffffff;
            padding: 0.5rem 0.8rem;
            border-radius: 5px;
            font-weight: bold;
            font-size: 0.9rem;
            z-index: 10;
        }

        .product-card h5 {
            color: #000000;
            margin-top: 1rem;
        }

        .product-card p {
            color: #000000;
        }

        .rating {
            font-size: 0.9rem;
            color: #FFD700;
        }

        .price-section {
            display: flex;
            flex-direction: row;
            gap: 1rem;
            align-items: center;
            justify-content: center;
            margin: 1rem 0;
        }

        .original-price {
            font-size: 0.9rem;
            color: #000000;
            margin: 0;
            font-weight: 600;
        }

        .price {
            font-size: 1.5rem;
            color: #ff0000;
            font-weight: bold;
            margin: 0;
        }

        /* Show More/Less Button */
        .show-more-container {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        .btn-show-more {
            background: linear-gradient(135deg, #000000 0%, #1a1a1a 100%);
            color: #ffffff;
            border: none;
            padding: 1rem 2.5rem;
            border-radius: 50px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            letter-spacing: 1px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
        }

        .btn-show-more:hover {
            background: linear-gradient(135deg, #1a1a1a 0%, #000000 100%);
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.5);
        }

        .btn-show-more i {
            transition: transform 0.3s ease;
        }

        .btn-show-more.expanded i {
            transform: rotate(180deg);
        }
    </style>

    <script>
        let shopExpanded = false;
        let currentCategory = 'all';
        
        // Shop page settings from backend
        const shopSettings = {
            showHomePage: {{ $shopPage?->show_home_page ? 'true' : 'false' }},
            showAboutPage: {{ $shopPage?->show_about_page ? 'true' : 'false' }},
            showShopByCategory: {{ $shopPage?->show_shop_by_category ? 'true' : 'false' }}
        };

        function goToProductDetail(productId) {
            window.location.href = '{{ route("product.detail", "") }}' + '/' + productId;
        }

        function filterCategory(category) {
            currentCategory = category;
            const items = document.querySelectorAll('.shop-product-item');
            let visibleItems = [];
            
            items.forEach((item) => {
                const categories = item.getAttribute('data-category').split(',');
                if (categories.includes(category)) {
                    visibleItems.push(item);
                } else {
                    item.style.display = 'none';
                }
            });
            
            // Show only first 3 items
            visibleItems.forEach((item, index) => {
                if (index < 3) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
            
            // Reset show more/less
            shopExpanded = false;
            const btn = document.getElementById('shopShowMoreBtn');
            btn.innerHTML = '<i class="fas fa-chevron-down"></i> Show More';
            btn.classList.remove('expanded');
        }

        function toggleShop() {
            const items = document.querySelectorAll('.shop-product-item');
            const btn = document.getElementById('shopShowMoreBtn');
            
            // Get all items in current category
            let visibleItems = [];
            items.forEach((item) => {
                const categories = item.getAttribute('data-category').split(',');
                if (categories.includes(currentCategory)) {
                    visibleItems.push(item);
                }
            });
            
            shopExpanded = !shopExpanded;
            
            if (shopExpanded) {
                // Show 6 items (first 3 + 3 more)
                visibleItems.forEach((item, index) => {
                    if (index < 6) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
                btn.innerHTML = '<i class="fas fa-chevron-up"></i> Show Less';
                btn.classList.add('expanded');
            } else {
                // Show only first 3 items
                visibleItems.forEach((item, index) => {
                    if (index < 3) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
                btn.innerHTML = '<i class="fas fa-chevron-down"></i> Show More';
                btn.classList.remove('expanded');
            }
        }
    </script>
@endsection

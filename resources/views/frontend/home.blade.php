@extends('frontend.layouts.app')

@section('title', 'Home - Almukhtar Perfume | Luxury Fragrances')

@section('content')
    <!-- Hero Section with Slider -->
    <section class="hero-section" id="heroSlider">
        <div class="hero-slider-container">
            <div class="hero-slide active" id="heroSlide1" data-mobile="{{ asset($homePage->hero_image_1_mobile ?? $homePage->hero_image_1 ?? 'frontend/images/perfume1.jpg') }}" data-tablet="{{ asset($homePage->hero_image_1_tablet ?? $homePage->hero_image_1 ?? 'frontend/images/perfume1.jpg') }}" data-laptop="{{ asset($homePage->hero_image_1_laptop ?? $homePage->hero_image_1 ?? 'frontend/images/perfume1.jpg') }}" style="background-image: url('{{ asset($homePage->hero_image_1 ?? 'frontend/images/perfume1.jpg') }}?v={{ time() }}'); background-size: cover; background-position: center; background-repeat: no-repeat;"></div>
            <div class="hero-slide" id="heroSlide2" data-mobile="{{ asset($homePage->hero_image_2_mobile ?? $homePage->hero_image_2 ?? 'frontend/images/perfume2.jpg') }}" data-tablet="{{ asset($homePage->hero_image_2_tablet ?? $homePage->hero_image_2 ?? 'frontend/images/perfume2.jpg') }}" data-laptop="{{ asset($homePage->hero_image_2_laptop ?? $homePage->hero_image_2 ?? 'frontend/images/perfume2.jpg') }}" style="background-image: url('{{ asset($homePage->hero_image_2 ?? 'frontend/images/perfume2.jpg') }}?v={{ time() }}'); background-size: cover; background-position: center; background-repeat: no-repeat;"></div>
        </div>
        
        <div class="hero-overlay"></div>
        
        <div class="hero-content">
            <div class="hero-text">
                <h1>
                    <span class="hero-static">DISCOVER</span>
                    <span class="hero-dynamic" id="heroDynamicText">LUXURY</span>
                </h1>
                <p>{{ $homePage->hero_subheading }}</p>
                <div class="hero-buttons">
                    <a href="/perfumes" class="btn-primary-custom">
                        <i class="fas fa-bottle-droplet"></i> Shop Perfumes
                    </a>
                    <a href="/attar" class="btn-secondary-custom">
                        <i class="fas fa-flask"></i> Shop Attar
                    </a>
                </div>
            </div>
        </div>

        <!-- Slider Controls -->
        <button class="slider-btn slider-btn-left" onclick="changeSlide(-1)">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button class="slider-btn slider-btn-right" onclick="changeSlide(1)">
            <i class="fas fa-chevron-right"></i>
        </button>

        <!-- Slider Indicators -->
        <div class="hero-slider-indicators">
            <span class="indicator active" onclick="currentSlide(0)"></span>
            <span class="indicator" onclick="currentSlide(1)"></span>
        </div>
    </section>

    <!-- Category Section -->
    @if($shopPage?->show_shop_by_category)
    <section class="page-content category-section">
        <div class="container">
            <p class="collection-label">EXPLORE</p>
            <h2 class="section-title">Shop by Category</h2>
            
            <div class="row">
                @php
                    $categories = [
                        'men' => ['title' => 'For Men', 'description' => 'Bold & Masculine Fragrances'],
                        'women' => ['title' => 'For Women', 'description' => 'Elegant & Feminine Scents'],
                        'unisex' => ['title' => 'Unisex', 'description' => 'Versatile & Universal Fragrances'],
                        'arabic' => ['title' => 'Arabic Perfumes', 'description' => 'Traditional & Luxurious Oud'],
                    ];
                @endphp
                
                @foreach($categories as $categoryKey => $categoryData)
                    @php
                        $categoryProduct = \App\Models\Product::where('category', $categoryKey)->first();
                    @endphp
                    <div class="col-lg-3 col-md-6 mb-4">
                        <a href="{{ route('shop') }}" class="category-card-link">
                            <div class="category-card">
                                <div class="category-image">
                                    @if($categoryProduct && $categoryProduct->image)
                                        <img src="{{ asset($categoryProduct->image) }}" alt="{{ $categoryData['title'] }}" loading="lazy">
                                    @else
                                        <img src="{{ asset('frontend/images/perfume-placeholder.jpg') }}" alt="{{ $categoryData['title'] }}">
                                    @endif
                                </div>
                                <h5>{{ $categoryData['title'] }}</h5>
                                <p>{{ $categoryData['description'] }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
    </section>

    <!-- Guest Gift Section -->
    <section class="page-content guest-gift-section">
        <div class="container">
            <p class="collection-label">SPECIAL OFFER</p>
            <h2 class="section-title">Guest Gift</h2>
            <p class="section-subtitle">Every guest who visits us receives a special gift. Explore our exclusive collection of complimentary gifts.</p>
            
            <div class="row" id="guestGiftContainer">
                @forelse($guestGifts as $gift)
                    <div class="col-lg-4 col-md-6 mb-4 guest-gift-item" style="display: {{ $loop->index < 6 ? 'block' : 'none' }};">
                        <div class="guest-gift-card" onclick="openGuestGiftModal('{{ $gift->title }}', '{{ asset($gift->image) }}')">
                            <div class="guest-gift-image-container">
                                <img src="{{ asset($gift->image) }}" alt="{{ $gift->title }}" class="guest-gift-image" loading="lazy">
                            </div>
                            <div class="guest-gift-overlay">
                                <div class="guest-gift-text">
                                    <h5>{{ $gift->title }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">No guest gifts available</p>
                    </div>
                @endforelse
            </div>

            @if($guestGifts->count() > 6)
                <div class="text-center mt-4">
                    <button class="btn btn-show-more" id="showMoreBtn" onclick="showMoreGifts()">
                        <i class="fas fa-plus-circle"></i> Show More
                    </button>
                    <button class="btn btn-show-more" id="showLessBtn" onclick="showLessGifts()" style="display: none;">
                        <i class="fas fa-minus-circle"></i> Show Less
                    </button>
                </div>
            @endif
        </div>
    </section>

    <!-- Best Sellers Section -->
    <section class="page-content best-selling-perfumes">
        <div class="container">
            <p class="collection-label">{{ $perfumePage->best_sellers_subtitle ?? 'MOST LOVED' }}</p>
            <h2 class="section-title">{{ $perfumePage->best_sellers_title ?? 'Best Sellers' }}</h2>
            
            <div class="row">
                @forelse($bestSellers as $perfume)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="best-seller-card-perfume">
                            <div class="best-seller-image">
                                <a href="{{ route('product.detail', $perfume->id) }}" class="product-image-link">
                                    <img src="{{ asset($perfume->image ?? 'frontend/images/perfume1.jpg') }}" alt="{{ $perfume->name }} - Best Selling Perfume" loading="lazy">
                                </a>
                                @if($perfume->discount_percentage)
                                    <span class="sale-badge">-{{ $perfume->discount_percentage }}%</span>
                                @endif
                            </div>
                            <div class="best-seller-content">
                                <h5>{{ $perfume->name }}</h5>
                                <div class="rating-perfume">
                                    @for($i = 0; $i < floor($perfume->rating); $i++)
                                        <i class="fas fa-star" style="color: #FFD700;"></i>
                                    @endfor
                                    @if($perfume->rating % 1 != 0)
                                        <i class="fas fa-star-half-alt" style="color: #FFD700;"></i>
                                    @endif
                                    <span>({{ $perfume->reviews_count }} reviews)</span>
                                </div>
                                @if($perfume->price)
                                    <div class="price-section-perfume">
                                        <p class="price-perfume">Rs {{ number_format($perfume->price) }}</p>
                                        @if($perfume->original_price)
                                            <p class="original-price-perfume"><s>Rs {{ number_format($perfume->original_price) }}</s></p>
                                        @endif
                                    </div>
                                @elseif($perfume->original_price)
                                    <div class="price-section-perfume">
                                        <p class="price-perfume">Rs {{ number_format($perfume->original_price) }}</p>
                                    </div>
                                @endif
                                <button class="btn-shop-now-perfume add-to-cart-btn" 
                                        data-product-id="{{ $perfume->id }}" 
                                        data-product-name="{{ $perfume->name }}" 
                                        data-product-price="{{ $perfume->price ?? $perfume->original_price ?? 0 }}" 
                                        data-product-image="{{ asset($perfume->image) }}">
                                    <i class="fas fa-shopping-cart"></i> Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">No best sellers available at the moment.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Trust Badges Section -->
    <section class="trust-badges-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="trust-badge">
                        <i class="fas fa-check-circle"></i>
                        <h5>100% Original</h5>
                        <p>Authentic luxury perfumes</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="trust-badge">
                        <i class="fas fa-truck"></i>
                        <h5>Free Shipping</h5>
                        <p>On orders above Rs 4,000</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="trust-badge">
                        <i class="fas fa-lock"></i>
                        <h5>Secure Payment</h5>
                        <p>100% safe transactions</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="trust-badge">
                        <i class="fas fa-undo"></i>
                        <h5>Easy Returns</h5>
                        <p>15-day return policy</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Brand Section -->
    <section class="page-content about-brand-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4">
                    <img src="{{ asset($homePage->about_image ?? 'frontend/images/perfume5.jfif') }}" alt="Almukhtar Perfume - Luxury Brand" class="img-fluid about-image" loading="lazy" style="width: 100%; height: auto; max-height: 400px; object-fit: cover;">
                </div>
                <div class="col-lg-6">
                    <p class="collection-label">ABOUT US</p>
                    <h2 class="section-title">{{ $homePage->about_heading }}</h2>
                    <p class="about-text">
                        {{ $homePage->about_description ?? 'Almukhtar Perfume represents the pinnacle of luxury fragrance craftsmanship. With decades of expertise in perfumery, we curate the finest collection of long-lasting fragrances from around the world.' }}
                    </p>
                    <p class="about-text">
                        Each scent in our collection is carefully selected for its authenticity, quality, and ability to evoke emotion. We believe that a perfect fragrance is more than just a scent — it's a statement of elegance and sophistication.
                    </p>
                    <ul class="about-features">
                        @forelse($homePage->about_features ?? [] as $feature)
                            <li><i class="fas fa-check"></i> {{ $feature }}</li>
                        @empty
                            <li><i class="fas fa-check"></i> Premium quality fragrances</li>
                            <li><i class="fas fa-check"></i> Long-lasting scents</li>
                            <li><i class="fas fa-check"></i> Authentic & original products</li>
                            <li><i class="fas fa-check"></i> Expert curation</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter-section">
        <div class="container">
            <div class="newsletter-content">
                <h2>Subscribe & Get 10% Off</h2>
                <p>Join our exclusive community and receive special offers on luxury perfumes</p>
                <form class="newsletter-form" id="newsletterForm">
                    <input type="email" id="newsletterEmail" placeholder="Enter your email" required>
                    <button type="submit" class="btn-subscribe">Subscribe</button>
                </form>
            </div>
        </div>
    </section>

    <style>
        /* About Section Image Styles */
        .about-brand-section {
            overflow: visible;
        }

        .about-image {
            width: 100% !important;
            height: auto !important;
            max-height: 400px !important;
            display: block !important;
        }

        .btn-subscribe:hover {
            background-color: #333333;
            transform: translateY(-2px);
        }

        /* Guest Gift Section Styles */
        .guest-gift-section {
            background-color: #ffffff;
            padding: 4rem 0;
        }

        .guest-gift-card {
            position: relative;
            overflow: hidden;
            border-radius: 12px;
            height: 250px;
            cursor: pointer;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .guest-gift-card:hover {
            box-shadow: 0 15px 40px rgba(200, 169, 106, 0.25);
            transform: translateY(-8px);
        }

        .guest-gift-image-container {
            width: 100%;
            height: 100%;
            overflow: hidden;
            position: relative;
        }

        .guest-gift-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .guest-gift-card:hover .guest-gift-image {
            transform: scale(1.1);
        }

        .guest-gift-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0.6) 100%);
            display: flex;
            align-items: flex-end;
            padding: 2rem;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 2;
        }

        .guest-gift-card:hover .guest-gift-overlay {
            opacity: 1;
        }

        .guest-gift-text {
            color: #ffffff;
            width: 100%;
            animation: slideUp 0.3s ease forwards;
        }

        @keyframes slideUp {
            from {
                transform: translateY(20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .guest-gift-text h5 {
            color: #ffffff;
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 0.8rem;
            margin-top: 0;
        }

        .guest-gift-text p {
            color: #e0e0e0;
            font-size: 0.95rem;
            line-height: 1.6;
            margin: 0;
        }

        /* Show More Button */
        .btn-show-more {
            background-color: #000000;
            color: #ffffff;
            border: 2px solid #000000;
            padding: 0.8rem 2.5rem;
            border-radius: 6px;
            font-weight: 700;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
        }

        .btn-show-more:hover {
            background-color: #333333;
            border-color: #333333;
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        .btn-show-more i {
            font-size: 1.1rem;
        }

        /* Best Sellers Section Styles (matching perfume page) */
        .best-selling-perfumes {
            background-color: #f9f9f9;
            padding: 4rem 0;
        }

        .best-seller-card-link {
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .best-seller-card-perfume {
            background-color: #ffffff;
            border: 1px solid #e8e8e8;
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s ease;
            text-align: center;
            height: 100%;
        }

        .best-seller-card-link:hover .best-seller-card-perfume {
            border-color: #000000;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
            transform: translateY(-8px);
        }

        .product-image-link {
            display: block;
            overflow: hidden;
            cursor: pointer;
        }

        .best-seller-image {
            width: 100%;
            height: 300px;
            overflow: hidden;
            background-color: #f5f5f5;
            position: relative;
        }

        .best-seller-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .best-seller-card-perfume:hover .best-seller-image img {
            transform: scale(1.1);
        }

        .sale-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            background: linear-gradient(135deg, #ff6b6b 0%, #ff5252 100%);
            color: #ffffff;
            padding: 0.5rem 0.8rem;
            border-radius: 6px;
            font-weight: 700;
            font-size: 0.85rem;
            z-index: 10;
            box-shadow: 0 3px 10px rgba(255, 107, 107, 0.3);
        }

        .best-seller-content {
            padding: 2rem 1.5rem;
        }

        .best-seller-card-perfume h5 {
            color: #000000;
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .rating-perfume {
            color: #000000;
            font-size: 0.9rem;
            margin-bottom: 0.8rem;
        }

        .rating-perfume span {
            color: #666666;
            margin-left: 0.5rem;
            font-size: 0.85rem;
        }

        .price-section-perfume {
            display: flex;
            gap: 0.8rem;
            align-items: center;
            justify-content: center;
            margin: 0.5rem 0 1rem 0;
        }

        .price-perfume {
            font-size: 1.1rem;
            color: #000000;
            font-weight: 700;
            margin: 0;
        }

        .original-price-perfume {
            font-size: 0.75rem;
            color: #999999;
            margin: 0;
            font-weight: 600;
        }

        .btn-shop-now-perfume {
            background-color: #000000;
            color: #ffffff;
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 6px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .best-seller-card-perfume:hover .btn-shop-now-perfume {
            background-color: #333333;
            color: #ffffff;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        .collection-label {
            text-align: center;
            color: #999999;
            font-size: 0.85rem;
            font-weight: 700;
            letter-spacing: 2px;
            margin-bottom: 0.5rem;
        }

        .section-title {
            text-align: center;
            color: #000000;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 3rem;
        }

        @media (max-width: 768px) {
            .guest-gift-card {
                height: 280px;
            }

            .guest-gift-text h5 {
                font-size: 1.1rem;
                margin-bottom: 0.5rem;
            }

            .guest-gift-text p {
                font-size: 0.85rem;
            }

            .guest-gift-overlay {
                padding: 1.5rem;
            }

            .product-image {
                height: 250px;
            }

            .product-footer {
                flex-direction: column;
                gap: 0.5rem;
            }

            .btn-view-details {
                width: 100%;
            }

            .best-seller-image {
                height: 250px;
            }

            .hero-text h1 {
                font-size: 2.5rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .newsletter-content h2 {
                font-size: 1.8rem;
            }
        }

        /* Swiper Styles */
        .swiper {
            padding: 2rem 0;
        }

        .swiper-button-next,
        .swiper-button-prev {
            background-color: rgba(26, 124, 58, 0.9);
            width: 45px;
            height: 45px;
            border-radius: 50%;
            color: #ffffff;
            transition: all 0.3s ease;
            top: 50%;
            transform: translateY(-50%);
        }

        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            background-color: #1a7c3a;
            transform: translateY(-50%) scale(1.15);
        }

        .swiper-button-next::after,
        .swiper-button-prev::after {
            font-size: 1.2rem;
        }

        .swiper-pagination-bullet {
            background-color: #ddd;
            opacity: 1;
            transition: all 0.3s ease;
            width: 12px;
            height: 12px;
        }

        .swiper-pagination-bullet-active {
            background-color: #1a7c3a;
            width: 32px;
            border-radius: 6px;
        }

        .swiper-pagination-bullet:hover {
            background-color: #1a7c3a;
        }

        /* Guest Gift Modal Styles */
        .guest-gift-modal-dialog {
            max-width: 600px;
        }

        .guest-gift-modal-content {
            border: none;
            border-radius: 8px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            background-color: #ffffff;
        }

        .guest-gift-close-btn {
            position: absolute;
            top: 12px;
            right: 12px;
            z-index: 10;
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }

        .guest-gift-close-btn:hover {
            background-color: rgba(0, 0, 0, 0.7);
        }

        .guest-gift-modal-body {
            padding: 0;
            background-color: #ffffff;
            text-align: center;
        }

        .guest-gift-modal-image {
            width: 100%;
            height: 400px;
            display: block;
            border-radius: 0;
            box-shadow: none;
            transition: transform 0.3s ease;
            object-fit: cover;
        }

        .guest-gift-modal-image:hover {
            transform: scale(1.02);
        }

        .guest-gift-modal-title {
            color: #000000;
            font-size: 1.1rem;
            font-weight: 700;
            margin: 1.2rem 1rem;
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .guest-gift-modal-title {
                font-size: 1rem;
                margin: 1rem 0.8rem;
            }

            .guest-gift-close-btn {
                width: 32px;
                height: 32px;
                top: 8px;
                right: 8px;
            }

            .guest-gift-modal-dialog {
                max-width: 90%;
            }

            .guest-gift-modal-image {
                height: 300px;
            }

            .guest-gift-modal-image {
                max-width: 100%;
            }

            .guest-gift-modal-header .modal-title {
                font-size: 1.1rem;
            }
        }
    </style>

    <script>
        // ================================================
        // HERO SLIDER
        // ================================================
        let currentSlideIndex = 0;
        let autoSlideTimer = null;
        let slides, indicators, totalSlides;

        function getDeviceType() {
            const width = window.innerWidth;
            if (width <= 768) return 'mobile';
            if (width <= 1024) return 'tablet';
            return 'laptop';
        }

        function updateHeroImages() {
            const slideElements = document.querySelectorAll('.hero-slide');
            const deviceType = getDeviceType();
            
            slideElements.forEach((slide) => {
                const imageUrl = slide.getAttribute(`data-${deviceType}`);
                if (imageUrl) {
                    slide.style.backgroundImage = `url('${imageUrl}?v=${Date.now()}')`;
                }
            });
        }

        function showSlide(n) {
            if (!slides || slides.length === 0) return;

            // Wrap around
            if (n >= totalSlides) {
                currentSlideIndex = 0;
            } else if (n < 0) {
                currentSlideIndex = totalSlides - 1;
            } else {
                currentSlideIndex = n;
            }

            // Remove active class
            slides.forEach(slide => slide.classList.remove('active'));
            indicators.forEach(indicator => indicator.classList.remove('active'));

            // Add active class
            if (slides[currentSlideIndex]) {
                slides[currentSlideIndex].classList.add('active');
            }
            if (indicators[currentSlideIndex]) {
                indicators[currentSlideIndex].classList.add('active');
            }

            console.log('Hero slide:', currentSlideIndex);
        }

        function autoSlide() {
            if (totalSlides > 0) {
                currentSlideIndex = (currentSlideIndex + 1) % totalSlides;
                showSlide(currentSlideIndex);
            }
        }

        function startAutoSlide() {
            if (autoSlideTimer) clearInterval(autoSlideTimer);
            autoSlideTimer = setInterval(autoSlide, 5000);
            console.log('Auto slide started');
        }

        function stopAutoSlide() {
            if (autoSlideTimer) {
                clearInterval(autoSlideTimer);
                autoSlideTimer = null;
            }
        }

        function changeSlide(n) {
            stopAutoSlide();
            showSlide(currentSlideIndex + n);
            startAutoSlide();
        }

        function currentSlide(n) {
            stopAutoSlide();
            showSlide(n);
            startAutoSlide();
        }

        // Initialize hero slider
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Initializing hero slider...');
            
            slides = document.querySelectorAll('.hero-slide');
            indicators = document.querySelectorAll('.indicator');
            totalSlides = slides.length;

            console.log('Total slides:', totalSlides);

            if (totalSlides > 0) {
                updateHeroImages();
                showSlide(0);
                startAutoSlide();
            }

            window.addEventListener('resize', updateHeroImages);

            // Initialize dynamic text styling and start rotation
            const heroDynamicElement = document.getElementById('heroDynamicText');
            if (heroDynamicElement) {
                heroDynamicElement.style.transition = 'opacity 0.6s ease-in-out';
                startDynamicTextRotation();
            }
        });

        // ================================================
        // HERO DYNAMIC TEXT - Independent of Slider
        // ================================================
        const dynamicTexts = ['LUXURY', 'ELEGANCE', 'FRAGRANCE'];
        let dynamicTextIndex = 0;
        let dynamicTextTimer;

        function updateDynamicText() {
            const heroDynamicElement = document.getElementById('heroDynamicText');
            
            if (!heroDynamicElement) return;

            // Fade out
            heroDynamicElement.style.opacity = '0';

            setTimeout(() => {
                // Move to next text
                dynamicTextIndex = (dynamicTextIndex + 1) % dynamicTexts.length;
                
                // Change text
                heroDynamicElement.textContent = dynamicTexts[dynamicTextIndex];
                
                // Fade in
                heroDynamicElement.style.opacity = '1';
                console.log('Hero text changed to:', dynamicTexts[dynamicTextIndex]);
            }, 300);
        }

        function startDynamicTextRotation() {
            if (dynamicTextTimer) clearInterval(dynamicTextTimer);
            dynamicTextTimer = setInterval(updateDynamicText, 3000); // Change text every 3 seconds
            console.log('Dynamic text rotation started');
        }

        function stopDynamicTextRotation() {
            if (dynamicTextTimer) {
                clearInterval(dynamicTextTimer);
                dynamicTextTimer = null;
            }
        }
    </script>

    <script>
        function addToCart(productId, productName, productPrice, productImage) {
            // Validate inputs
            if (!productId || !productName || !productPrice || !productImage) {
                console.error('Invalid product data:', { productId, productName, productPrice, productImage });
                alert('Error: Invalid product data');
                return;
            }

            const product = {
                id: parseInt(productId),
                name: productName.trim(),
                price: parseFloat(productPrice),
                image: productImage,
                quantity: 1
            };

            // Check if cart manager is available
            if (typeof cartManager === 'undefined' || !cartManager) {
                console.error('Cart manager not available');
                alert('Error: Cart system not loaded. Please refresh the page.');
                return;
            }

            // Add item to cart
            try {
                cartManager.addItem(product);
                showNotification('Added to cart!');
                console.log('Product added to cart:', product);
            } catch (error) {
                console.error('Error adding to cart:', error);
                alert('Error adding to cart. Please try again.');
            }
        }

        // Initialize Add to Cart Button Listeners  
        let addToCartListenerAttached = false;
        
        function initializeAddToCartButtons() {
            // Only attach listener once using event delegation
            if (addToCartListenerAttached) {
                return;
            }
            
            addToCartListenerAttached = true;
            
            document.addEventListener('click', function(e) {
                const button = e.target.closest('.add-to-cart-btn');
                if (!button) return;
                
                e.preventDefault();
                e.stopPropagation();
                
                // Prevent double-click by disabling button temporarily
                if (button.hasAttribute('data-adding-to-cart')) {
                    console.log('Button already processing, ignoring click');
                    return;
                }
                
                button.setAttribute('data-adding-to-cart', 'true');
                button.disabled = true;
                
                const productId = button.getAttribute('data-product-id');
                const productName = button.getAttribute('data-product-name');
                const productPrice = button.getAttribute('data-product-price');
                const productImage = button.getAttribute('data-product-image');
                
                console.log('Add to cart clicked:', { productId, productName, productPrice, productImage });
                
                addToCart(productId, productName, productPrice, productImage);
                
                // Re-enable button after 1.5 seconds
                setTimeout(function() {
                    button.removeAttribute('data-adding-to-cart');
                    button.disabled = false;
                }, 1500);
            }, true);
            
            console.log('Add to cart event listener attached (using event delegation)');
        }

        // Initialize on DOM ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(initializeAddToCartButtons, 100);
            });
        } else {
            // DOM already loaded
            setTimeout(initializeAddToCartButtons, 100);
        }

        // Show notification
        function showNotification(message) {
            const notification = document.createElement('div');
            notification.className = 'cart-notification';
            notification.innerHTML = '<i class="fas fa-check-circle"></i><span>' + message + '</span>';
            document.body.appendChild(notification);

            setTimeout(function() {
                notification.classList.add('show');
            }, 10);

            setTimeout(function() {
                notification.classList.remove('show');
                setTimeout(function() {
                    notification.remove();
                }, 300);
            }, 2000);
        }
    </script>


    <!-- Order Modal -->
    <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content order-modal-content">
                <div class="modal-header order-modal-header">
                    <h5 class="modal-title" id="orderModalLabel">
                        <i class="fas fa-shopping-bag"></i> Quick Order - <span id="productName">Product</span>
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body order-modal-body">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <img id="productImage" src="" alt="Product" class="order-product-image">
                            <p class="order-product-price mt-3">
                                <strong>Rs <span id="productPrice">0</span></strong>
                            </p>
                        </div>
                        <div class="col-md-8">
                            <form id="orderForm" class="order-form">
                                <div class="mb-3">
                                    <label for="customerName" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="customerName" placeholder="Enter your full name" required>
                                </div>

                                <div class="mb-3">
                                    <label for="customerEmail" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="customerEmail" placeholder="Enter your email" required>
                                </div>

                                <div class="mb-3">
                                    <label for="customerPhone" class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" id="customerPhone" placeholder="Enter your phone number" required>
                                </div>

                                <div class="mb-3">
                                    <label for="customerAddress" class="form-label">Delivery Address</label>
                                    <textarea class="form-control" id="customerAddress" rows="3" placeholder="Enter your complete delivery address" required></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="quantity" class="form-label">Quantity</label>
                                    <div class="quantity-selector">
                                        <button type="button" class="qty-btn" onclick="decreaseQty()">-</button>
                                        <input type="number" id="quantity" value="1" min="1" readonly>
                                        <button type="button" class="qty-btn" onclick="increaseQty()">+</button>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="paymentMethod" class="form-label">Payment Method</label>
                                    <select class="form-select" id="paymentMethod" required>
                                        <option value="">Select payment method</option>
                                        <option value="cod">Cash on Delivery</option>
                                        <option value="bank">Bank Transfer</option>
                                        <option value="card">Credit/Debit Card</option>
                                    </select>
                                </div>

                                <div class="order-summary">
                                    <div class="summary-row">
                                        <span>Subtotal:</span>
                                        <span>Rs <span id="subtotal">0</span></span>
                                    </div>
                                    <div class="summary-row">
                                        <span>Shipping:</span>
                                        <span>Rs <span id="shipping">0</span></span>
                                    </div>
                                    <div class="summary-row total">
                                        <span>Total:</span>
                                        <span>Rs <span id="total">0</span></span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer order-modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-order" onclick="submitOrder()">
                        <i class="fas fa-check-circle"></i> Place Order
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Guest Gift Modal -->
    <div class="modal fade" id="guestGiftModal" tabindex="-1" aria-labelledby="guestGiftModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered guest-gift-modal-dialog">
            <div class="modal-content guest-gift-modal-content">
                <button type="button" class="btn-close btn-close-white guest-gift-close-btn" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body guest-gift-modal-body">
                    <img id="giftImage" src="" alt="Gift" class="guest-gift-modal-image">
                    <h5 id="giftTitle" class="guest-gift-modal-title">Gift</h5>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentProductPrice = 0;

        function openGuestGiftModal(title, image) {
            document.getElementById('giftTitle').textContent = title;
            document.getElementById('giftImage').src = image;
            
            const modal = new bootstrap.Modal(document.getElementById('guestGiftModal'));
            modal.show();
        }

        function showMoreGifts() {
            const items = document.querySelectorAll('.guest-gift-item');
            let hiddenCount = 0;
            
            items.forEach((item) => {
                if (item.style.display === 'none' && hiddenCount < 6) {
                    item.style.display = 'block';
                    hiddenCount++;
                }
            });
            
            // Check if all items are now visible
            const remainingHidden = Array.from(items).some(item => item.style.display === 'none');
            if (!remainingHidden) {
                document.getElementById('showMoreBtn').style.display = 'none';
                document.getElementById('showLessBtn').style.display = 'inline-flex';
            }
        }

        function showLessGifts() {
            const items = document.querySelectorAll('.guest-gift-item');
            
            items.forEach((item, index) => {
                if (index >= 6) {
                    item.style.display = 'none';
                }
            });
            
            document.getElementById('showMoreBtn').style.display = 'inline-flex';
            document.getElementById('showLessBtn').style.display = 'none';
        }

        function requestGift() {
            const giftTitle = document.getElementById('giftTitle').textContent;
            alert(`Thank you for your interest in "${giftTitle}"! Please visit our store or contact us to claim this complimentary gift.`);
        }

        function setProductData(btn, productName, price, image) {
            currentProductPrice = price;
            document.getElementById('productName').textContent = productName;
            document.getElementById('productPrice').textContent = price.toLocaleString();
            document.getElementById('productImage').src = '{{ asset("") }}' + image;
            document.getElementById('quantity').value = 1;
            updateOrderSummary();
        }

        function increaseQty() {
            const qty = document.getElementById('quantity');
            qty.value = parseInt(qty.value) + 1;
            updateOrderSummary();
        }

        function decreaseQty() {
            const qty = document.getElementById('quantity');
            if (parseInt(qty.value) > 1) {
                qty.value = parseInt(qty.value) - 1;
                updateOrderSummary();
            }
        }

        function updateOrderSummary() {
            const quantity = parseInt(document.getElementById('quantity').value);
            const subtotal = currentProductPrice * quantity;
            const shipping = subtotal >= 2000 ? 0 : 300;
            const total = subtotal + shipping;

            document.getElementById('subtotal').textContent = subtotal.toLocaleString();
            document.getElementById('shipping').textContent = shipping.toLocaleString();
            document.getElementById('total').textContent = total.toLocaleString();
        }

        function submitOrder() {
            const form = document.getElementById('orderForm');
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            const orderData = {
                name: document.getElementById('customerName').value,
                email: document.getElementById('customerEmail').value,
                phone: document.getElementById('customerPhone').value,
                address: document.getElementById('customerAddress').value,
                quantity: document.getElementById('quantity').value,
                payment: document.getElementById('paymentMethod').value,
                product: document.getElementById('productName').textContent,
                price: currentProductPrice,
                total: document.getElementById('total').textContent
            };

            console.log('Order submitted:', orderData);
            alert('Order placed successfully! We will contact you soon.');
            
            // Reset form and close modal
            form.reset();
            document.getElementById('quantity').value = 1;
            const modal = bootstrap.Modal.getInstance(document.getElementById('orderModal'));
            modal.hide();
        }
    </script>

    <!-- Newsletter Subscription Script -->
    <script>
        document.getElementById('newsletterForm')?.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const email = document.getElementById('newsletterEmail').value;
            
            try {
                const response = await fetch('/api/subscribe', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                    },
                    body: JSON.stringify({ email: email })
                });
                
                const data = await response.json();
                
                if (response.ok) {
                    alert('Thank you for subscribing! Check your email for 10% off coupon.');
                    document.getElementById('newsletterForm').reset();
                } else {
                    alert(data.message || 'Subscription failed. Please try again.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            }
        });
    </script>

@endsection

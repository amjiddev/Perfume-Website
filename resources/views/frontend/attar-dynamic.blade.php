@extends('frontend.layouts.app')

@section('title', 'Premium Attar - Buy Alcohol-Free Perfume | Almukhtar Perfume')

@section('content')
    <!-- Hero Section with Carousel -->
    <section class="hero-section" id="attarHeroSlider">
        <div class="hero-slider-container">
            @for($i = 1; $i <= 4; $i++)
            <div class="hero-slide {{ $i === 1 ? 'active' : '' }}" id="attarHeroSlide{{ $i }}" style="background-image: url('{{ asset($attarPage->{'hero_image_' . $i} ?? 'frontend/images/perfume' . $i . '.jpg') }}?v={{ time() }}'); background-size: cover; background-position: center; background-repeat: no-repeat;"></div>
            @endfor
        </div>
        
        <div class="hero-overlay"></div>
        
        <div class="hero-content">
            <div class="hero-text">
                <h1>{{ $attarPage->hero_heading ?? 'Premium Attar' }}</h1>
                <p>{{ $attarPage->hero_subheading ?? 'Alcohol-free, long-lasting natural fragrances for the discerning' }}</p>
            </div>
        </div>

        <!-- Slider Controls -->
        <button class="slider-btn slider-btn-left" onclick="changeAttarSlide(-1)">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button class="slider-btn slider-btn-right" onclick="changeAttarSlide(1)">
            <i class="fas fa-chevron-right"></i>
        </button>

        <!-- Slider Indicators -->
        <div class="hero-slider-indicators">
            <span class="indicator active" onclick="currentAttarSlide(0)"></span>
            <span class="indicator" onclick="currentAttarSlide(1)"></span>
            <span class="indicator" onclick="currentAttarSlide(2)"></span>
            <span class="indicator" onclick="currentAttarSlide(3)"></span>
        </div>
    </section>

    <!-- Products Section -->
    <section class="page-content attar-section">
        <div class="container">
            <!-- Products Grid -->
            <div class="products-grid" id="attarGrid">
                @forelse($attarProducts as $index => $product)
                    <div class="product-card-attar" data-index="{{ $index }}" style="display: {{ $index < 4 ? 'flex' : 'none' }};">
                        <div class="product-image-wrapper">
                            @if($product->image)
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }} - Alcohol-Free Attar" loading="lazy">
                            @else
                                <div style="width: 100%; height: 100%; background-color: #f5f5f5; display: flex; align-items: center; justify-content: center; color: #ccc; font-size: 0.9rem;">
                                    No Image
                                </div>
                            @endif
                            @if($product->discount_percentage)
                                <span class="sale-badge">-{{ $product->discount_percentage }}%</span>
                            @endif
                            <span class="attar-badge">Alcohol-Free</span>
                        </div>
                        <div class="product-info">
                            <h5>{{ $product->name }}</h5>
                            <p class="attar-type">{{ $product->type }}</p>
                            <p class="product-desc">{{ $product->description }}</p>
                            <div class="rating-attar">
                                @for($i = 0; $i < floor($product->rating); $i++)
                                    <i class="fas fa-star" style="color: #FFD700;"></i>
                                @endfor
                                @if($product->rating % 1 != 0)
                                    <i class="fas fa-star-half-alt" style="color: #FFD700;"></i>
                                @endif
                                <span>({{ $product->reviews_count }})</span>
                            </div>
                            <div class="price-section-attar">
                                <p class="price-attar">Rs {{ number_format($product->price ?? $product->original_price, 0) }}</p>
                                @if($product->price && $product->original_price > $product->price)
                                    <p class="original-price-attar"><s>Rs {{ number_format($product->original_price, 0) }}</s></p>
                                @endif
                            </div>
                            <a href="{{ route('attar.detail', $product->id) }}" class="btn-view-details-attar">View Details</a>
                        </div>
                    </div>
                @empty
                    <div style="grid-column: 1 / -1; text-align: center; padding: 3rem;">
                        <p class="text-muted">No attar products available yet.</p>
                    </div>
                @endforelse
            </div>

            @if($attarProducts->count() > 4)
                <!-- Show More/Less Button -->
                <div class="show-more-container">
                    <button class="btn-show-more" id="attarShowMoreBtn" onclick="toggleAttar()">
                        <i class="fas fa-chevron-down"></i> Show More
                    </button>
                </div>
            @endif
        </div>
    </section>

    @if($attarPage->benefits_section_enabled)
    <!-- Why Choose Attar Section -->
    <section class="why-choose-attar">
        <div class="container">
            <p class="collection-label">{{ $attarPage->why_choose_subtitle }}</p>
            <h2 class="section-title">{{ $attarPage->why_choose_title }}</h2>
            
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="fas fa-leaf"></i>
                        </div>
                        <h5>Alcohol-Free</h5>
                        <p>Pure natural oils without any alcohol content, perfect for sensitive skin</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="fas fa-hourglass-end"></i>
                        </div>
                        <h5>Long-Lasting</h5>
                        <p>Concentrated oils that last 12+ hours on skin, providing exceptional longevity</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h5>Skin-Friendly</h5>
                        <p>Gentle on all skin types, no irritation or dryness from alcohol</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="fas fa-gem"></i>
                        </div>
                        <h5>Premium Quality</h5>
                        <p>Sourced from the finest natural ingredients and traditional methods</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <style>
        /* Attar Page Specific Styles */
        .attar-section {
            background-color: #ffffff;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .product-card-attar {
            background-color: #ffffff;
            border: 1px solid #e8e8e8;
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .product-image-wrapper {
            position: relative;
            width: 100%;
            height: 280px;
            overflow: hidden;
        }

        .product-card-attar:hover {
            border-color: #000000;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .product-card-attar:hover .product-image-wrapper img {
            transform: scale(1.08);
        }

        .attar-badge {
            position: absolute;
            bottom: 12px;
            left: 12px;
            background-color: #C8A96A;
            color: #ffffff;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            z-index: 5;
        }

        .sale-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            background-color: #C8A96A;
            color: #ffffff;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 600;
            z-index: 5;
        }

        .product-image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .product-info {
            padding: 1.5rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .product-card-attar h5 {
            color: #000000;
            font-weight: 700;
            margin: 0 0 0.5rem 0;
            font-size: 1.1rem;
        }

        .attar-type {
            color: #000000;
            font-size: 0.85rem;
            font-weight: 600;
            margin: 0 0 0.5rem 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .product-desc {
            color: #666666;
            font-size: 0.85rem;
            margin: 0.5rem 0;
            flex: 1;
        }

        .rating-attar {
            color: #FFD700;
            font-size: 0.9rem;
            margin: 0.75rem 0;
        }

        .rating-attar span {
            color: #666666;
            margin-left: 0.5rem;
        }

        .price-section-attar {
            display: flex;
            gap: 0.8rem;
            margin: 1rem 0;
            align-items: center;
        }

        .price-attar {
            font-size: 1.1rem;
            color: #000000;
            font-weight: 700;
            margin: 0;
        }

        .original-price-attar {
            font-size: 0.75rem;
            color: #999999;
            margin: 0;
        }

        .btn-view-details-attar {
            background-color: #000000;
            color: #ffffff;
            border: 1px solid #000000;
            padding: 0.75rem 1.5rem;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            text-align: center;
            margin-top: auto;
        }

        .btn-view-details-attar:hover {
            background-color: #333333;
            border-color: #333333;
            color: #ffffff;
        }

        .show-more-container {
            text-align: center;
            margin: 2rem 0;
        }

        .btn-show-more {
            background-color: #000000;
            color: #ffffff;
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .btn-show-more:hover {
            background-color: #333333;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Why Choose Attar Section */
        .why-choose-attar {
            background-color: #f9f9f9;
            padding: 4rem 0;
        }

        .collection-label {
            color: #999999;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 3px;
            text-transform: uppercase;
            display: block;
            text-align: center;
            margin-bottom: 0.5rem;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #000000;
            text-align: center;
            margin: 0 0 3rem 0;
        }

        .benefit-card {
            background-color: #ffffff;
            border: 1px solid #e8e8e8;
            border-radius: 8px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            height: 100%;
        }

        .benefit-card:hover {
            border-color: #C8A96A;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            transform: translateY(-4px);
        }

        .benefit-icon {
            font-size: 2.5rem;
            color: #C8A96A;
            margin-bottom: 1rem;
        }

        .benefit-card h5 {
            color: #000000;
            font-weight: 700;
            margin: 1rem 0;
        }

        .benefit-card p {
            color: #666666;
            font-size: 0.9rem;
            line-height: 1.6;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .products-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1.5rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .product-image-wrapper {
                height: 200px;
            }

            .product-info {
                padding: 1rem;
            }
        }

        @media (max-width: 480px) {
            .products-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .section-title {
                font-size: 1.5rem;
            }

            .product-image-wrapper {
                height: 180px;
            }

            .why-choose-attar {
                padding: 2rem 0;
            }

            .benefit-card {
                padding: 1.5rem;
            }
        }
    </style>

    <script>
        let attarExpanded = false;

        function toggleAttar() {
            const cards = document.querySelectorAll('#attarGrid .product-card-attar');
            const btn = document.getElementById('attarShowMoreBtn');
            
            attarExpanded = !attarExpanded;
            
            cards.forEach((card, index) => {
                if (attarExpanded) {
                    // Show up to 8 cards
                    if (index < 8) {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
                } else {
                    // Show only first 4 cards
                    card.style.display = index < 4 ? 'flex' : 'none';
                }
            });
            
            // Update button text and icon
            if (attarExpanded) {
                btn.innerHTML = '<i class="fas fa-chevron-up"></i> Show Less';
                btn.classList.add('expanded');
            } else {
                btn.innerHTML = '<i class="fas fa-chevron-down"></i> Show More';
                btn.classList.remove('expanded');
            }
        }

        // ================================================
        // ATTAR HERO SLIDER
        // ================================================
        let currentAttarSlideIndex = 0;
        let attarAutoSlideTimer = null;
        let attarSlides, attarIndicators, attarTotalSlides;

        function initializeAttarSlider() {
            const sliderId = 'attarHeroSlider';
            attarSlides = document.querySelectorAll(`#${sliderId} .hero-slide`);
            attarIndicators = document.querySelectorAll(`#${sliderId} .indicator`);
            attarTotalSlides = attarSlides.length;

            if (attarTotalSlides > 0) {
                startAttarAutoSlide();
                console.log('Attar slider initialized with', attarTotalSlides, 'slides');
            }
        }

        function showAttarSlide(n) {
            if (!attarSlides || attarSlides.length === 0) return;

            if (n >= attarTotalSlides) {
                currentAttarSlideIndex = 0;
            } else if (n < 0) {
                currentAttarSlideIndex = attarTotalSlides - 1;
            } else {
                currentAttarSlideIndex = n;
            }

            attarSlides.forEach(slide => slide.classList.remove('active'));
            attarIndicators.forEach(indicator => indicator.classList.remove('active'));

            if (attarSlides[currentAttarSlideIndex]) {
                attarSlides[currentAttarSlideIndex].classList.add('active');
            }
            if (attarIndicators[currentAttarSlideIndex]) {
                attarIndicators[currentAttarSlideIndex].classList.add('active');
            }

            console.log('Attar slide:', currentAttarSlideIndex);
        }

        function autoSlideAttar() {
            if (attarTotalSlides > 0) {
                currentAttarSlideIndex = (currentAttarSlideIndex + 1) % attarTotalSlides;
                showAttarSlide(currentAttarSlideIndex);
            }
        }

        function startAttarAutoSlide() {
            if (attarAutoSlideTimer) clearInterval(attarAutoSlideTimer);
            attarAutoSlideTimer = setInterval(autoSlideAttar, 5000);
            console.log('Attar auto slide started');
        }

        function stopAttarAutoSlide() {
            if (attarAutoSlideTimer) {
                clearInterval(attarAutoSlideTimer);
                attarAutoSlideTimer = null;
            }
        }

        function changeAttarSlide(n) {
            stopAttarAutoSlide();
            showAttarSlide(currentAttarSlideIndex + n);
            startAttarAutoSlide();
        }

        function currentAttarSlide(n) {
            stopAttarAutoSlide();
            showAttarSlide(n);
            startAttarAutoSlide();
        }

        // Initialize on page load
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initializeAttarSlider);
        } else {
            initializeAttarSlider();
        }
    </script>
@endsection

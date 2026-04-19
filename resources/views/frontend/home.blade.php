@extends('frontend.layouts.app')

@section('title', 'Home - Almukhtar Perfume | Luxury Fragrances')

@section('content')
    <!-- Hero Section with Slider -->
    <section class="hero-section" id="heroSlider">
        <div class="hero-slider-container">
            <div class="hero-slide" style="background-image: url('{{ asset('frontend/images/perfume1.jpg') }}');"></div>
            <div class="hero-slide" style="background-image: url('{{ asset('frontend/images/perfume2.jpg') }}');"></div>
        </div>
        
        <div class="hero-overlay"></div>
        
        <div class="hero-content">
            <div class="hero-text">
                <h1>Discover Luxury</h1>
                <p>Experience the finest collection of premium fragrances from around the world. Each scent tells a story of elegance and sophistication.</p>
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
                <div class="col-lg-3 col-md-6 mb-4">
                    <a href="{{ route('shop') }}" class="category-card-link">
                        <div class="category-card">
                            <div class="category-image">
                                <img src="{{ asset('frontend/images/perfume2.jpg') }}" alt="Perfumes for Men">
                            </div>
                            <h5>For Men</h5>
                            <p>Bold & Masculine Fragrances</p>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <a href="{{ route('shop') }}" class="category-card-link">
                        <div class="category-card">
                            <div class="category-image">
                                <img src="{{ asset('frontend/images/perfume3.jfif') }}" alt="Perfumes for Women">
                            </div>
                            <h5>For Women</h5>
                            <p>Elegant & Feminine Scents</p>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <a href="{{ route('shop') }}" class="category-card-link">
                        <div class="category-card">
                            <div class="category-image">
                                <img src="{{ asset('frontend/images/perfume6.jfif') }}" alt="Unisex Perfumes">
                            </div>
                            <h5>Unisex</h5>
                            <p>Versatile & Universal Fragrances</p>
                        </div>
                    </a>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <a href="{{ route('shop') }}" class="category-card-link">
                        <div class="category-card">
                            <div class="category-image">
                                <img src="{{ asset('frontend/images/perfume7.jfif') }}" alt="Arabic Perfumes">
                            </div>
                            <h5>Arabic Perfumes</h5>
                            <p>Traditional & Luxurious Oud</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    @endif
    </section>

    <!-- Our Products Section -->
    <section class="page-content">
        <div class="container">
            <p class="collection-label">COLLECTION</p>
            <h2 class="section-title">Our Products</h2>
            <p class="section-subtitle">Each fragrance is a masterpiece — meticulously crafted to evoke emotion and leave a lasting impression.</p>
            
            <div class="row">
                @forelse($products as $product)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="product-card">
                            <div class="product-image">
                                <img src="{{ asset($product->image ?? 'frontend/images/perfume2.jpg') }}" alt="{{ $product->name }}" loading="lazy">
                                @if($product->discount_percentage && $product->discount_percentage > 0)
                                    <span class="sale-badge">-{{ $product->discount_percentage }}%</span>
                                @endif
                                <button class="wishlist-btn" title="Add to Wishlist"><i class="far fa-heart"></i></button>
                            </div>
                            <h5>{{ $product->name }}</h5>
                            <p class="product-description">{{ $product->description ?? 'Premium quality fragrance' }}</p>
                            <div class="product-footer">
                                <div class="price-section">
                                    <p class="price">Rs {{ number_format($product->price, 0) }}</p>
                                    @if($product->original_price)
                                        <p class="original-price"><s>Rs {{ number_format($product->original_price, 0) }}</s></p>
                                    @endif
                                </div>
                                <a href="#" class="btn-view-details">View Details</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">No featured products available</p>
                    </div>
                @endforelse
            </div>
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
                                <img src="{{ asset($perfume->image ?? 'frontend/images/perfume1.jpg') }}" alt="{{ $perfume->name }} - Best Selling Perfume" loading="lazy">
                                @if($perfume->discount_percentage)
                                    <span class="sale-badge">-{{ $perfume->discount_percentage }}%</span>
                                @endif
                            </div>
                            <div class="best-seller-content">
                                <h5>{{ $perfume->name }}</h5>
                                <div class="rating-perfume">
                                    @for($i = 0; $i < floor($perfume->rating); $i++)
                                        <i class="fas fa-star"></i>
                                    @endfor
                                    @if($perfume->rating % 1 != 0)
                                        <i class="fas fa-star-half-alt"></i>
                                    @endif
                                    <span>({{ $perfume->reviews_count }} reviews)</span>
                                </div>
                                @if($perfume->price)
                                    <p class="price-perfume">Rs {{ number_format($perfume->price) }}</p>
                                    @if($perfume->original_price)
                                        <p class="original-price-perfume"><s>Rs {{ number_format($perfume->original_price) }}</s></p>
                                    @endif
                                @elseif($perfume->original_price)
                                    <p class="price-perfume">Rs {{ number_format($perfume->original_price) }}</p>
                                @endif
                                <a href="#" class="btn-shop-now-perfume">Shop Now</a>
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
                        <p>On orders above Rs 2,000</p>
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
                        <p>30-day return policy</p>
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
                    <img src="{{ asset('frontend/images/perfume5.jfif') }}" alt="Almukhtar Perfume - Luxury Brand" class="img-fluid" loading="lazy">
                </div>
                <div class="col-lg-6">
                    <p class="collection-label">ABOUT US</p>
                    <h2 class="section-title">Almukhtar Perfume</h2>
                    <p class="about-text">
                        Almukhtar Perfume represents the pinnacle of luxury fragrance craftsmanship. With decades of expertise in perfumery, we curate the finest collection of long-lasting fragrances from around the world.
                    </p>
                    <p class="about-text">
                        Each scent in our collection is carefully selected for its authenticity, quality, and ability to evoke emotion. We believe that a perfect fragrance is more than just a scent — it's a statement of elegance and sophistication.
                    </p>
                    <ul class="about-features">
                        <li><i class="fas fa-check"></i> Premium quality fragrances</li>
                        <li><i class="fas fa-check"></i> Long-lasting scents</li>
                        <li><i class="fas fa-check"></i> Authentic & original products</li>
                        <li><i class="fas fa-check"></i> Expert curation</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    @if($reviews->count() > 0)
    <section class="testimonials-section">
        <div class="container">
            <p class="collection-label">REVIEWS</p>
            <h2 class="section-title">What Our Customers Say</h2>
            
            <div class="reviews-showcase">
                <div class="review-card-large" id="mainReviewCard">
                    <div class="review-quote-icon">"</div>
                    <div class="review-stars-large">
                        @for($i = 0; $i < 5; $i++)
                        <i class="fas fa-star"></i>
                        @endfor
                    </div>
                    <p class="review-text-large" id="mainReviewText">{{ $reviews->first()->text }}</p>
                </div>

                <div class="reviews-avatars-container">
                    <div class="reviews-avatars" id="reviewsAvatars">
                        @foreach($reviews->take(8) as $index => $review)
                        <div class="avatar-item" onclick="changeMainReview({{ $index }})">
                            @if($review->image)
                            <img src="{{ asset($review->image) }}" alt="{{ $review->author }}" class="avatar-image" title="{{ $review->author }}">
                            @else
                            <div class="avatar-circle" title="{{ $review->author }}">
                                {{ substr($review->author, 0, 1) }}
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    <button class="btn-leave-review">Leave a Review</button>
                </div>

                <p class="reviews-cta">Share your feedback with us and receive a promotional code worth 50,000 as our token of appreciation.</p>
            </div>
        </div>
    </section>
    @endif

    <!-- Newsletter Section -->
    <section class="newsletter-section">
        <div class="container">
            <div class="newsletter-content">
                <h2>Subscribe & Get 10% Off</h2>
                <p>Join our exclusive community and receive special offers on luxury perfumes</p>
                <form class="newsletter-form">
                    <input type="email" placeholder="Enter your email" required>
                    <button type="submit" class="btn-subscribe">Subscribe</button>
                </form>
            </div>
        </div>
    </section>

    <style>
        .btn-subscribe:hover {
            background-color: #333333;
            transform: translateY(-2px);
        }

        /* Best Sellers Section Styles (matching perfume page) */
        .best-selling-perfumes {
            background-color: #f9f9f9;
            padding: 4rem 0;
        }

        .best-seller-card-perfume {
            background-color: #ffffff;
            border: 1px solid #e8e8e8;
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s ease;
            text-align: center;
        }

        .best-seller-card-perfume:hover {
            border-color: #000000;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
            transform: translateY(-8px);
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
            margin-bottom: 0.8rem;
        }

        .rating-perfume {
            color: #000000;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .rating-perfume span {
            color: #666666;
            margin-left: 0.5rem;
            font-size: 0.85rem;
        }

        .price-perfume {
            font-size: 1.1rem;
            color: #000000;
            font-weight: 700;
            margin: 0.5rem 0;
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
            text-decoration: none;
            display: inline-block;
            margin-top: 1rem;
        }

        .btn-shop-now-perfume:hover {
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

        /* Reviews Showcase Styles */
        .testimonials-section {
            background-color: #ffffff;
            padding: 4rem 0;
        }

        .reviews-showcase {
            text-align: center;
        }

        .review-card-large {
            background: linear-gradient(135deg, #4a4a4a 0%, #2d2d2d 100%);
            color: #ffffff;
            padding: 3rem 2rem;
            border-radius: 20px;
            margin-bottom: 2rem;
            position: relative;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }

        .review-quote-icon {
            font-size: 4rem;
            color: #ffc107;
            opacity: 0.3;
            position: absolute;
            top: -10px;
            left: 20px;
            font-weight: bold;
        }

        .review-stars-large {
            color: #ffc107;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            letter-spacing: 0.3rem;
        }

        .review-text-large {
            font-size: 1.1rem;
            line-height: 1.8;
            margin: 0;
            font-style: italic;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .reviews-avatars-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1.5rem;
        }

        .reviews-avatars {
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .avatar-item {
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .avatar-image {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: 3px solid #e8e8e8;
            object-fit: cover;
            transition: all 0.3s ease;
        }

        .avatar-item:hover .avatar-image {
            transform: scale(1.15);
            border-color: #ffc107;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .avatar-circle {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #000000 0%, #333333 100%);
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1.5rem;
            border: 3px solid #e8e8e8;
            transition: all 0.3s ease;
        }

        .avatar-item:hover .avatar-circle {
            transform: scale(1.15);
            border-color: #ffc107;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-leave-review {
            background: linear-gradient(135deg, #ffc107 0%, #ffb300 100%);
            color: #000000;
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 25px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .btn-leave-review:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(255, 193, 7, 0.3);
        }

        .reviews-cta {
            color: #666666;
            font-size: 0.95rem;
            margin-top: 1.5rem;
            margin-bottom: 0;
        }

        @media (max-width: 768px) {
            .review-card-large {
                padding: 2rem 1.5rem;
            }

            .review-text-large {
                font-size: 1rem;
            }

            .avatar-circle {
                width: 50px;
                height: 50px;
                font-size: 1.2rem;
            }

            .reviews-avatars {
                gap: 0.8rem;
            }
        }
    </style>

    <script>
        let currentSlideIndex = 0;
        const slides = document.querySelectorAll('.hero-slide');
        const indicators = document.querySelectorAll('.indicator');
        const totalSlides = slides.length;
        let autoSlideTimer;

        // Initialize first slide
        if (slides.length > 0) {
            slides[0].classList.add('active');
            startAutoSlide();
        }

        function changeSlide(n) {
            clearTimeout(autoSlideTimer);
            currentSlideIndex += n;
            if (currentSlideIndex >= totalSlides) {
                currentSlideIndex = 0;
            } else if (currentSlideIndex < 0) {
                currentSlideIndex = totalSlides - 1;
            }
            showSlide(currentSlideIndex);
            startAutoSlide();
        }

        function currentSlide(n) {
            clearTimeout(autoSlideTimer);
            currentSlideIndex = n;
            showSlide(currentSlideIndex);
            startAutoSlide();
        }

        function showSlide(n) {
            slides.forEach(slide => slide.classList.remove('active'));
            indicators.forEach(indicator => indicator.classList.remove('active'));
            
            if (slides[n]) {
                slides[n].classList.add('active');
            }
            if (indicators[n]) {
                indicators[n].classList.add('active');
            }
        }

        function startAutoSlide() {
            autoSlideTimer = setTimeout(() => {
                currentSlideIndex++;
                if (currentSlideIndex >= totalSlides) {
                    currentSlideIndex = 0;
                }
                showSlide(currentSlideIndex);
                startAutoSlide();
            }, 5000); // Change slide every 5 seconds
        }

        // Reviews Showcase Function
        const allReviews = @json($reviews->take(8));
        let currentReviewIndex = 0;
        let reviewAutoSlideTimer;
        
        function changeMainReview(index) {
            currentReviewIndex = index;
            if (allReviews[index]) {
                const review = allReviews[index];
                document.getElementById('mainReviewText').textContent = review.text;
                
                // Update stars
                let starsHtml = '';
                for (let i = 0; i < Math.floor(review.rating); i++) {
                    starsHtml += '<i class="fas fa-star"></i>';
                }
                if (review.rating % 1 !== 0) {
                    starsHtml += '<i class="fas fa-star-half-alt"></i>';
                }
                document.querySelector('.review-stars-large').innerHTML = starsHtml;
            }
            
            // Reset auto-slide timer
            clearTimeout(reviewAutoSlideTimer);
            startReviewAutoSlide();
        }

        function autoSlideReview() {
            currentReviewIndex = (currentReviewIndex + 1) % allReviews.length;
            changeMainReview(currentReviewIndex);
        }

        function startReviewAutoSlide() {
            reviewAutoSlideTimer = setTimeout(autoSlideReview, 5000);
        }

        // Start auto-slide on page load
        if (allReviews.length > 0) {
            startReviewAutoSlide();
        }
    </script>
@endsection


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

    <script>
        let currentProductPrice = 0;

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

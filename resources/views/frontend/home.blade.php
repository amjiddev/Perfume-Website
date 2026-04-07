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
    <section class="page-content category-section">
        <div class="container">
            <p class="collection-label">EXPLORE</p>
            <h2 class="section-title">Shop by Category</h2>
            
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="category-card">
                        <div class="category-image">
                            <img src="{{ asset('frontend/images/perfume2.jpg') }}" alt="Perfumes for Men">
                            <div class="category-overlay">
                                <a href="{{ route('shop') }}" class="category-btn">Shop Now</a>
                            </div>
                        </div>
                        <h5>For Men</h5>
                        <p>Bold & Masculine Fragrances</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="category-card">
                        <div class="category-image">
                            <img src="{{ asset('frontend/images/perfume3.jfif') }}" alt="Perfumes for Women">
                            <div class="category-overlay">
                                <a href="{{ route('shop') }}" class="category-btn">Shop Now</a>
                            </div>
                        </div>
                        <h5>For Women</h5>
                        <p>Elegant & Feminine Scents</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="category-card">
                        <div class="category-image">
                            <img src="{{ asset('frontend/images/perfume6.jfif') }}" alt="Unisex Perfumes">
                            <div class="category-overlay">
                                <a href="{{ route('shop') }}" class="category-btn">Shop Now</a>
                            </div>
                        </div>
                        <h5>Unisex</h5>
                        <p>Versatile & Universal Fragrances</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="category-card">
                        <div class="category-image">
                            <img src="{{ asset('frontend/images/perfume7.jfif') }}" alt="Arabic Perfumes">
                            <div class="category-overlay">
                                <a href="{{ route('shop') }}" class="category-btn">Shop Now</a>
                            </div>
                        </div>
                        <h5>Arabic Perfumes</h5>
                        <p>Traditional & Luxurious Oud</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Products Section -->
    <section class="page-content">
        <div class="container">
            <p class="collection-label">COLLECTION</p>
            <h2 class="section-title">Our Products</h2>
            <p class="section-subtitle">Each fragrance is a masterpiece — meticulously crafted to evoke emotion and leave a lasting impression.</p>
            
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="{{ asset('frontend/images/perfume2.jpg') }}" alt="Emeraude Noire - Luxury Perfume" loading="lazy">
                            <span class="sale-badge">-20%</span>
                            <button class="wishlist-btn" title="Add to Wishlist"><i class="far fa-heart"></i></button>
                        </div>
                        <h5>Emeraude Noire</h5>
                        <p class="product-description">A bold blend of oud, dark vetiver and smoky amber.</p>
                        <div class="product-footer">
                            <div class="price-section">
                                <p class="price">Rs 51,530</p>
                                <p class="original-price"><s>Rs 64,415</s></p>
                            </div>
                            <a href="#" class="btn-view-details">View Details</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="{{ asset('frontend/images/perfume3.jfif') }}" alt="Rose Dorée - Premium Fragrance" loading="lazy">
                            <button class="wishlist-btn" title="Add to Wishlist"><i class="far fa-heart"></i></button>
                        </div>
                        <h5>Rose Dorée</h5>
                        <p class="product-description">Bulgarian rose with hints of saffron and warm musk.</p>
                        <div class="product-footer">
                            <div class="price-section">
                                <p class="price">Rs 58,380</p>
                                <p class="original-price"><s>Rs 68,815</s></p>
                            </div>
                            <a href="#" class="btn-view-details">View Details</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="{{ asset('frontend/images/perfume6.jfif') }}" alt="Ombre Intense - Long Lasting Fragrance" loading="lazy">
                            <span class="sale-badge">-25%</span>
                            <button class="wishlist-btn" title="Add to Wishlist"><i class="far fa-heart"></i></button>
                        </div>
                        <h5>Ombre Intense</h5>
                        <p class="product-description">Deep leather, dark spices and a touch of incense.</p>
                        <div class="product-footer">
                            <div class="price-section">
                                <p class="price">Rs 45,870</p>
                                <p class="original-price"><s>Rs 61,160</s></p>
                            </div>
                            <a href="#" class="btn-view-details">View Details</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="product-card">
                        <div class="product-image">
                            <img src="{{ asset('frontend/images/perfume7.jfif') }}" alt="Ambre Royal - Luxury Fragrance" loading="lazy">
                            <button class="wishlist-btn" title="Add to Wishlist"><i class="far fa-heart"></i></button>
                        </div>
                        <h5>Ambre Royal</h5>
                        <p class="product-description">Rich amber, vanilla orchid and golden sandalwood.</p>
                        <div class="product-footer">
                            <div class="price-section">
                                <p class="price">Rs 54,210</p>
                                <p class="original-price"><s>Rs 66,215</s></p>
                            </div>
                            <a href="#" class="btn-view-details">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Best Sellers Section -->
    <section class="page-content best-sellers-section">
        <div class="container">
            <p class="collection-label">MOST LOVED</p>
            <h2 class="section-title">Best Sellers</h2>
            
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="best-seller-card">
                        <div class="best-seller-image">
                            <img src="{{ asset('frontend/images/perfume1.jpg') }}" alt="Ambre Royal - Best Selling Perfume" loading="lazy">
                            <span class="sale-badge">-18%</span>
                        </div>
                        <div class="best-seller-content">
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <h5>Ambre Royal</h5>
                            <div class="price-section">
                                <p class="best-seller-price">Rs 54,210</p>
                                <p class="original-price"><s>Rs 66,215</s></p>
                            </div>
                            <a href="#" class="btn-shop-now">View Details</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="best-seller-card">
                        <div class="best-seller-image">
                            <img src="{{ asset('frontend/images/perfume2.jpg') }}" alt="Emeraude Noire - Best Selling Fragrance" loading="lazy">
                            <span class="sale-badge">-20%</span>
                        </div>
                        <div class="best-seller-content">
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <h5>Emeraude Noire</h5>
                            <div class="price-section">
                                <p class="best-seller-price">Rs 51,530</p>
                                <p class="original-price"><s>Rs 64,415</s></p>
                            </div>
                            <a href="#" class="btn-shop-now">View Details</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="best-seller-card">
                        <div class="best-seller-image">
                            <img src="{{ asset('frontend/images/perfume3.jfif') }}" alt="Rose Dorée - Best Selling Perfume" loading="lazy">
                            <span class="sale-badge">-15%</span>
                        </div>
                        <div class="best-seller-content">
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <h5>Rose Dorée</h5>
                            <div class="price-section">
                                <p class="best-seller-price">Rs 58,380</p>
                                <p class="original-price"><s>Rs 68,815</s></p>
                            </div>
                            <a href="#" class="btn-shop-now">View Details</a>
                        </div>
                    </div>
                </div>
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
    <section class="testimonials-section">
        <div class="container">
            <p class="collection-label">REVIEWS</p>
            <h2 class="section-title">What Our Customers Say</h2>
            
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="testimonial-card">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="testimonial-text">"Absolutely love the quality and authenticity. The fragrances last all day and smell amazing. Highly recommended!"</p>
                        <p class="testimonial-author">— Sarah Khan</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="testimonial-card">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="testimonial-text">"Best perfume store in Pakistan. Great customer service and fast delivery. Will definitely order again!"</p>
                        <p class="testimonial-author">— Ahmed Hassan</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="testimonial-card">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="testimonial-text">"The luxury perfumes here are authentic and worth every penny. Excellent collection and professional service."</p>
                        <p class="testimonial-author">— Fatima Ali</p>
                    </div>
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
                <form class="newsletter-form">
                    <input type="email" placeholder="Enter your email" required>
                    <button type="submit" class="btn-subscribe">Subscribe</button>
                </form>
            </div>
        </div>
    </section>

    <style>
        /* Category Section */
        .category-section {
            background-color: #f9f9f9;
        }

        .category-card {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            transition: all 0.3s ease;
            text-align: center;
        }

        .category-image {
            width: 100%;
            height: 280px;
            overflow: hidden;
            position: relative;
            background-color: #f0f0f0;
        }

        .category-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .category-card:hover .category-image img {
            transform: scale(1.1);
        }

        .category-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .category-card:hover .category-overlay {
            opacity: 1;
        }

        .category-btn {
            background: #C8A96A;
            color: #000000;
            padding: 0.8rem 2rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 700;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .category-btn:hover {
            background: #d4b876;
            transform: translateY(-2px);
        }

        .category-card h5 {
            margin-top: 1.5rem;
            color: #000000;
            font-weight: 700;
            font-size: 1.2rem;
        }

        .category-card p {
            color: #666666;
            font-size: 0.9rem;
            margin-bottom: 0;
        }

        /* Product Card Improvements */
        .product-card {
            background-color: #ffffff;
            border: 1px solid #e8e8e8;
            border-radius: 8px;
            padding: 0;
            transition: all 0.3s ease;
            text-align: center;
            height: 100%;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .product-card:hover {
            border-color: #C8A96A;
            box-shadow: 0 15px 40px rgba(200, 169, 106, 0.15);
            transform: translateY(-5px);
        }

        .product-image {
            width: 100%;
            height: 320px;
            overflow: hidden;
            background-color: #f5f5f5;
            position: relative;
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

        .wishlist-btn {
            position: absolute;
            top: 12px;
            left: 12px;
            background: rgba(255, 255, 255, 0.9);
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            color: #C8A96A;
            font-size: 1.1rem;
            z-index: 10;
        }

        .wishlist-btn:hover {
            background: #C8A96A;
            color: #ffffff;
            transform: scale(1.1);
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-card:hover .product-image img {
            transform: scale(1.05);
        }

        .product-card h5 {
            color: #000000;
            margin-top: 1.2rem;
            margin-bottom: 0.5rem;
            font-weight: 700;
            font-size: 1.1rem;
            padding: 0 1rem;
        }

        .product-description {
            color: #666666;
            font-size: 0.9rem;
            padding: 0 1rem;
            margin-bottom: 1rem;
            flex-grow: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            line-height: 1.6;
        }

        .product-footer {
            padding: 1.2rem;
            border-top: 1px solid #e8e8e8;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
        }

        .price {
            font-size: 1.3rem;
            color: #C8A96A;
            font-weight: 700;
            margin: 0;
        }

        .original-price {
            font-size: 0.85rem;
            color: #999999;
            margin: 0;
            font-weight: 600;
        }

        .price-section {
            display: flex;
            flex-direction: row;
            gap: 0.8rem;
            align-items: center;
            justify-content: center;
        }

        .btn-view-details {
            background-color: #000000;
            color: #ffffff;
            border: 1px solid #000000;
            padding: 0.6rem 1rem;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.85rem;
            white-space: nowrap;
            flex-shrink: 0;
            text-decoration: none;
            display: inline-block;
        }

        .btn-view-details:hover {
            background-color: #C8A96A;
            border-color: #C8A96A;
            color: #000000;
            transform: translateY(-2px);
        }

        /* Best Sellers Section */
        .best-sellers-section {
            background-color: #f9f9f9;
        }

        .best-seller-card {
            background-color: #ffffff;
            border: 1px solid #e8e8e8;
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s ease;
            text-align: center;
        }

        .best-seller-card:hover {
            border-color: #C8A96A;
            box-shadow: 0 20px 50px rgba(200, 169, 106, 0.2);
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

        .best-seller-card:hover .best-seller-image img {
            transform: scale(1.1);
        }

        .best-seller-content {
            padding: 2rem 1.5rem;
        }

        .stars {
            color: #C8A96A;
            font-size: 1rem;
            margin-bottom: 1rem;
            letter-spacing: 0.3rem;
        }

        .best-seller-card h5 {
            color: #000000;
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 0.8rem;
        }

        .best-seller-price {
            color: #C8A96A;
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .btn-shop-now {
            background-color: #000000;
            color: #ffffff;
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 6px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            text-decoration: none;
            display: inline-block;
        }

        .btn-shop-now:hover {
            background-color: #C8A96A;
            color: #000000;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(200, 169, 106, 0.3);
        }

        /* Trust Badges Section */
        .trust-badges-section {
            background: linear-gradient(135deg, #000000 0%, #1a1a1a 100%);
            padding: 4rem 0;
        }

        .trust-badge {
            text-align: center;
            color: #ffffff;
            padding: 2rem;
        }

        .trust-badge i {
            font-size: 2.5rem;
            color: #C8A96A;
            margin-bottom: 1rem;
            display: block;
        }

        .trust-badge h5 {
            color: #ffffff;
            font-weight: 700;
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
        }

        .trust-badge p {
            color: #b0b0b0;
            font-size: 0.9rem;
            margin: 0;
        }

        /* About Brand Section */
        .about-brand-section {
            background-color: #ffffff;
        }

        .about-text {
            color: #666666;
            font-size: 1rem;
            line-height: 1.8;
            margin-bottom: 1.5rem;
        }

        .about-features {
            list-style: none;
            padding: 0;
        }

        .about-features li {
            color: #000000;
            margin-bottom: 1rem;
            font-weight: 500;
        }

        .about-features i {
            color: #C8A96A;
            margin-right: 0.8rem;
            font-weight: 700;
        }

        /* Testimonials Section */
        .testimonials-section {
            background-color: #f9f9f9;
            padding: 4rem 0;
        }

        .testimonial-card {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 8px;
            border: 1px solid #e8e8e8;
            transition: all 0.3s ease;
            text-align: center;
        }

        .testimonial-card:hover {
            box-shadow: 0 10px 30px rgba(200, 169, 106, 0.15);
            transform: translateY(-5px);
        }

        .testimonial-card .stars {
            margin-bottom: 1.5rem;
        }

        .testimonial-text {
            color: #666666;
            font-size: 0.95rem;
            line-height: 1.8;
            margin-bottom: 1.5rem;
            font-style: italic;
        }

        .testimonial-author {
            color: #000000;
            font-weight: 700;
            margin: 0;
            font-size: 0.95rem;
        }

        /* Newsletter Section */
        .newsletter-section {
            background: linear-gradient(135deg, #C8A96A 0%, #d4b876 100%);
            padding: 4rem 0;
        }

        .newsletter-content {
            text-align: center;
            color: #000000;
        }

        .newsletter-content h2 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            font-weight: 800;
        }

        .newsletter-content p {
            font-size: 1.1rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .newsletter-form {
            display: flex;
            gap: 0.5rem;
            max-width: 500px;
            margin: 0 auto;
        }

        .newsletter-form input {
            flex: 1;
            padding: 0.9rem 1.5rem;
            border: none;
            border-radius: 6px;
            font-size: 0.95rem;
            background-color: rgba(255, 255, 255, 0.95);
        }

        .newsletter-form input::placeholder {
            color: #999999;
        }

        .btn-subscribe {
            background-color: #000000;
            color: #ffffff;
            border: none;
            padding: 0.9rem 2rem;
            border-radius: 6px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            white-space: nowrap;
        }

        .btn-subscribe:hover {
            background-color: #333333;
            transform: translateY(-2px);
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

            .newsletter-form {
                flex-direction: column;
            }

            .btn-subscribe {
                width: 100%;
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
    </script>
@endsection

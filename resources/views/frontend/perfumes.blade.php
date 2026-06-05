@extends('frontend.layouts.app')

@section('title', 'Luxury Perfumes - Buy Best Perfumes Online | Almukhtar Perfume')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section-centered" style="background-image: url('{{ asset('frontend/images/perfume1.jpg') }}');">
        <div class="hero-overlay-light"></div>
        <div class="hero-content-centered">
            <div class="hero-text-centered">
                <h1>Luxury Perfumes</h1>
                <p>Discover long-lasting premium fragrances crafted for the modern individual</p>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="page-content perfumes-section">
        <div class="container">
            
            <!-- Products Grid -->
            <div class="products-grid" id="perfumesGrid">
                        @php
                            $perfumes = [
                                ['name' => 'Emeraude Noire', 'price' => 51530, 'original' => 64415, 'discount' => '-20%', 'rating' => 4.5, 'reviews' => 185, 'desc' => 'Bold blend of oud and dark vetiver', 'category' => 'men'],
                                ['name' => 'Rose Dorée', 'price' => 58380, 'original' => 68815, 'discount' => null, 'rating' => 4.5, 'reviews' => 210, 'desc' => 'Bulgarian rose with saffron notes', 'category' => 'women'],
                                ['name' => 'Ombre Intense', 'price' => 45870, 'original' => 61160, 'discount' => '-25%', 'rating' => 4, 'reviews' => 165, 'desc' => 'Deep leather and dark spices', 'category' => 'men'],
                                ['name' => 'Ambre Royal', 'price' => 54210, 'original' => 66215, 'discount' => null, 'rating' => 4.5, 'reviews' => 195, 'desc' => 'Rich amber with golden sandalwood', 'category' => 'unisex'],
                                ['name' => 'Fleur de Rose', 'price' => 61160, 'original' => 78515, 'discount' => '-22%', 'rating' => 5, 'reviews' => 220, 'desc' => 'Pink peony and jasmine petals', 'category' => 'women'],
                                ['name' => 'Perle Blanche', 'price' => 66720, 'original' => 75840, 'discount' => null, 'rating' => 4.5, 'reviews' => 240, 'desc' => 'White tea and creamy sandalwood', 'category' => 'women'],
                                ['name' => 'Midnight Elegance', 'price' => 52847, 'original' => 66060, 'discount' => '-20%', 'rating' => 5, 'reviews' => 175, 'desc' => 'Mysterious night fragrance', 'category' => 'unisex'],
                                ['name' => 'Golden Hour', 'price' => 50097, 'original' => 61095, 'discount' => null, 'rating' => 4.5, 'reviews' => 198, 'desc' => 'Warm and luxurious blend', 'category' => 'men'],
                                ['name' => 'Ocean Breeze', 'price' => 48647, 'original' => 57935, 'discount' => '-16%', 'rating' => 5, 'reviews' => 205, 'desc' => 'Fresh and crisp marine notes', 'category' => 'unisex'],
                                ['name' => 'Velvet Noir', 'price' => 55000, 'original' => 68750, 'discount' => '-20%', 'rating' => 4.5, 'reviews' => 180, 'desc' => 'Soft velvet with dark musk', 'category' => 'women'],
                                ['name' => 'Jasmine Dreams', 'price' => 59500, 'original' => 70000, 'discount' => null, 'rating' => 4.5, 'reviews' => 192, 'desc' => 'Exotic jasmine and vanilla', 'category' => 'women'],
                                ['name' => 'Spice Route', 'price' => 52000, 'original' => 65000, 'discount' => '-20%', 'rating' => 5, 'reviews' => 188, 'desc' => 'Warm spices and oriental notes', 'category' => 'arabic'],
                            ];
                        @endphp

                        @foreach($perfumes as $index => $perfume)
                        <div class="product-card-perfume perfume-item" data-index="{{ $index }}" data-category="{{ $perfume['category'] }}" style="display: {{ $index < 4 ? 'flex' : 'none' }};">
                            <div class="product-image-wrapper">
                                <img src="https://images.pexels.com/photos/3962286/pexels-photo-3962286.jpeg?w=300&h=400&fit=crop" alt="{{ $perfume['name'] }} - Luxury Perfume" loading="lazy">
                                @if($perfume['discount'])
                                    <span class="sale-badge">{{ $perfume['discount'] }}</span>
                                @endif
                            </div>
                            <div class="product-info">
                                <h5>{{ $perfume['name'] }}</h5>
                                <p class="product-desc">{{ $perfume['desc'] }}</p>
                                <div class="rating-perfume">
                                    @for($i = 0; $i < floor($perfume['rating']); $i++)
                                        <i class="fas fa-star"></i>
                                    @endfor
                                    @if($perfume['rating'] % 1 != 0)
                                        <i class="fas fa-star-half-alt"></i>
                                    @endif
                                    <span>({{ $perfume['reviews'] }})</span>
                                </div>
                                <div class="price-section-perfume">
                                    <p class="price-perfume">Rs {{ number_format($perfume['price']) }}</p>
                                    @if($perfume['discount'])
                                        <p class="original-price-perfume"><s>Rs {{ number_format($perfume['original']) }}</s></p>
                                    @endif
                                </div>
                                <a href="#" class="btn-view-details-perfume">View Details</a>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Show More/Less Button -->
                    <div class="show-more-container">
                        <button class="btn-show-more" id="perfumesShowMoreBtn" onclick="togglePerfumes()">
                            <i class="fas fa-chevron-down"></i> Show More
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Best Selling Perfumes Section -->
    <section class="page-content best-selling-perfumes">
        <div class="container">
            <p class="collection-label">MOST LOVED</p>
            <h2 class="section-title">Best Selling Perfumes</h2>
            
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="best-seller-card-perfume">
                        <div class="best-seller-image">
                            <img src="https://images.pexels.com/photos/3962286/pexels-photo-3962286.jpeg?w=300&h=400&fit=crop" alt="Emeraude Noire - Best Selling" loading="lazy">
                        </div>
                        <div class="best-seller-content">
                            <h5>Emeraude Noire</h5>
                            <div class="rating-perfume">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <span>(185 reviews)</span>
                            </div>
                            <p class="price-perfume">Rs 51,530</p>
                            <a href="#" class="btn-shop-now-perfume">Shop Now</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="best-seller-card-perfume">
                        <div class="best-seller-image">
                            <img src="https://images.pexels.com/photos/3807517/pexels-photo-3807517.jpeg?w=300&h=400&fit=crop" alt="Rose Dorée - Best Selling" loading="lazy">
                        </div>
                        <div class="best-seller-content">
                            <h5>Rose Dorée</h5>
                            <div class="rating-perfume">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <span>(210 reviews)</span>
                            </div>
                            <p class="price-perfume">Rs 58,380</p>
                            <a href="#" class="btn-shop-now-perfume">Shop Now</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="best-seller-card-perfume">
                        <div class="best-seller-image">
                            <img src="https://images.pexels.com/photos/3962287/pexels-photo-3962287.jpeg?w=300&h=400&fit=crop" alt="Fleur de Rose - Best Selling" loading="lazy">
                        </div>
                        <div class="best-seller-content">
                            <h5>Fleur de Rose</h5>
                            <div class="rating-perfume">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <span>(220 reviews)</span>
                            </div>
                            <p class="price-perfume">Rs 61,160</p>
                            <a href="#" class="btn-shop-now-perfume">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-perfumes">
        <div class="container">
            <p class="collection-label">CUSTOMER REVIEWS</p>
            <h2 class="section-title">What Our Customers Say</h2>
            
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="testimonial-card-perfume">
                        <div class="rating-perfume">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="testimonial-text">"The best luxury perfumes I've ever purchased! Long-lasting and absolutely worth the investment."</p>
                        <p class="testimonial-author">— Sarah Khan</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="testimonial-card-perfume">
                        <div class="rating-perfume">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="testimonial-text">"Almukhtar Perfume offers authentic, premium fragrances. Fast delivery and excellent customer service!"</p>
                        <p class="testimonial-author">— Ahmed Hassan</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="testimonial-card-perfume">
                        <div class="rating-perfume">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="testimonial-text">"These perfumes are incredible! The scent lasts all day and the quality is unmatched in Pakistan."</p>
                        <p class="testimonial-author">— Fatima Ali</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        /* Perfumes Page Specific Styles */
        .perfumes-section {
            background-color: #ffffff;
        }

        /* Category Filter */
        .category-filter-container {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 3rem;
            flex-wrap: wrap;
        }

        .category-filter-btn {
            background-color: #ffffff;
            color: #000000;
            border: 2px solid #e8e8e8;
            padding: 0.7rem 1.8rem;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            letter-spacing: 0.5px;
        }

        .category-filter-btn:hover {
            border-color: #000000;
            color: #000000;
        }

        .category-filter-btn.active {
            background-color: #000000;
            color: #ffffff;
            border-color: #000000;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .product-card-perfume {
            background-color: #ffffff;
            border: 1px solid #e8e8e8;
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .product-card-perfume:hover {
            border-color: #000000;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
            transform: translateY(-8px);
        }

        .product-image-wrapper {
            position: relative;
            width: 100%;
            height: 300px;
            overflow: hidden;
            background-color: #f5f5f5;
        }

        .product-image-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-card-perfume:hover .product-image-wrapper img {
            transform: scale(1.08);
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

        .wishlist-btn-perfume {
            position: absolute;
            top: 12px;
            left: 12px;
            background: rgba(255, 255, 255, 0.95);
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            color: #000000;
            font-size: 1.1rem;
            z-index: 10;
        }

        .wishlist-btn-perfume:hover {
            background: #000000;
            color: #ffffff;
            transform: scale(1.1);
        }

        .product-info {
            padding: 1.5rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .product-card-perfume h5 {
            color: #000000;
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }

        .product-desc {
            color: #666666;
            font-size: 0.9rem;
            margin-bottom: 0.8rem;
            line-height: 1.5;
        }

        .rating-perfume {
            color: #FFD700;
            font-size: 0.9rem;
            margin-bottom: 1rem;
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
            margin-bottom: 1.2rem;
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

        .btn-view-details-perfume {
            background-color: #000000;
            color: #ffffff;
            border: 1px solid #000000;
            padding: 0.8rem 1.5rem;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.9rem;
            text-decoration: none;
            display: block;
            text-align: center;
            margin-top: auto;
        }

        .btn-view-details-perfume:hover {
            background-color: #333333;
            border-color: #333333;
            color: #ffffff;
            transform: translateY(-2px);
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

        /* Best Sellers Section */
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

        .best-seller-content {
            padding: 2rem 1.5rem;
        }

        .best-seller-card-perfume h5 {
            color: #000000;
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 0.8rem;
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

        /* Testimonials Section */
        .testimonials-perfumes {
            background-color: #ffffff;
            padding: 4rem 0;
        }

        .testimonial-card-perfume {
            background-color: #f9f9f9;
            padding: 2rem;
            border-radius: 8px;
            border: 1px solid #e8e8e8;
            transition: all 0.3s ease;
            text-align: center;
        }

        .testimonial-card-perfume:hover {
            box-shadow: 0 10px 30px rgba(200, 169, 106, 0.15);
            transform: translateY(-5px);
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

        @media (max-width: 768px) {
            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                gap: 1.5rem;
            }

            .product-image-wrapper {
                height: 250px;
            }

            .best-seller-image {
                height: 250px;
            }

            .btn-show-more {
                padding: 0.8rem 2rem;
                font-size: 0.9rem;
            }

            .category-filter-container {
                gap: 0.5rem;
            }

            .category-filter-btn {
                padding: 0.6rem 1.2rem;
                font-size: 0.85rem;
            }
        }
    </style>

    <script>
        let perfumesExpanded = false;
        let currentCategory = 'all';

        function filterPerfumes(category) {
            currentCategory = category;
            const items = document.querySelectorAll('.perfume-item');
            const buttons = document.querySelectorAll('.category-filter-btn');
            
            // Update active button
            buttons.forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
            
            // Get all items in this category
            let categoryItems = [];
            items.forEach((item) => {
                const itemCategory = item.getAttribute('data-category');
                if (category === 'all' || itemCategory === category) {
                    categoryItems.push(item);
                } else {
                    item.style.display = 'none';
                }
            });
            
            // Show only first 4 items
            categoryItems.forEach((item, index) => {
                if (index < 4) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            });
            
            // Reset expanded state
            perfumesExpanded = false;
            const showMoreBtn = document.getElementById('perfumesShowMoreBtn');
            if (showMoreBtn) {
                showMoreBtn.innerHTML = '<i class="fas fa-chevron-down"></i> Show More';
                showMoreBtn.classList.remove('expanded');
            }
        }

        function togglePerfumes() {
            const items = document.querySelectorAll('.perfume-item');
            const btn = document.getElementById('perfumesShowMoreBtn');
            
            // Get all items in current category
            let categoryItems = [];
            items.forEach((item) => {
                const itemCategory = item.getAttribute('data-category');
                if (currentCategory === 'all' || itemCategory === currentCategory) {
                    categoryItems.push(item);
                }
            });
            
            perfumesExpanded = !perfumesExpanded;
            
            if (perfumesExpanded) {
                // Show 8 items (first 4 + 4 more)
                categoryItems.forEach((item, index) => {
                    if (index < 8) {
                        item.style.display = 'flex';
                    } else {
                        item.style.display = 'none';
                    }
                });
                btn.innerHTML = '<i class="fas fa-chevron-up"></i> Show Less';
                btn.classList.add('expanded');
            } else {
                // Show only first 4 items
                categoryItems.forEach((item, index) => {
                    if (index < 4) {
                        item.style.display = 'flex';
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

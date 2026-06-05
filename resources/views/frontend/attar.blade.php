@extends('frontend.layouts.app')

@section('title', 'Premium Attar - Buy Alcohol-Free Perfume | Almukhtar Perfume')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section-centered" style="background-image: url('{{ asset('frontend/images/perfume7.jfif') }}');">
        <div class="hero-overlay-light"></div>
        <div class="hero-content-centered">
            <div class="hero-text-centered">
                <h1>Premium Attar</h1>
                <p>Alcohol-free, long-lasting natural fragrances for the discerning</p>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="page-content attar-section">
        <div class="container">
            <!-- Products Grid -->
            <div class="products-grid" id="attarGrid">
                        @php
                            $attars = [
                                ['name' => 'Oud Premium', 'price' => 85000, 'original' => 100000, 'discount' => '-15%', 'rating' => 5, 'reviews' => 156, 'type' => 'Oud', 'desc' => 'Pure oud oil, alcohol-free'],
                                ['name' => 'Rose Attar', 'price' => 72000, 'original' => 90000, 'discount' => null, 'rating' => 4.5, 'reviews' => 142, 'type' => 'Floral', 'desc' => 'Natural rose oil blend'],
                                ['name' => 'Musk Essence', 'price' => 68000, 'original' => 85000, 'discount' => '-20%', 'rating' => 4.5, 'reviews' => 128, 'type' => 'Musk', 'desc' => 'Soft musk, skin-friendly'],
                                ['name' => 'Sandalwood Attar', 'price' => 75000, 'original' => 93750, 'discount' => null, 'rating' => 5, 'reviews' => 167, 'type' => 'Woody', 'desc' => 'Premium sandalwood oil'],
                                ['name' => 'Jasmine Attar', 'price' => 70000, 'original' => 87500, 'discount' => '-20%', 'rating' => 4.5, 'reviews' => 151, 'type' => 'Floral', 'desc' => 'Exotic jasmine essence'],
                                ['name' => 'Oud Royale', 'price' => 95000, 'original' => 118750, 'discount' => null, 'rating' => 5, 'reviews' => 189, 'type' => 'Oud', 'desc' => 'Luxury oud blend'],
                                ['name' => 'Amber Attar', 'price' => 65000, 'original' => 81250, 'discount' => '-20%', 'rating' => 4.5, 'reviews' => 134, 'type' => 'Woody', 'desc' => 'Warm amber notes'],
                                ['name' => 'Floral Blend', 'price' => 68000, 'original' => 85000, 'discount' => null, 'rating' => 4.5, 'reviews' => 145, 'type' => 'Floral', 'desc' => 'Mixed floral oils'],
                                ['name' => 'Musk Royal', 'price' => 78000, 'original' => 97500, 'discount' => '-20%', 'rating' => 5, 'reviews' => 173, 'type' => 'Musk', 'desc' => 'Premium musk blend'],
                            ];
                        @endphp

                        @foreach($attars as $index => $attar)
                        <div class="product-card-attar" data-index="{{ $index }}" style="display: {{ $index < 4 ? 'flex' : 'none' }};">
                            <div class="product-image-wrapper">
                                <img src="https://images.pexels.com/photos/3962288/pexels-photo-3962288.jpeg?w=300&h=400&fit=crop" alt="{{ $attar['name'] }} - Alcohol-Free Attar" loading="lazy">
                                @if($attar['discount'])
                                    <span class="sale-badge">{{ $attar['discount'] }}</span>
                                @endif
                                <span class="attar-badge">Alcohol-Free</span>
                            </div>
                            <div class="product-info">
                                <h5>{{ $attar['name'] }}</h5>
                                <p class="attar-type">{{ $attar['type'] }}</p>
                                <p class="product-desc">{{ $attar['desc'] }}</p>
                                <div class="rating-attar">
                                    @for($i = 0; $i < floor($attar['rating']); $i++)
                                        <i class="fas fa-star" style="color: #FFD700;"></i>
                                    @endfor
                                    @if($attar['rating'] % 1 != 0)
                                        <i class="fas fa-star-half-alt" style="color: #FFD700;"></i>
                                    @endif
                                    <span>({{ $attar['reviews'] }})</span>
                                </div>
                                <div class="price-section-attar">
                                    <p class="price-attar">Rs {{ number_format($attar['price']) }}</p>
                                    @if($attar['discount'])
                                        <p class="original-price-attar"><s>Rs {{ number_format($attar['original']) }}</s></p>
                                    @endif
                                </div>
                                <a href="#" class="btn-view-details-attar">View Details</a>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Show More/Less Button -->
                    <div class="show-more-container">
                        <button class="btn-show-more" id="attarShowMoreBtn" onclick="toggleAttar()">
                            <i class="fas fa-chevron-down"></i> Show More
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Attar Section -->
    <section class="why-choose-attar">
        <div class="container">
            <p class="collection-label">BENEFITS</p>
            <h2 class="section-title">Why Choose Attar?</h2>
            
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

        .product-card-attar:hover {
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

        .product-card-attar:hover .product-image-wrapper img {
            transform: scale(1.08);
        }

        .attar-badge {
            position: absolute;
            bottom: 12px;
            left: 12px;
            background: linear-gradient(135deg, #000000 0%, #1a1a1a 100%);
            color: #ffffff;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-weight: 700;
            font-size: 0.75rem;
            z-index: 10;
            text-transform: uppercase;
            letter-spacing: 0.5px;
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

        .wishlist-btn-attar {
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

        .wishlist-btn-attar:hover {
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

        .product-card-attar h5 {
            color: #000000;
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 0.3rem;
        }

        .attar-type {
            color: #000000;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .product-desc {
            color: #666666;
            font-size: 0.9rem;
            margin-bottom: 0.8rem;
            line-height: 1.5;
        }

        .rating-attar {
            color: #FFD700;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .rating-attar span {
            color: #666666;
            margin-left: 0.5rem;
            font-size: 0.85rem;
        }

        .price-section-attar {
            display: flex;
            gap: 0.8rem;
            align-items: center;
            margin-bottom: 1.2rem;
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
            font-weight: 600;
        }

        .btn-view-details-attar {
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

        .btn-view-details-attar:hover {
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

        /* Why Choose Attar Section */
        .why-choose-attar {
            background-color: #f9f9f9;
            padding: 4rem 0;
        }

        .benefit-card {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 8px;
            border: 1px solid #e8e8e8;
            text-align: center;
            transition: all 0.3s ease;
        }

        .benefit-card:hover {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            transform: translateY(-5px);
        }

        .benefit-icon {
            font-size: 2.5rem;
            color: #000000;
            margin-bottom: 1rem;
        }

        .benefit-card h5 {
            color: #000000;
            font-weight: 700;
            margin-bottom: 0.8rem;
            font-size: 1.1rem;
        }

        .benefit-card p {
            color: #666666;
            font-size: 0.95rem;
            line-height: 1.6;
            margin: 0;
        }

        /* Testimonials Section */
        .testimonials-attar {
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
            .products-grid {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                gap: 1.5rem;
            }

            .product-image-wrapper {
                height: 250px;
            }

            .btn-show-more {
                padding: 0.8rem 2rem;
                font-size: 0.9rem;
            }

            .carousel-btn-prev {
                left: 0;
            }

            .carousel-btn-next {
                right: 0;
            }

            .review-card-small {
                min-width: 250px;
                padding: 1rem;
            }

            .review-text {
                font-size: 0.85rem;
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
                    // Show only 4 cards
                    if (index < 4) {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
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

        // Attar Reviews Showcase Function removed
    </script>
@endsection

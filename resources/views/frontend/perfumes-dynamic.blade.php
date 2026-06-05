@extends('frontend.layouts.app')

@section('title', 'Luxury Perfumes - Buy Best Perfumes Online | Almukhtar Perfume')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section-centered" style="background-image: url('{{ asset($perfumePage->hero_image ?? 'frontend/images/perfume1.jpg') }}');">
        <div class="hero-overlay-light"></div>
        <div class="hero-content-centered">
            <div class="hero-text-centered">
                <h1>{{ $perfumePage->hero_heading ?? 'Luxury Perfumes' }}</h1>
                <p>{{ $perfumePage->hero_subheading ?? 'Discover long-lasting premium fragrances crafted for the modern individual' }}</p>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="page-content perfumes-section">
        <div class="container">
            <!-- Products Grid -->
            <div class="products-grid" id="perfumesGrid">
                @forelse($perfumes as $index => $perfume)
                    <div class="product-card-perfume perfume-item" data-index="{{ $index }}" data-category="{{ $perfume->category }}" style="display: {{ $index < 4 ? 'flex' : 'none' }};">
                        <div class="product-image-wrapper">
                            <img src="{{ asset($perfume->image ?? 'https://images.pexels.com/photos/3962286/pexels-photo-3962286.jpeg?w=300&h=400&fit=crop') }}" alt="{{ $perfume->name }} - Luxury Perfume" loading="lazy">
                            @if($perfume->discount_percentage)
                                <span class="sale-badge">-{{ $perfume->discount_percentage }}%</span>
                            @endif
                            <button class="wishlist-btn-perfume" title="Add to Wishlist"><i class="far fa-heart"></i></button>
                        </div>
                        <div class="product-info">
                            <h5>{{ $perfume->name }}</h5>
                            <p class="product-desc">{{ $perfume->description }}</p>
                            <div class="rating-perfume">
                                @for($i = 0; $i < floor($perfume->rating); $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                                @if($perfume->rating % 1 != 0)
                                    <i class="fas fa-star-half-alt"></i>
                                @endif
                                <span>({{ $perfume->reviews_count }})</span>
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
                            <a href="{{ route('product.detail', $perfume->id) }}" class="btn-view-details-perfume">View Details</a>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">No perfumes available at the moment.</p>
                    </div>
                @endforelse
            </div>

            <!-- Show More/Less Button -->
            @if($perfumes->count() > 4)
                <div class="show-more-container">
                    <button class="btn-show-more" id="perfumesShowMoreBtn" onclick="togglePerfumes()">
                        <i class="fas fa-chevron-down"></i> Show More
                    </button>
                </div>
            @endif
        </div>
    </section>

    <!-- Best Selling Perfumes Section -->
    @if($bestSellers->count() > 0)
        <section class="page-content best-selling-perfumes">
            <div class="container">
                <p class="collection-label">{{ $perfumePage->best_sellers_subtitle ?? 'MOST LOVED' }}</p>
                <h2 class="section-title">{{ $perfumePage->best_sellers_title ?? 'Best Selling Perfumes' }}</h2>
                
                <div class="row">
                @foreach($bestSellers->take(3) as $perfume)
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
                @endforeach
            </div>
            </div>
        </section>
    @endif



    <style>
        /* Perfumes Page Specific Styles */
        .perfumes-section {
            background-color: #ffffff;
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
            color: #000000;
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

            .section-title {
                font-size: 1.5rem;
            }
        }
    </style>

    <script>
        let perfumesExpanded = false;

        function togglePerfumes() {
            const items = document.querySelectorAll('.perfume-item');
            const btn = document.getElementById('perfumesShowMoreBtn');
            
            perfumesExpanded = !perfumesExpanded;
            
            if (perfumesExpanded) {
                items.forEach((item, index) => {
                    if (index < 8) {
                        item.style.display = 'flex';
                    } else {
                        item.style.display = 'none';
                    }
                });
                btn.innerHTML = '<i class="fas fa-chevron-up"></i> Show Less';
                btn.classList.add('expanded');
            } else {
                items.forEach((item, index) => {
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

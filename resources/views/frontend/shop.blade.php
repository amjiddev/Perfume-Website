@extends('frontend.layouts.app')

@section('title', 'Shop - Almukhtar Perfume')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section-centered" style="background-image: url('{{ asset('frontend/images/perfume2.jpg') }}');">
        <div class="hero-overlay-light"></div>
        
        <div class="hero-content-centered">
            <div class="hero-text-centered">
                <h1>Our Collection</h1>
                <p>Browse our exclusive range of premium fragrances curated for every occasion and personality.</p>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="page-content" id="products">
        <div class="container">
            <h2 class="section-title">All Fragrances</h2>
            
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="product-card">
                        <div class="product-image-shop">
                            <img src="https://images.pexels.com/photos/3962286/pexels-photo-3962286.jpeg?w=300&h=400&fit=crop" alt="Emeraude Noire" class="img-fluid">
                            <span class="sale-badge">-20%</span>
                        </div>
                        <h5 class="mt-3">Emeraude Noire</h5>
                        <p class="text-muted">Premium quality perfume</p>
                        <div class="rating mb-2">
                            <i class="fas fa-star" style="color: #000000;"></i>
                            <i class="fas fa-star" style="color: #000000;"></i>
                            <i class="fas fa-star" style="color: #000000;"></i>
                            <i class="fas fa-star" style="color: #000000;"></i>
                            <i class="fas fa-star-half" style="color: #000000;"></i>
                            <span class="ms-2">(185 reviews)</span>
                        </div>
                        <div class="price-section">
                            <p class="price">Rs 51,530</p>
                            <p class="original-price"><s>Rs 64,615</s></p>
                        </div>
                        <button class="btn-primary-custom w-100">Add to Cart</button>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="product-card">
                        <div class="product-image-shop">
                            <img src="https://images.pexels.com/photos/3807517/pexels-photo-3807517.jpeg?w=300&h=400&fit=crop" alt="Rose Dorée" class="img-fluid">
                            <span class="sale-badge">-15%</span>
                        </div>
                        <h5 class="mt-3">Rose Dorée</h5>
                        <p class="text-muted">Premium quality perfume</p>
                        <div class="rating mb-2">
                            <i class="fas fa-star" style="color: #000000;"></i>
                            <i class="fas fa-star" style="color: #000000;"></i>
                            <i class="fas fa-star" style="color: #000000;"></i>
                            <i class="fas fa-star" style="color: #000000;"></i>
                            <i class="fas fa-star-half" style="color: #000000;"></i>
                            <span class="ms-2">(210 reviews)</span>
                        </div>
                        <div class="price-section">
                            <p class="price">Rs 58,695</p>
                            <p class="original-price"><s>Rs 68,815</s></p>
                        </div>
                        <button class="btn-primary-custom w-100">Add to Cart</button>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="product-card">
                        <div class="product-image-shop">
                            <img src="https://images.pexels.com/photos/3962287/pexels-photo-3962287.jpeg?w=300&h=400&fit=crop" alt="Ombre Intense" class="img-fluid">
                            <span class="sale-badge">-25%</span>
                        </div>
                        <h5 class="mt-3">Ombre Intense</h5>
                        <p class="text-muted">Premium quality perfume</p>
                        <div class="rating mb-2">
                            <i class="fas fa-star" style="color: #000000;"></i>
                            <i class="fas fa-star" style="color: #000000;"></i>
                            <i class="fas fa-star" style="color: #000000;"></i>
                            <i class="fas fa-star" style="color: #000000;"></i>
                            <i class="fas fa-star-half" style="color: #000000;"></i>
                            <span class="ms-2">(165 reviews)</span>
                        </div>
                        <div class="price-section">
                            <p class="price">Rs 46,185</p>
                            <p class="original-price"><s>Rs 61,580</s></p>
                        </div>
                        <button class="btn-primary-custom w-100">Add to Cart</button>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="product-card">
                        <div class="product-image-shop">
                            <img src="https://images.pexels.com/photos/3962288/pexels-photo-3962288.jpeg?w=300&h=400&fit=crop" alt="Ambre Royal" class="img-fluid">
                            <span class="sale-badge">-18%</span>
                        </div>
                        <h5 class="mt-3">Ambre Royal</h5>
                        <p class="text-muted">Premium quality perfume</p>
                        <div class="rating mb-2">
                            <i class="fas fa-star" style="color: #000000;"></i>
                            <i class="fas fa-star" style="color: #000000;"></i>
                            <i class="fas fa-star" style="color: #000000;"></i>
                            <i class="fas fa-star" style="color: #000000;"></i>
                            <i class="fas fa-star-half" style="color: #000000;"></i>
                            <span class="ms-2">(195 reviews)</span>
                        </div>
                        <div class="price-section">
                            <p class="price">Rs 54,525</p>
                            <p class="original-price"><s>Rs 66,430</s></p>
                        </div>
                        <button class="btn-primary-custom w-100">Add to Cart</button>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="product-card">
                        <div class="product-image-shop">
                            <img src="https://images.pexels.com/photos/3807517/pexels-photo-3807517.jpeg?w=300&h=400&fit=crop" alt="Fleur de Rose" class="img-fluid">
                            <span class="sale-badge">-22%</span>
                        </div>
                        <h5 class="mt-3">Fleur de Rose</h5>
                        <p class="text-muted">Premium quality perfume</p>
                        <div class="rating mb-2">
                            <i class="fas fa-star" style="color: #000000;"></i>
                            <i class="fas fa-star" style="color: #000000;"></i>
                            <i class="fas fa-star" style="color: #000000;"></i>
                            <i class="fas fa-star" style="color: #000000;"></i>
                            <i class="fas fa-star" style="color: #000000;"></i>
                            <span class="ms-2">(220 reviews)</span>
                        </div>
                        <div class="price-section">
                            <p class="price">Rs 61,475</p>
                            <p class="original-price"><s>Rs 78,815</s></p>
                        </div>
                        <button class="btn-primary-custom w-100">Add to Cart</button>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="product-card">
                        <div class="product-image-shop">
                            <img src="https://images.pexels.com/photos/3962286/pexels-photo-3962286.jpeg?w=300&h=400&fit=crop" alt="Perle Blanche" class="img-fluid">
                            <span class="sale-badge">-12%</span>
                        </div>
                        <h5 class="mt-3">Perle Blanche</h5>
                        <p class="text-muted">Premium quality perfume</p>
                        <div class="rating mb-2">
                            <i class="fas fa-star" style="color: #000000;"></i>
                            <i class="fas fa-star" style="color: #000000;"></i>
                            <i class="fas fa-star" style="color: #000000;"></i>
                            <i class="fas fa-star" style="color: #000000;"></i>
                            <i class="fas fa-star-half" style="color: #000000;"></i>
                            <span class="ms-2">(240 reviews)</span>
                        </div>
                        <div class="price-section">
                            <p class="price">Rs 67,075</p>
                            <p class="original-price"><s>Rs 76,045</s></p>
                        </div>
                        <button class="btn-primary-custom w-100">Add to Cart</button>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="product-card">
                        <div class="product-image-shop">
                            <img src="https://images.pexels.com/photos/3962287/pexels-photo-3962287.jpeg?w=300&h=400&fit=crop" alt="Midnight Elegance" class="img-fluid">
                            <span class="sale-badge">-20%</span>
                        </div>
                        <h5 class="mt-3">Midnight Elegance</h5>
                        <p class="text-muted">Premium quality perfume</p>
                        <div class="rating mb-2">
                            <i class="fas fa-star" style="color: #000000;"></i>
                            <i class="fas fa-star" style="color: #000000;"></i>
                            <i class="fas fa-star" style="color: #000000;"></i>
                            <i class="fas fa-star" style="color: #000000;"></i>
                            <i class="fas fa-star" style="color: #000000;"></i>
                            <span class="ms-2">(175 reviews)</span>
                        </div>
                        <div class="price-section">
                            <p class="price">Rs 52,847</p>
                            <p class="original-price"><s>Rs 66,060</s></p>
                        </div>
                        <button class="btn-primary-custom w-100">Add to Cart</button>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="product-card">
                        <div class="product-image-shop">
                            <img src="https://images.pexels.com/photos/3962288/pexels-photo-3962288.jpeg?w=300&h=400&fit=crop" alt="Golden Hour" class="img-fluid">
                            <span class="sale-badge">-18%</span>
                        </div>
                        <h5 class="mt-3">Golden Hour</h5>
                        <p class="text-muted">Premium quality perfume</p>
                        <div class="rating mb-2">
                            <i class="fas fa-star" style="color: #000000;"></i>
                            <i class="fas fa-star" style="color: #000000;"></i>
                            <i class="fas fa-star" style="color: #000000;"></i>
                            <i class="fas fa-star" style="color: #000000;"></i>
                            <i class="fas fa-star-half" style="color: #000000;"></i>
                            <span class="ms-2">(198 reviews)</span>
                        </div>
                        <div class="price-section">
                            <p class="price">Rs 50,097</p>
                            <p class="original-price"><s>Rs 61,095</s></p>
                        </div>
                        <button class="btn-primary-custom w-100">Add to Cart</button>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="product-card">
                        <div class="product-image-shop">
                            <img src="https://images.pexels.com/photos/3807517/pexels-photo-3807517.jpeg?w=300&h=400&fit=crop" alt="Ocean Breeze" class="img-fluid">
                            <span class="sale-badge">-16%</span>
                        </div>
                        <h5 class="mt-3">Ocean Breeze</h5>
                        <p class="text-muted">Premium quality perfume</p>
                        <div class="rating mb-2">
                            <i class="fas fa-star" style="color: #000000;"></i>
                            <i class="fas fa-star" style="color: #000000;"></i>
                            <i class="fas fa-star" style="color: #000000;"></i>
                            <i class="fas fa-star" style="color: #000000;"></i>
                            <i class="fas fa-star" style="color: #000000;"></i>
                            <span class="ms-2">(205 reviews)</span>
                        </div>
                        <div class="price-section">
                            <p class="price">Rs 48,647</p>
                            <p class="original-price"><s>Rs 57,935</s></p>
                        </div>
                        <button class="btn-primary-custom w-100">Add to Cart</button>
                    </div>
                </div>
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
            color: #000000;
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
    </style>
@endsection

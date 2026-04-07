@extends('frontend.layouts.app')

@section('title', 'About Us - Almukhtar Perfume')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section-centered" style="background-image: url('{{ asset('frontend/images/perfume3.jfif') }}');">
        <div class="hero-overlay-light"></div>
        
        <div class="hero-content-centered">
            <div class="hero-text-centered">
                <h1>Our Story</h1>
                <p>Almukhtar Perfume has been crafting exceptional fragrances since 2010, bringing luxury and elegance to fragrance lovers worldwide.</p>
            </div>
        </div>
    </section>

    <!-- About Content -->
    <section class="page-content">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-6">
                    <h2 class="section-title">Who We Are</h2>
                    <p class="text-muted">
                        Almukhtar Perfume is a premium fragrance brand dedicated to creating exceptional scents that capture the essence of luxury and sophistication. Our master perfumers work tirelessly to blend the finest ingredients from around the world.
                    </p>
                    <p class="text-muted">
                        Each fragrance in our collection is a masterpiece, carefully crafted to evoke emotions and create lasting memories. We believe that a great perfume is more than just a scent—it's a statement of style and personality.
                    </p>
                </div>
                <div class="col-md-6">
                    <img src="https://images.pexels.com/photos/3807517/pexels-photo-3807517.jpeg?w=500&h=400&fit=crop" alt="Our Workshop" class="img-fluid rounded">
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-md-6">
                    <img src="https://images.pexels.com/photos/3962287/pexels-photo-3962287.jpeg?w=500&h=400&fit=crop" alt="Quality Ingredients" class="img-fluid rounded">
                </div>
                <div class="col-md-6">
                    <h2 class="section-title">Our Mission</h2>
                    <p class="text-muted">
                        Our mission is to provide the world with premium fragrances that inspire confidence and elegance. We are committed to:
                    </p>
                    <ul class="text-muted">
                        <li>✓ Using only the finest natural and synthetic ingredients</li>
                        <li>✓ Supporting sustainable and ethical sourcing practices</li>
                        <li>✓ Creating innovative fragrances that stand the test of time</li>
                        <li>✓ Delivering exceptional customer service and satisfaction</li>
                        <li>✓ Continuously evolving our craft and techniques</li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <h2 class="section-title">Why Choose Almukhtar Perfume?</h2>
                    <div class="row">
                        <div class="col-md-3 text-center mb-4">
                            <div class="feature-box">
                                <i class="fas fa-crown" style="font-size: 2.5rem; color: #d4af37; margin-bottom: 1rem;"></i>
                                <h5 style="color: #ffffff;">Premium Quality</h5>
                                <p class="text-muted">Only the finest ingredients</p>
                            </div>
                        </div>
                        <div class="col-md-3 text-center mb-4">
                            <div class="feature-box">
                                <i class="fas fa-leaf" style="font-size: 2.5rem; color: #d4af37; margin-bottom: 1rem;"></i>
                                <h5 style="color: #ffffff;">Sustainable</h5>
                                <p class="text-muted">Eco-friendly practices</p>
                            </div>
                        </div>
                        <div class="col-md-3 text-center mb-4">
                            <div class="feature-box">
                                <i class="fas fa-shipping-fast" style="font-size: 2.5rem; color: #d4af37; margin-bottom: 1rem;"></i>
                                <h5 style="color: #ffffff;">Fast Shipping</h5>
                                <p class="text-muted">Worldwide delivery</p>
                            </div>
                        </div>
                        <div class="col-md-3 text-center mb-4">
                            <div class="feature-box">
                                <i class="fas fa-headset" style="font-size: 2.5rem; color: #d4af37; margin-bottom: 1rem;"></i>
                                <h5 style="color: #ffffff;">24/7 Support</h5>
                                <p class="text-muted">Always here to help</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .feature-box {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 2rem;
            transition: all 0.3s ease;
        }

        .feature-box:hover {
            border-color: #000000;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            transform: translateY(-5px);
        }

        .feature-box i {
            color: #000000;
        }

        .text-muted {
            color: #000000 !important;
            line-height: 1.8;
        }

        ul {
            list-style: none;
            padding-left: 0;
        }

        ul li {
            margin-bottom: 0.8rem;
            font-size: 1.1rem;
            color: #000000;
        }

        .feature-box h5 {
            color: #000000;
        }
    </style>
@endsection

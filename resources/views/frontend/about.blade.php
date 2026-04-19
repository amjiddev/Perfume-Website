@extends('frontend.layouts.app')

@section('title', 'About Us - Almukhtar Perfume')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section-centered" @if($aboutPage->hero_image) style="background-image: url('{{ asset($aboutPage->hero_image) }}');" @else style="background-image: url('{{ asset('frontend/images/perfume2.jpg') }}');" @endif>
        <div class="hero-overlay-light"></div>
        
        <div class="hero-content-centered">
            <div class="hero-text-centered">
                <h1>{{ $aboutPage->hero_heading }}</h1>
                <p>{{ $aboutPage->hero_subheading }}</p>
            </div>
        </div>
    </section>

    <!-- Content Section 1 -->
    @if($aboutPage->content_section_1_title)
    <section class="page-content about-section-1">
        <div class="container">
            <div class="row align-items-center gap-4">
                <div class="col-lg-6">
                    <p class="collection-label">ABOUT US</p>
                    <h2 class="section-title text-start">{{ $aboutPage->content_section_1_title }}</h2>
                    <p class="about-text">{{ $aboutPage->content_section_1_description }}</p>
                </div>
                @if($aboutPage->content_section_1_image)
                <div class="col-lg-5">
                    <div class="about-image-wrapper">
                        <img src="{{ asset($aboutPage->content_section_1_image) }}" alt="{{ $aboutPage->content_section_1_title }}" class="img-fluid about-image">
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
    @endif

    <!-- Content Section 2 -->
    @if($aboutPage->content_section_2_title)
    <section class="page-content about-section-2" style="background-color: #f9f9f9;">
        <div class="container">
            <div class="row align-items-center gap-4">
                @if($aboutPage->content_section_2_image)
                <div class="col-lg-5">
                    <div class="about-image-wrapper">
                        <img src="{{ asset($aboutPage->content_section_2_image) }}" alt="{{ $aboutPage->content_section_2_title }}" class="img-fluid about-image">
                    </div>
                </div>
                @endif
                <div class="col-lg-6">
                    <p class="collection-label">WHY CHOOSE US</p>
                    <h2 class="section-title text-start">{{ $aboutPage->content_section_2_title }}</h2>
                    <p class="about-text">{{ $aboutPage->content_section_2_description }}</p>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Mission, Vision, Values Section -->
    <section class="page-content">
        <div class="container">
            <p class="collection-label text-center">OUR FOUNDATION</p>
            <h2 class="section-title text-center mb-5">Mission, Vision & Values</h2>
            
            <div class="row">
                @if($aboutPage->mission_title)
                <div class="col-md-4 mb-4">
                    <div class="about-card">
                        <div class="about-card-icon">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <h5>{{ $aboutPage->mission_title }}</h5>
                        <p>{{ $aboutPage->mission_description }}</p>
                    </div>
                </div>
                @endif

                @if($aboutPage->vision_title)
                <div class="col-md-4 mb-4">
                    <div class="about-card">
                        <div class="about-card-icon">
                            <i class="fas fa-eye"></i>
                        </div>
                        <h5>{{ $aboutPage->vision_title }}</h5>
                        <p>{{ $aboutPage->vision_description }}</p>
                    </div>
                </div>
                @endif

                @if($aboutPage->values_title)
                <div class="col-md-4 mb-4">
                    <div class="about-card">
                        <div class="about-card-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h5>{{ $aboutPage->values_title }}</h5>
                        <p>{{ $aboutPage->values_description }}</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>

    <style>
        .page-content {
            padding: 4rem 0;
        }

        .collection-label {
            text-align: center;
            color: #999999;
            font-size: 0.85rem;
            font-weight: 700;
            letter-spacing: 2px;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
        }

        .collection-label.text-start {
            text-align: left;
        }

        .section-title {
            text-align: center;
            color: #000000;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .section-title.text-start {
            text-align: left;
        }

        .about-text {
            color: #666666;
            font-size: 1rem;
            line-height: 1.8;
            margin-bottom: 1.5rem;
        }

        .about-image-wrapper {
            width: 100%;
            height: 400px;
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .about-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .about-section-1 {
            padding: 4rem 0;
        }

        .about-section-2 {
            padding: 4rem 0;
        }

        .about-card {
            background-color: #ffffff;
            border: 1px solid #e8e8e8;
            border-radius: 8px;
            padding: 2rem 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
            height: 100%;
        }

        .about-card:hover {
            border-color: #C8A96A;
            box-shadow: 0 15px 40px rgba(200, 169, 106, 0.15);
            transform: translateY(-5px);
        }

        .about-card-icon {
            font-size: 2.5rem;
            color: #C8A96A;
            margin-bottom: 1.5rem;
            display: block;
            transition: all 0.3s ease;
        }

        .about-card:hover .about-card-icon {
            transform: scale(1.1);
        }

        .about-card h5 {
            color: #000000;
            font-weight: 700;
            margin-bottom: 1rem;
            font-size: 1.2rem;
        }

        .about-card p {
            color: #666666;
            font-size: 0.95rem;
            line-height: 1.7;
            margin: 0;
        }

        @media (max-width: 768px) {
            .page-content {
                padding: 2rem 0;
            }

            .section-title {
                font-size: 1.8rem;
                margin-bottom: 1rem;
            }

            .about-text {
                font-size: 0.95rem;
                line-height: 1.7;
                margin-bottom: 1.2rem;
            }

            .about-image-wrapper {
                height: 300px;
                margin-top: 1.5rem;
            }

            .about-card {
                padding: 1.5rem 1rem;
            }

            .about-card h5 {
                font-size: 1rem;
                margin-bottom: 0.8rem;
            }

            .about-card p {
                font-size: 0.9rem;
            }

            .about-card-icon {
                font-size: 2rem;
                margin-bottom: 1rem;
            }

            .row.gap-4 {
                gap: 1rem !important;
            }
        }
    </style>
@endsection

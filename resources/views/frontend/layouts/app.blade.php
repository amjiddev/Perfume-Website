<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Perfume Store') - Luxury Fragrances</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #ffffff;
            color: #1a1a1a;
            scroll-behavior: smooth;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
        }

        /* Navbar Styling */
        .navbar {
            background-color: #000000;
            border-bottom: 1px solid #C8A96A;
            padding: 0.8rem 0;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.2);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: #C8A96A !important;
            letter-spacing: 2px;
            text-transform: uppercase;
            font-family: 'Playfair Display', serif;
        }

        .nav-link {
            color: #ffffff !important;
            margin: 0 0.8rem;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
            font-size: 0.95rem;
        }

        .nav-link:hover {
            color: #C8A96A !important;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: #C8A96A;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .nav-link.active {
            color: #C8A96A !important;
        }

        .nav-link.active::after {
            width: 100%;
        }

        /* Dropdown Menu */
        .navbar-nav .dropdown-menu {
            background-color: #1a1a1a;
            border: 1px solid #C8A96A;
            border-radius: 6px;
            padding: 0.5rem 0;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            animation: slideDown 0.3s ease;
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            min-width: 150px;
        }

        .navbar-nav .dropdown-menu.show {
            display: block;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .navbar-nav .dropdown-menu .dropdown-item {
            color: #ffffff;
            padding: 0.8rem 1.5rem;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 0.95rem;
        }

        .navbar-nav .dropdown-menu .dropdown-item:hover {
            background-color: rgba(200, 169, 106, 0.1);
            color: #C8A96A;
            padding-left: 2rem;
        }

        .navbar-nav .dropdown-menu .dropdown-item.active {
            background-color: rgba(200, 169, 106, 0.2);
            color: #C8A96A;
        }

        .navbar-nav .nav-link.dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .navbar-nav .nav-link.dropdown-toggle::after {
            display: none;
        }

        .navbar-nav .nav-link.dropdown-toggle i {
            font-size: 0.75rem;
            transition: transform 0.3s ease;
        }

        .navbar-nav .dropdown:hover .nav-link.dropdown-toggle i {
            transform: rotate(180deg);
        }

        .navbar-icons {
            display: flex;
            gap: 1.5rem;
            align-items: center;
            margin-left: 2rem;
        }

        .navbar-icon {
            color: #ffffff;
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }

        .navbar-icon:hover {
            color: #C8A96A;
        }

        .search-box {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid #C8A96A;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            color: #ffffff;
            width: 200px;
            transition: all 0.3s ease;
        }

        .search-box::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .search-box:focus {
            outline: none;
            background-color: rgba(255, 255, 255, 0.15);
            box-shadow: 0 0 10px rgba(200, 169, 106, 0.3);
        }

        /* Hero Section */
        .hero-section {
            min-height: 700px;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero-slider-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        .hero-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: right center;
            opacity: 0;
            transition: opacity 0.8s ease-in-out;
        }

        .hero-slide.active {
            opacity: 1;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, rgba(0, 0, 0, 0.7) 0%, rgba(0, 0, 0, 0.3) 50%, rgba(0, 0, 0, 0) 100%);
            z-index: 2;
        }

        .hero-content {
            position: relative;
            z-index: 3;
            display: flex;
            align-items: center;
            width: 100%;
            height: 100%;
        }

        .hero-text {
            flex: 1;
            padding: 4rem 3rem 4rem 10rem;
            max-width: 600px;
        }

        .hero-text h1 {
            font-size: 4rem;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 3px;
            line-height: 1.2;
        }

        .hero-text p {
            font-size: 1.1rem;
            color: #e0e0e0;
            margin-bottom: 2.5rem;
            line-height: 1.8;
            max-width: 500px;
        }

        .hero-buttons {
            display: flex;
            gap: 1.5rem;
        }

        /* Slider Controls */
        .slider-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(200, 169, 106, 0.8);
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            color: #ffffff;
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(5px);
            z-index: 4;
        }

        .slider-btn-left {
            left: 30px;
        }

        .slider-btn-right {
            right: 30px;
        }

        .slider-btn:hover {
            background: #C8A96A;
            transform: translateY(-50%) scale(1.1);
            box-shadow: 0 5px 20px rgba(200, 169, 106, 0.4);
        }

        /* Slider Indicators */
        .hero-slider-indicators {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 1rem;
            z-index: 4;
        }

        .indicator {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .indicator:hover {
            background: rgba(255, 255, 255, 0.8);
        }

        .indicator.active {
            background: #C8A96A;
            width: 30px;
            border-radius: 6px;
            box-shadow: 0 0 15px rgba(200, 169, 106, 0.5);
        }

        .hero-image {
            display: none;
        }

        /* Centered Hero Section (for other pages) */
        .hero-section-centered {
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 600px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .hero-overlay-centered {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: 2;
        }

        .hero-overlay-light {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3);
            z-index: 2;
        }

        .hero-content-centered {
            position: relative;
            z-index: 3;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
        }

        .hero-text-centered {
            text-align: center;
            color: #ffffff;
            max-width: 700px;
            padding: 3rem;
        }

        .hero-text-centered h1 {
            font-size: 4rem;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 3px;
            line-height: 1.2;
            white-space: nowrap;
        }

        .hero-text-centered p {
            font-size: 1.1rem;
            color: #e0e0e0;
            margin-bottom: 2.5rem;
            line-height: 1.8;
            font-weight: 300;
            letter-spacing: 0.5px;
        }

        .hero-text-centered .hero-buttons {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #C8A96A 0%, #d4b876 100%);
            color: #000000;
            padding: 1rem 2.5rem;
            border: none;
            border-radius: 50px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
            font-size: 0.95rem;
            letter-spacing: 1px;
            box-shadow: 0 5px 20px rgba(200, 169, 106, 0.3);
            position: relative;
            overflow: hidden;
            white-space: nowrap;
        }

        .btn-primary-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            transition: left 0.3s ease;
            z-index: 0;
        }

        .btn-primary-custom:hover::before {
            left: 100%;
        }

        .btn-primary-custom:hover {
            background: linear-gradient(135deg, #d4b876 0%, #C8A96A 100%);
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(200, 169, 106, 0.5);
        }

        .btn-primary-custom i {
            font-size: 1.1rem;
            position: relative;
            z-index: 1;
        }

        .btn-secondary-custom {
            background-color: transparent;
            color: #C8A96A;
            padding: 1rem 2.5rem;
            border: 2px solid #C8A96A;
            border-radius: 50px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
            font-size: 0.95rem;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
            white-space: nowrap;
        }

        .btn-secondary-custom::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: #C8A96A;
            transition: left 0.3s ease;
            z-index: 0;
        }

        .btn-secondary-custom:hover::before {
            left: 100%;
        }

        .btn-secondary-custom:hover {
            color: #000000;
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(200, 169, 106, 0.3);
        }

        .btn-secondary-custom i {
            font-size: 1.1rem;
            position: relative;
            z-index: 1;
        }

        .hero-image {
            display: none;
        }

        /* Footer */
        footer {
            background-color: #1a1a1a;
            border-top: 2px solid #C8A96A;
            padding: 4rem 0 1rem;
            margin-top: 5rem;
            color: #e0e0e0;
        }

        footer h5 {
            color: #C8A96A;
            margin-bottom: 1.5rem;
            font-weight: 700;
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
        }

        footer p {
            color: #b0b0b0;
            line-height: 1.8;
        }

        footer a {
            color: #b0b0b0;
            text-decoration: none;
            transition: color 0.3s ease;
            font-size: 0.95rem;
        }

        footer a:hover {
            color: #C8A96A;
        }

        footer ul li {
            margin-bottom: 0.8rem;
        }

        .footer-bottom {
            border-top: 1px solid #333333;
            padding-top: 2rem;
            margin-top: 2rem;
            text-align: center;
            color: #808080;
            font-size: 0.9rem;
        }

        /* Page Content */
        .page-content {
            min-height: auto;
            padding: 4rem 0;
        }

        .section-title {
            font-size: 2.8rem;
            color: #000000;
            margin-bottom: 1rem;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 800;
        }

        .section-subtitle {
            font-size: 1rem;
            color: #666666;
            text-align: center;
            margin-bottom: 3.5rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.8;
        }

        .collection-label {
            text-align: center;
            color: #C8A96A;
            font-size: 0.85rem;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 0.8rem;
            font-weight: 600;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-section {
                min-height: 500px;
            }

            .hero-content {
                flex-direction: column;
            }

            .hero-text {
                padding: 2rem 1.5rem 2rem 2rem;
                max-width: 100%;
            }

            .hero-text h1 {
                font-size: 2.2rem;
            }

            .hero-text p {
                font-size: 0.95rem;
            }

            .hero-buttons {
                flex-direction: column;
                gap: 1rem;
            }

            .btn-primary-custom,
            .btn-secondary-custom {
                width: 100%;
                text-align: center;
                justify-content: center;
            }

            .slider-btn {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }

            .slider-btn-left {
                left: 15px;
            }

            .slider-btn-right {
                right: 15px;
            }

            .hero-slider-indicators {
                bottom: 20px;
                gap: 0.8rem;
            }

            .indicator {
                width: 10px;
                height: 10px;
            }

            .indicator.active {
                width: 25px;
            }

            /* Centered Hero Section Mobile */
            .hero-section-centered {
                min-height: 500px;
                background-attachment: scroll;
            }

            .hero-text-centered {
                padding: 2rem 1.5rem;
            }

            .hero-text-centered h1 {
                font-size: 2.2rem;
                white-space: normal;
            }

            .hero-text-centered p {
                font-size: 0.95rem;
            }

            .hero-text-centered .hero-buttons {
                flex-direction: column;
            }

            .nav-link {
                margin: 0.5rem 0;
            }

            .navbar-icons {
                margin-left: 1rem;
                gap: 1rem;
            }

            .search-box {
                width: 150px;
                font-size: 0.85rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .navbar-nav .dropdown-menu {
                background-color: #0d0d0d;
                border-left: 3px solid #C8A96A;
            }

            .navbar-nav .dropdown-menu .dropdown-item {
                padding: 0.7rem 1.5rem;
            }

            .navbar-nav .dropdown-menu .dropdown-item:hover {
                padding-left: 1.5rem;
            }
        }
    </style>
    @yield('extra-css')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                 ALMUKHTAR
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item dropdown" onmouseenter="this.querySelector('.dropdown-menu').classList.add('show')" onmouseleave="this.querySelector('.dropdown-menu').classList.remove('show')">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('shop') ? 'active' : '' }}" href="{{ route('shop') }}" id="shopDropdown" role="button" aria-expanded="false">
                            Shop <i class="fas fa-chevron-down"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="shopDropdown">
                            <li><a class="dropdown-item" href="/perfumes">Perfumes</a></li>
                            <li><a class="dropdown-item" href="/attar">Attar</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
                    </li>
                </ul>
                <div class="navbar-icons">
                    <input type="text" class="search-box" placeholder="Search perfumes...">
                    <a href="#" class="navbar-icon" title="Wishlist">
                        <i class="far fa-heart"></i>
                    </a>
                    <a href="#" class="navbar-icon" title="Shopping Cart">
                        <i class="fas fa-shopping-bag"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h5><i class="fas fa-bottle-droplet"></i> Almukhtar Perfume</h5>
                    <p>Premium fragrances for the discerning taste.</p>
                </div>
                <div class="col-md-3">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('shop') }}">Shop</a></li>
                        <li><a href="{{ route('about') }}">About</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Customer Service</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Shipping Info</a></li>
                        <li><a href="#">Returns</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Follow Us</h5>
                    <div>
                        <a href="#" class="me-2"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="me-2"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="me-2"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 Almukhtar Perfume. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('extra-js')
</body>
</html>

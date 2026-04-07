@extends('frontend.layouts.app')

@section('title', 'Contact Us - Almukhtar Perfume')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section-centered" style="background-image: url('{{ asset('frontend/images/perfume6.jfif') }}');">
        <div class="hero-overlay-light"></div>
        
        <div class="hero-content-centered">
            <div class="hero-text-centered">
                <h1>Get in Touch</h1>
                <p>Have questions about our fragrances? We'd love to hear from you. Contact us today and let's start a conversation.</p>
            </div>
        </div>
    </section>

    <!-- Contact Content -->
    <section class="page-content">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-4 text-center mb-4">
                    <div class="contact-info-box">
                        <i class="fas fa-map-marker-alt"></i>
                        <h5>Address</h5>
                        <p>123 Luxury Lane<br>Fragrance City, FC 12345<br>United States</p>
                    </div>
                </div>
                <div class="col-md-4 text-center mb-4">
                    <div class="contact-info-box">
                        <i class="fas fa-phone"></i>
                        <h5>Phone</h5>
                        <p>+1 (555) 123-4567<br>+1 (555) 987-6543<br>Mon - Fri: 9AM - 6PM EST</p>
                    </div>
                </div>
                <div class="col-md-4 text-center mb-4">
                    <div class="contact-info-box">
                        <i class="fas fa-envelope"></i>
                        <h5>Email</h5>
                        <p>info@almukhtarperfume.com<br>support@almukhtarperfume.com<br>sales@almukhtarperfume.com</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <h2 class="section-title">Send us a Message</h2>
                    <form id="contact-form" class="contact-form">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone">
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" class="form-control" id="subject" name="subject" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="6" required></textarea>
                        </div>
                        <button type="submit" class="btn-submit">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <style>
        .contact-info-box {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 2rem;
            transition: all 0.3s ease;
        }

        .contact-info-box:hover {
            border-color: #000000;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
            transform: translateY(-5px);
        }

        .contact-info-box i {
            font-size: 2.5rem;
            color: #000000;
            margin-bottom: 1rem;
        }

        .contact-info-box h5 {
            color: #000000;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .contact-info-box p {
            color: #000000;
            line-height: 1.8;
        }

        .contact-form {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 2rem;
        }

        .form-label {
            color: #000000;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .form-control {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 0.8rem;
            color: #000000;
            background-color: #ffffff;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #d4af37;
            box-shadow: 0 0 0 0.2rem rgba(212, 175, 55, 0.25);
            color: #000000;
        }

        .form-control::placeholder {
            color: #999;
        }

        .btn-submit {
            background-color: #000000;
            color: #ffffff;
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1rem;
            width: 100%;
        }

        .btn-submit:hover {
            background-color: #333333;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        @media (max-width: 768px) {
            .contact-info-box {
                margin-bottom: 1.5rem;
            }

            .contact-form {
                padding: 1.5rem;
            }
        }
    </style>
@endsection

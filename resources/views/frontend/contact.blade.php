@extends('frontend.layouts.app')

@section('title', 'Contact Us - Almukhtar Perfume')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section-centered" @if($contactPage->hero_image) style="background-image: url('{{ asset($contactPage->hero_image) }}');" @else style="background-image: url('{{ asset('frontend/images/perfume2.jpg') }}');" @endif>
        <div class="hero-overlay-light"></div>
        
        <div class="hero-content-centered">
            <div class="hero-text-centered">
                <h1>{{ $contactPage->hero_heading }}</h1>
                <p>{{ $contactPage->hero_subheading }}</p>
            </div>
        </div>
    </section>

    <!-- Description Section -->
    @if($contactPage->description)
    <section class="page-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <p class="about-text">{{ $contactPage->description }}</p>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Contact Information & Form Section -->
    <section class="page-content" style="background-color: #f9f9f9;">
        <div class="container">
            <div class="row">
                <!-- Contact Information -->
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <h3 class="mb-4">Contact Information</h3>
                    
                    @if($contactPage->phone)
                    <div class="contact-info-item mb-4">
                        <div class="contact-info-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="contact-info-content">
                            <h6>Phone</h6>
                            <p><a href="tel:{{ str_replace(' ', '', $contactPage->phone) }}">{{ $contactPage->phone }}</a></p>
                        </div>
                    </div>
                    @endif

                    @if($contactPage->email)
                    <div class="contact-info-item mb-4">
                        <div class="contact-info-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-info-content">
                            <h6>Email</h6>
                            <p><a href="mailto:{{ $contactPage->email }}">{{ $contactPage->email }}</a></p>
                        </div>
                    </div>
                    @endif

                    @if($contactPage->address)
                    <div class="contact-info-item mb-4">
                        <div class="contact-info-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="contact-info-content">
                            <h6>Address</h6>
                            <p>{{ $contactPage->address }}</p>
                        </div>
                    </div>
                    @endif

                    @if($contactPage->office_hours)
                    <div class="contact-info-item">
                        <div class="contact-info-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="contact-info-content">
                            <h6>Office Hours</h6>
                            <p style="white-space: pre-line;">{{ $contactPage->office_hours }}</p>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Contact Form -->
                <div class="col-lg-7">
                    <div class="contact-form-wrapper">
                        @if($contactPage->contact_form_title)
                        <h3 class="mb-2">{{ $contactPage->contact_form_title }}</h3>
                        @endif
                        @if($contactPage->contact_form_description)
                        <p class="text-muted mb-4">{{ $contactPage->contact_form_description }}</p>
                        @endif

                        <form class="contact-form" id="contactForm">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email_form" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="email_form" name="email" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="phone_form" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="phone_form" name="phone">
                            </div>

                            <div class="mb-3">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" class="form-control" id="subject" name="subject" required>
                            </div>

                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                            </div>

                            <button type="submit" class="btn-primary-custom w-100">
                                <i class="fas fa-paper-plane me-2"></i>Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    @if($contactPage->map_embed_code)
    <section class="page-content">
        <div class="container">
            <h3 class="mb-4 text-center">Find Us On Map</h3>
            <div class="map-container">
                {!! $contactPage->map_embed_code !!}
            </div>
        </div>
    </section>
    @endif

    <style>
        .page-content {
            padding: 4rem 0;
        }

        .about-text {
            color: #666666;
            font-size: 1rem;
            line-height: 1.8;
            margin-bottom: 1.5rem;
        }

        .contact-info-item {
            display: flex;
            gap: 1.5rem;
            padding: 1.5rem;
            background-color: #ffffff;
            border-radius: 8px;
            border: 1px solid #e8e8e8;
            transition: all 0.3s ease;
        }

        .contact-info-item:hover {
            border-color: #C8A96A;
            box-shadow: 0 10px 30px rgba(200, 169, 106, 0.1);
            transform: translateY(-3px);
        }

        .contact-info-icon {
            font-size: 1.8rem;
            color: #C8A96A;
            min-width: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .contact-info-content h6 {
            color: #000000;
            font-weight: 700;
            margin-bottom: 0.5rem;
            font-size: 1rem;
        }

        .contact-info-content p {
            color: #666666;
            margin: 0;
            font-size: 0.95rem;
        }

        .contact-info-content a {
            color: #C8A96A;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .contact-info-content a:hover {
            color: #000000;
            text-decoration: underline;
        }

        .contact-form-wrapper {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 8px;
            border: 1px solid #e8e8e8;
        }

        .contact-form-wrapper h3 {
            color: #000000;
            font-weight: 700;
            font-size: 1.5rem;
        }

        .contact-form .form-label {
            color: #000000;
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        .contact-form .form-control {
            border: 1px solid #e8e8e8;
            border-radius: 6px;
            padding: 0.8rem 1rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .contact-form .form-control:focus {
            border-color: #C8A96A;
            box-shadow: 0 0 0 0.2rem rgba(200, 169, 106, 0.15);
            outline: none;
        }

        .map-container {
            width: 100%;
            height: 500px;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .map-container iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        @media (max-width: 768px) {
            .page-content {
                padding: 2rem 0;
            }

            .contact-form-wrapper {
                padding: 1.5rem;
            }

            .contact-info-item {
                padding: 1rem;
                gap: 1rem;
            }

            .contact-info-icon {
                font-size: 1.5rem;
                min-width: 40px;
            }

            .map-container {
                height: 300px;
            }
        }
    </style>

    <script>
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            const formData = {
                name: document.getElementById('name').value,
                email: document.getElementById('email_form').value,
                phone: document.getElementById('phone_form').value,
                subject: document.getElementById('subject').value,
                message: document.getElementById('message').value,
            };

            // Here you can send the data to your backend
            console.log('Form submitted:', formData);
            
            // Show success message
            alert('Thank you for your message! We will get back to you soon.');
            
            // Reset form
            this.reset();
        });
    </script>
@endsection

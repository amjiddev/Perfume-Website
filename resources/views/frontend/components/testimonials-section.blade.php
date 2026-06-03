<!-- Testimonials/Reviews Section -->
<section class="testimonials-section">
    <div class="container">
        <p class="collection-label">TESTIMONIALS</p>
        <h2 class="section-title">What Our Clients Say</h2>
        
        <div class="testimonials-carousel-wrapper">
            <div class="testimonials-carousel" id="testimonialsCarousel">
                @forelse($reviews as $review)
                    <div class="testimonial-card">
                        <div class="testimonial-header">
                            @if($review->image)
                                <img src="{{ asset($review->image) }}" alt="{{ $review->author }}" class="testimonial-avatar">
                            @else
                                <div class="testimonial-avatar-placeholder">
                                    <i class="fas fa-user"></i>
                                </div>
                            @endif
                        </div>
                        
                        <div class="testimonial-content">
                            <div class="testimonial-quote-icon">
                                <i class="fas fa-quote-left"></i>
                            </div>
                            <p class="testimonial-text">{{ $review->text }}</p>
                            <div class="testimonial-quote-icon-right">
                                <i class="fas fa-quote-right"></i>
                            </div>
                        </div>
                        
                        <div class="testimonial-footer">
                            <h5 class="testimonial-author">{{ $review->author }}</h5>
                            @if($review->rating)
                                <div class="testimonial-rating">
                                    @for($i = 0; $i < floor($review->rating); $i++)
                                        <i class="fas fa-star"></i>
                                    @endfor
                                    @if($review->rating % 1 != 0)
                                        <i class="fas fa-star-half-alt"></i>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">No testimonials available yet.</p>
                    </div>
                @endforelse
            </div>
            
            @if($reviews->count() > 0)
                <!-- Carousel Controls -->
                <button class="testimonial-nav-btn testimonial-nav-prev" onclick="prevTestimonial()">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="testimonial-nav-btn testimonial-nav-next" onclick="nextTestimonial()">
                    <i class="fas fa-chevron-right"></i>
                </button>
                
                <!-- Carousel Indicators -->
                <div class="testimonial-indicators">
                    @for($i = 0; $i < $reviews->count(); $i++)
                        <span class="testimonial-indicator {{ $i === 0 ? 'active' : '' }}" onclick="goToTestimonial({{ $i }})"></span>
                    @endfor
                </div>
            @endif
        </div>
    </div>
</section>

<style>
    .testimonials-section {
        background: linear-gradient(135deg, #f9f9f9 0%, #ffffff 100%);
        padding: 4rem 0;
        position: relative;
        overflow: hidden;
    }

    .testimonials-carousel-wrapper {
        position: relative;
        margin-top: 3rem;
    }

    .testimonials-carousel {
        display: flex;
        gap: 2rem;
        overflow: hidden;
        transition: transform 0.5s ease;
        justify-content: center;
    }

    .testimonial-card {
        flex: 0 0 calc(33.333% - 1.33rem);
        background-color: #ffffff;
        border-radius: 12px;
        padding: 1rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        min-height: 260px;
        position: relative;
        max-width: 280px;
    }

    .testimonial-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #1a7c3a 0%, #C8A96A 100%);
        border-radius: 12px 12px 0 0;
    }

    .testimonial-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(26, 124, 58, 0.1);
    }

    /* Center card special hover effect */
    .testimonial-card.center-card {
        transform: scale(1.12);
        box-shadow: 0 20px 50px rgba(26, 124, 58, 0.25);
        background: linear-gradient(135deg, #ffffff 0%, #f0f8f4 100%);
    }

    .testimonial-card.center-card:hover {
        transform: scale(1.15);
        box-shadow: 0 25px 60px rgba(26, 124, 58, 0.35);
    }

    .testimonial-header {
        text-align: center;
        margin-bottom: 0.8rem;
    }

    .testimonial-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #1a7c3a;
        box-shadow: 0 4px 12px rgba(26, 124, 58, 0.2);
    }

    .testimonial-avatar-placeholder {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, #1a7c3a 0%, #C8A96A 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 1.5rem;
        margin: 0 auto;
        box-shadow: 0 4px 12px rgba(26, 124, 58, 0.2);
    }

    .testimonial-content {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        margin-bottom: 0.8rem;
        position: relative;
    }

    .testimonial-quote-icon {
        color: #C8A96A;
        font-size: 1rem;
        margin-bottom: 0.3rem;
        opacity: 0.6;
    }

    .testimonial-quote-icon-right {
        color: #C8A96A;
        font-size: 1rem;
        margin-top: 0.3rem;
        opacity: 0.6;
        transform: scaleX(-1);
    }

    .testimonial-text {
        color: #666666;
        font-size: 0.8rem;
        line-height: 1.5;
        margin: 0;
        font-style: italic;
    }

    .testimonial-footer {
        text-align: center;
        border-top: 1px solid #e8e8e8;
        padding-top: 0.8rem;
    }

    .testimonial-author {
        color: #000000;
        font-weight: 700;
        font-size: 0.85rem;
        margin: 0 0 0.3rem 0;
    }

    .testimonial-rating {
        color: #1a7c3a;
        font-size: 0.75rem;
        letter-spacing: 1px;
    }

    .testimonial-rating i {
        margin: 0 2px;
    }

    .testimonial-nav-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background-color: #1a7c3a;
        color: #ffffff;
        border: none;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        transition: all 0.3s ease;
        z-index: 10;
        box-shadow: 0 4px 12px rgba(26, 124, 58, 0.3);
    }

    .testimonial-nav-btn:hover {
        background-color: #C8A96A;
        transform: translateY(-50%) scale(1.1);
        box-shadow: 0 6px 16px rgba(200, 169, 106, 0.4);
    }

    .testimonial-nav-prev {
        left: -25px;
    }

    .testimonial-nav-next {
        right: -25px;
    }

    .testimonial-indicators {
        display: flex;
        justify-content: center;
        gap: 0.8rem;
        margin-top: 2rem;
    }

    .testimonial-indicator {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: #ddd;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .testimonial-indicator:hover {
        background-color: #1a7c3a;
    }

    .testimonial-indicator.active {
        background-color: #1a7c3a;
        width: 32px;
        border-radius: 6px;
    }

    @media (max-width: 1024px) {
        .testimonial-card {
            flex: 0 0 calc(50% - 1rem);
            min-height: 240px;
            max-width: 280px;
        }

        .testimonial-nav-prev {
            left: -20px;
        }

        .testimonial-nav-next {
            right: -20px;
        }
    }

    @media (max-width: 768px) {
        .testimonials-section {
            padding: 3rem 0;
        }

        .testimonials-carousel {
            gap: 1.5rem;
        }

        .testimonial-card {
            flex: 0 0 calc(100% - 1rem);
            min-height: 240px;
            padding: 0.9rem;
            max-width: 100%;
        }

        .testimonial-avatar {
            width: 50px;
            height: 50px;
        }

        .testimonial-avatar-placeholder {
            width: 50px;
            height: 50px;
            font-size: 1.2rem;
        }

        .testimonial-text {
            font-size: 0.75rem;
            line-height: 1.5;
        }

        .testimonial-nav-btn {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }

        .testimonial-nav-prev {
            left: -18px;
        }

        .testimonial-nav-next {
            right: -18px;
        }

        .section-title {
            font-size: 1.8rem;
        }
    }

    @media (max-width: 480px) {
        .testimonials-section {
            padding: 2rem 0;
        }

        .testimonials-carousel {
            gap: 1rem;
        }

        .testimonial-card {
            flex: 0 0 calc(100% - 0.5rem);
            min-height: 220px;
            padding: 0.8rem;
            max-width: 100%;
        }

        .testimonial-nav-btn {
            width: 36px;
            height: 36px;
            font-size: 0.9rem;
        }

        .testimonial-nav-prev {
            left: -15px;
        }

        .testimonial-nav-next {
            right: -15px;
        }
    }
</style>

<script>
    let currentTestimonialSlide = 0;
    const testimonialCards = document.querySelectorAll('.testimonial-card');
    const testimonialCarousel = document.getElementById('testimonialsCarousel');
    let testimonialAutoSlideTimer;

    function getTestimonialItemsPerSlide() {
        if (window.innerWidth <= 480) return 1;
        if (window.innerWidth <= 768) return 1;
        if (window.innerWidth <= 1024) return 2;
        return 3;
    }

    function updateCenterCardClass() {
        const itemsToShow = getTestimonialItemsPerSlide();
        testimonialCards.forEach((card, index) => {
            card.classList.remove('center-card');
            // Calculate which card should be in the center
            const centerIndex = currentTestimonialSlide + Math.floor(itemsToShow / 2);
            if (index === centerIndex) {
                card.classList.add('center-card');
            }
        });
    }

    function updateTestimonialCarouselPosition() {
        const itemsToShow = getTestimonialItemsPerSlide();
        const cardWidth = testimonialCards[0]?.offsetWidth || 0;
        const gap = 32; // 2rem gap
        // Slide by 1 card at a time
        const totalWidth = (cardWidth + gap) * currentTestimonialSlide;
        testimonialCarousel.style.transform = `translateX(-${totalWidth}px)`;
        
        // Update indicators
        const totalSlides = Math.ceil(testimonialCards.length - itemsToShow + 1);
        document.querySelectorAll('.testimonial-indicator').forEach((indicator, index) => {
            indicator.classList.toggle('active', index === currentTestimonialSlide);
        });

        // Update center card class
        updateCenterCardClass();
    }

    function nextTestimonial() {
        const itemsToShow = getTestimonialItemsPerSlide();
        const maxSlide = Math.max(0, testimonialCards.length - itemsToShow);
        currentTestimonialSlide = (currentTestimonialSlide + 1) % (maxSlide + 1);
        updateTestimonialCarouselPosition();
        clearTimeout(testimonialAutoSlideTimer);
        startTestimonialAutoSlide();
    }

    function prevTestimonial() {
        const itemsToShow = getTestimonialItemsPerSlide();
        const maxSlide = Math.max(0, testimonialCards.length - itemsToShow);
        currentTestimonialSlide = (currentTestimonialSlide - 1 + maxSlide + 1) % (maxSlide + 1);
        updateTestimonialCarouselPosition();
        clearTimeout(testimonialAutoSlideTimer);
        startTestimonialAutoSlide();
    }

    function goToTestimonial(index) {
        currentTestimonialSlide = index;
        updateTestimonialCarouselPosition();
        clearTimeout(testimonialAutoSlideTimer);
        startTestimonialAutoSlide();
    }

    function startTestimonialAutoSlide() {
        testimonialAutoSlideTimer = setTimeout(() => {
            nextTestimonial();
        }, 5000);
    }

    // Initialize testimonials carousel
    if (testimonialCards.length > 0) {
        setTimeout(() => {
            updateTestimonialCarouselPosition();
            startTestimonialAutoSlide();
        }, 100);
        
        window.addEventListener('resize', updateTestimonialCarouselPosition);
    }
</script>

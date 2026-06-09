<!-- Testimonials/Reviews Section -->
<section class="testimonials-section">
    <div class="container">
        <div class="testimonials-header">
            <p class="collection-label">TESTIMONIALS</p>
            <h2 class="section-title">Our Clients Say</h2>
        </div>
        
        <div class="testimonials-carousel-wrapper">
            <div class="testimonials-carousel" id="testimonialsCarousel">
                @forelse($reviews->take(8)->reverse() as $review)
                    <div class="testimonial-card">
                        <div class="testimonial-card-inner">
                            <div class="testimonial-header">
                                @if($review->image)
                                    <img src="{{ asset($review->image) }}" alt="{{ $review->author }}" class="testimonial-avatar">
                                @else
                                    <div class="testimonial-avatar-placeholder">
                                        <i class="fas fa-user"></i>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="testimonial-quote">
                                <i class="fas fa-quote-left"></i>
                            </div>
                            
                            <p class="testimonial-text">{{ $review->text }}</p>
                            
                            <div class="testimonial-quote-end">
                                <i class="fas fa-quote-right"></i>
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
                    </div>
                @empty
                    <div class="no-testimonials">
                        <p class="text-muted">No testimonials available yet.</p>
                    </div>
                @endforelse
            </div>
            
            @if($reviews->count() > 0)
                <!-- Carousel Controls -->
                <button class="testimonial-nav-btn testimonial-nav-next" onclick="nextTestimonialSlide()">
                    <i class="fas fa-chevron-right"></i>
                </button>
                <button class="testimonial-nav-btn testimonial-nav-prev" onclick="prevTestimonialSlide()">
                    <i class="fas fa-chevron-left"></i>
                </button>
            @endif
        </div>
    </div>
</section>

<style>
    .testimonials-section {
        background: linear-gradient(135deg, #ffffff 0%, #f5f5f5 100%);
        padding: 5rem 0;
        position: relative;
        overflow: visible;
    }

    .testimonials-header {
        text-align: left;
        margin-bottom: 3rem;
    }

    .collection-label {
        color: #999999;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 3px;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        display: block;
    }

    .section-title {
        font-size: 3rem;
        font-weight: 700;
        color: #000000;
        margin: 0;
        letter-spacing: -1px;
    }

    .testimonials-carousel-wrapper {
        position: relative;
        padding: 2rem 0;
        overflow: visible;
    }

    .testimonials-carousel {
        display: flex;
        gap: 1.5rem;
        overflow: hidden;
        transition: transform 0.7s cubic-bezier(0.4, 0, 0.2, 1);
        scroll-behavior: smooth;
    }

    .testimonial-card {
        flex: 0 0 calc(25% - 1.125rem);
        min-width: 0;
        height: 100%;
    }

    .testimonial-card-inner {
        background: #ffffff;
        border-radius: 8px;
        padding: 2.5rem 1.5rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        height: 100%;
        min-height: 350px;
        border-top: 3px solid #000000;
    }

    .testimonial-card:hover .testimonial-card-inner {
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        transform: translateY(-4px);
    }

    .testimonial-header {
        margin-bottom: 1.5rem;
    }

    .testimonial-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #000000;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .testimonial-avatar-placeholder {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: #000000;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 2.5rem;
        margin: 0 auto;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .testimonial-quote {
        color: #C8A96A;
        font-size: 1.8rem;
        margin-bottom: 1rem;
        opacity: 0.6;
    }

    .testimonial-text {
        color: #666666;
        font-size: 0.95rem;
        line-height: 1.8;
        margin: 1rem 0;
        font-style: italic;
        font-weight: 500;
        flex: 1;
        display: flex;
        align-items: center;
    }

    .testimonial-quote-end {
        color: #C8A96A;
        font-size: 1.8rem;
        margin-bottom: 1.5rem;
        opacity: 0.6;
        transform: scaleX(-1);
    }

    .testimonial-footer {
        margin-top: auto;
        width: 100%;
        border-top: 1px solid #e8e8e8;
        padding-top: 1rem;
    }

    .testimonial-author {
        color: #000000;
        font-weight: 700;
        font-size: 1rem;
        margin: 0 0 0.5rem 0;
        text-transform: capitalize;
        letter-spacing: 0.3px;
    }

    .testimonial-rating {
        color: #FFD700;
        font-size: 0.9rem;
        letter-spacing: 2px;
    }

    .testimonial-rating i {
        margin: 0 2px;
    }

    .testimonial-nav-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background-color: #000000;
        color: #ffffff;
        border: none;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        z-index: 10;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }

    .testimonial-nav-btn:hover {
        background-color: #333333;
        transform: translateY(-50%) scale(1.15);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
    }

    .testimonial-nav-btn:active {
        transform: translateY(-50%) scale(0.95);
    }

    .testimonial-nav-prev {
        left: -35px;
    }

    .testimonial-nav-next {
        right: -35px;
    }

    .no-testimonials {
        text-align: center;
        padding: 3rem;
        color: #999999;
    }

    /* Responsive Design */
    @media (max-width: 1200px) {
        .testimonials-carousel {
            gap: 1.2rem;
        }

        .testimonial-card {
            flex: 0 0 calc(33.333% - 0.8rem);
        }

        .section-title {
            font-size: 2.5rem;
        }
    }

    @media (max-width: 768px) {
        .testimonials-section {
            padding: 3rem 0;
        }

        .testimonials-header {
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 2rem;
        }

        .testimonials-carousel {
            gap: 1rem;
        }

        .testimonial-card {
            flex: 0 0 calc(50% - 0.5rem);
        }

        .testimonial-card-inner {
            padding: 2rem 1.2rem;
            min-height: 320px;
        }

        .testimonial-avatar {
            width: 70px;
            height: 70px;
        }

        .testimonial-avatar-placeholder {
            width: 70px;
            height: 70px;
            font-size: 2rem;
        }

        .testimonial-text {
            font-size: 0.9rem;
            line-height: 1.6;
        }

        .testimonial-nav-btn {
            width: 45px;
            height: 45px;
            font-size: 1.1rem;
        }

        .testimonial-nav-prev {
            left: -25px;
        }

        .testimonial-nav-next {
            right: -25px;
        }
    }

    @media (max-width: 480px) {
        .testimonials-section {
            padding: 2.5rem 0;
        }

        .section-title {
            font-size: 1.8rem;
        }

        .testimonials-carousel {
            gap: 0.8rem;
        }

        .testimonial-card {
            flex: 0 0 calc(100% - 0.4rem);
        }

        .testimonial-card-inner {
            padding: 1.8rem 1rem;
            min-height: 300px;
        }

        .testimonial-avatar {
            width: 60px;
            height: 60px;
        }

        .testimonial-avatar-placeholder {
            width: 60px;
            height: 60px;
            font-size: 1.8rem;
        }

        .testimonial-text {
            font-size: 0.85rem;
            line-height: 1.5;
        }

        .testimonial-quote {
            font-size: 1.3rem;
        }

        .testimonial-quote-end {
            font-size: 1.3rem;
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
    }
</style>

<script>
    let currentTestimonialIndex = 0;
    const testimonialCarousel = document.getElementById('testimonialsCarousel');
    const testimonialCards = document.querySelectorAll('.testimonial-card');
    let testimonialAutoSlideTimer;

    function getCardsPerView() {
        if (window.innerWidth <= 480) return 1;
        if (window.innerWidth <= 768) return 2;
        if (window.innerWidth <= 1200) return 3;
        return 4;
    }

    function updateCarouselPosition() {
        const cardWidth = testimonialCards[0]?.offsetWidth || 0;
        const gap = 24; // 1.5rem = 24px
        
        if (cardWidth === 0) {
            setTimeout(updateCarouselPosition, 100);
            return;
        }
        
        const moveAmount = (cardWidth + gap) * currentTestimonialIndex;
        testimonialCarousel.style.transform = `translateX(-${moveAmount}px)`;
    }

    function nextTestimonialSlide() {
        const cardsPerView = getCardsPerView();
        const totalCards = testimonialCards.length;
        const maxIndex = Math.max(0, totalCards - cardsPerView);
        
        currentTestimonialIndex++;
        
        if (currentTestimonialIndex > maxIndex) {
            currentTestimonialIndex = 0;
        }
        
        updateCarouselPosition();
        restartAutoSlide();
    }

    function prevTestimonialSlide() {
        const cardsPerView = getCardsPerView();
        const totalCards = testimonialCards.length;
        const maxIndex = Math.max(0, totalCards - cardsPerView);
        
        currentTestimonialIndex--;
        
        if (currentTestimonialIndex < 0) {
            currentTestimonialIndex = maxIndex;
        }
        
        updateCarouselPosition();
        restartAutoSlide();
    }

    function restartAutoSlide() {
        clearTimeout(testimonialAutoSlideTimer);
        testimonialAutoSlideTimer = setTimeout(() => {
            nextTestimonialSlide();
        }, 5000); // Auto slide every 5 seconds
    }

    function initializeCarousel() {
        if (testimonialCards.length > 0) {
            setTimeout(updateCarouselPosition, 300);
            restartAutoSlide();
        }
    }

    window.addEventListener('resize', () => {
        updateCarouselPosition();
    });

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initializeCarousel);
    } else {
        initializeCarousel();
    }
</script>

<!-- Footer Section -->
<footer class="footer-section">
    <div class="footer-content">
        <div class="footer-container">
            <!-- Brand Section -->
            <div class="footer-col footer-brand">
                <div class="footer-logo">
                    <i class="fas fa-bottle-droplet"></i>
                    <h3>Almukhtar Perfume</h3>
                </div>
                <p class="footer-description">Premium fragrances for the discerning taste.</p>
            </div>

            <!-- Quick Links Section -->
            <div class="footer-col">
                <h4 class="footer-title">Quick Links</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('shop') }}">Shop</a></li>
                    <li><a href="{{ route('about') }}">About</a></li>
                </ul>
            </div>

            <!-- Customer Service Section -->
            <div class="footer-col">
                <h4 class="footer-title">Customer Service</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('privacy-policy') }}">Privacy Policy</a></li>
                    <li><a href="{{ route('terms-and-conditions') }}">Terms & Conditions</a></li>
                    <li><a href="{{ route('disclaimer') }}">Disclaimer</a></li>
                </ul>
            </div>

            <!-- Follow Us Section -->
            <div class="footer-col">
                <h4 class="footer-title">Follow Us</h4>
                <ul class="footer-social">
                    @php
                        $homePage = \App\Models\HomePage::first();
                    @endphp
                    @if($homePage && $homePage->facebook_link)
                    <li>
                        <a href="{{ $homePage->facebook_link }}" target="_blank" rel="noopener noreferrer" title="Facebook">
                            <i class="fab fa-facebook"></i>
                            <span>Facebook</span>
                        </a>
                    </li>
                    @endif
                    
                    @if($homePage && $homePage->youtube_link)
                    <li>
                        <a href="{{ $homePage->youtube_link }}" target="_blank" rel="noopener noreferrer" title="YouTube">
                            <i class="fab fa-youtube"></i>
                            <span>YouTube</span>
                        </a>
                    </li>
                    @endif
                    
                    @if($homePage && $homePage->tiktok_link)
                    <li>
                        <a href="{{ $homePage->tiktok_link }}" target="_blank" rel="noopener noreferrer" title="TikTok">
                            <i class="fab fa-tiktok"></i>
                            <span>TikTok</span>
                        </a>
                    </li>
                    @endif

                    @if(!($homePage && ($homePage->facebook_link || $homePage->youtube_link || $homePage->tiktok_link)))
                    <li>
                        <a href="https://www.facebook.com/yourbrand" target="_blank" rel="noopener noreferrer" title="Facebook">
                            <i class="fab fa-facebook"></i>
                            <span>Facebook</span>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.youtube.com/yourbrand" target="_blank" rel="noopener noreferrer" title="YouTube">
                            <i class="fab fa-youtube"></i>
                            <span>YouTube</span>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.tiktok.com/yourbrand" target="_blank" rel="noopener noreferrer" title="TikTok">
                            <i class="fab fa-tiktok"></i>
                            <span>TikTok</span>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="footer-bottom-container">
            <p>&copy; 2024 Almukhtar Perfume. All rights reserved.</p>
        </div>
    </div>
</footer>

<style>
    /* Footer Styles */
    .footer-section {
        background-color: #1a1a1a;
        color: #ffffff;
        padding-top: 3.5rem;
        padding-bottom: 0;
        margin-top: 5rem;
    }

    .footer-content {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    .footer-container {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 2.5rem;
        margin-bottom: 3rem;
    }

    /* Brand Column */
    .footer-brand {
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
    }

    .footer-logo {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1rem;
    }

    .footer-logo i {
        font-size: 1.8rem;
        color: #c8a96a;
    }

    .footer-logo h3 {
        font-size: 1.3rem;
        font-weight: 700;
        margin: 0;
        font-family: 'Playfair Display', serif;
    }

    .footer-description {
        font-size: 0.95rem;
        line-height: 1.6;
        color: #b0b0b0;
        margin: 0;
    }

    /* Footer Columns */
    .footer-col {
        display: flex;
        flex-direction: column;
    }

    .footer-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #ffffff;
        font-family: 'Playfair Display', serif;
        position: relative;
        padding-bottom: 0.75rem;
    }

    .footer-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 40px;
        height: 2px;
    }

    /* Footer Links */
    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-links li {
        margin-bottom: 0.75rem;
    }

    .footer-links a {
        color: #b0b0b0;
        text-decoration: none;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        display: inline-block;
    }

    .footer-links a:hover {
        color: #c8a96a;
        padding-left: 0.5rem;
    }

    /* Social Links */
    .footer-social {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-social li {
        margin-bottom: 0.75rem;
    }

    .footer-social a {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        color: #b0b0b0;
        text-decoration: none;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        padding-left: 0;
        border-radius: 4px;
    }

    .footer-social a:hover {
        color: #c8a96a;
        background-color: rgba(200, 169, 106, 0.1);
        padding-left: 0.5rem;
    }

    .footer-social i {
        font-size: 1.2rem;
        width: 25px;
        text-align: center;
    }

    /* Footer Bottom */
    .footer-bottom {
        color: #808080;
        padding: 1.5rem 0;
        border-top: 1px solid #333333;
    }

    .footer-bottom-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 2rem;
        text-align: center;
        color: #808080;
        font-size: 0.9rem;
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .footer-container {
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem;
        }
    }

    @media (max-width: 768px) {
        .footer-section {
            padding-top: 2.5rem;
            margin-top: 3rem;
        }

        .footer-content {
            padding: 0 1.5rem;
        }

        .footer-container {
            grid-template-columns: 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-logo h3 {
            font-size: 1.2rem;
        }

        .footer-description {
            font-size: 0.9rem;
        }

        .footer-title {
            font-size: 1rem;
            margin-bottom: 1rem;
        }

        .footer-links a,
        .footer-social a {
            font-size: 0.9rem;
        }

        .footer-social a {
            gap: 0.5rem;
        }

        .footer-social i {
            font-size: 1rem;
        }
    }

    @media (max-width: 480px) {
        .footer-section {
            padding-top: 2rem;
            margin-top: 2rem;
        }

        .footer-content {
            padding: 0 1rem;
        }

        .footer-container {
            gap: 1.5rem;
        }

        .footer-logo {
            gap: 0.5rem;
        }

        .footer-logo i {
            font-size: 1.5rem;
        }

        .footer-logo h3 {
            font-size: 1rem;
        }

        .footer-title {
            font-size: 0.95rem;
        }

        .footer-links a,
        .footer-social a {
            font-size: 0.85rem;
        }

        .footer-bottom-container {
            padding: 0 1rem;
            font-size: 0.8rem;
        }
    }

    /* Dark Theme Consistency */
    .footer-section a {
        color: #b0b0b0;
    }

    .footer-section a:hover {
        color: #c8a96a;
    }

    /* Smooth transitions */
    .footer-section {
        transition: background-color 0.3s ease;
    }
</style>

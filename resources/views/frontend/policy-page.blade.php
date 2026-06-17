@extends('frontend.layouts.app')

@section('title', $title . ' - Almukhtar Perfume')

@section('content')
<section class="policy-hero">
    <div class="container">
        <div class="policy-hero-content">
            <p class="policy-eyebrow">Legal Information</p>
            <h1>{{ $title }}</h1>
            <p class="policy-subtitle">Last updated: {{ date('F d, Y') }}</p>
        </div>
    </div>
</section>

<section class="policy-section">
    <div class="container">
        <div class="policy-card">
            @if($pageType === 'privacy')
                <h2>Privacy Policy</h2>
                <p>At Almukhtar Perfume, we value your trust and are committed to protecting your personal information. This Privacy Policy explains how we collect, use, store, and safeguard your data when you visit our website or place an order.</p>

                <h3>1. Information We Collect</h3>
                <p>We may collect personal information such as your name, email address, phone number, shipping address, billing details, and payment information necessary to process your order.</p>

                <h3>2. How We Use Your Information</h3>
                <p>Your information is used to process orders, communicate updates, improve customer service, prevent fraud, and personalize your shopping experience.</p>

                <h3>3. Sharing of Information</h3>
                <p>We do not sell or rent your personal data. We may share information with trusted service providers only when required to operate our website, deliver orders, or comply with legal obligations.</p>

                <h3>4. Data Security</h3>
                <p>We use reasonable technical and organizational measures to protect your information against unauthorized access, loss, or misuse.</p>

                <h3>5. Your Rights</h3>
                <p>You may request access, correction, or deletion of your personal information by contacting us using the details provided on our website.</p>

            @elseif($pageType === 'terms')
                <h2>Terms & Conditions</h2>
                <p>Welcome to Almukhtar Perfume. By accessing and using our website, you agree to comply with these Terms & Conditions. Please read them carefully before placing any order.</p>

                <h3>1. Use of Website</h3>
                <p>You agree to use the website only for lawful purposes and not to engage in activities that may interfere with the proper functioning of the site.</p>

                <h3>2. Product Information</h3>
                <p>We make every effort to ensure that product descriptions, prices, and availability are accurate. However, errors may occur, and we reserve the right to correct them without prior notice.</p>

                <h3>3. Orders & Payments</h3>
                <p>All orders are subject to confirmation and availability. Payment must be completed before the order is processed. We reserve the right to refuse or cancel orders at our discretion.</p>

                <h3>4. Shipping & Delivery</h3>
                <p>Delivery timelines are estimates and may vary depending on location, weather, courier conditions, or other unforeseen factors.</p>

                <h3>5. Returns & Cancellations</h3>
                <p>Return or cancellation requests are subject to our applicable policies and may be reviewed on a case-by-case basis.</p>

                <h3>6. Limitation of Liability</h3>
                <p>Almukhtar Perfume shall not be liable for any indirect, incidental, or consequential damages arising from the use of our website or products.</p>

            @else
                <h2>Disclaimer</h2>
                <p>The information provided on this website is for general informational purposes only. While we strive to ensure accuracy, Almukhtar Perfume does not guarantee that all content is complete, current, or error-free.</p>

                <h3>1. Product Accuracy</h3>
                <p>Descriptions, images, and pricing are provided to the best of our knowledge. Slight variations in color, fragrance notes, packaging, or appearance may occur.</p>

                <h3>2. External Links</h3>
                <p>Our website may contain links to third-party websites. We are not responsible for the content, policies, or practices of those external sites.</p>

                <h3>3. Health & Safety</h3>
                <p>Fragrance products should be used responsibly and according to the instructions provided. Please avoid direct skin contact if you are sensitive to certain ingredients.</p>

                <h3>4. Changes to Content</h3>
                <p>We reserve the right to update or modify this disclaimer at any time without prior notice.</p>
            @endif
        </div>
    </div>
</section>

<style>
    .policy-hero {
        background: linear-gradient(135deg, #f7f1e3, #fffaf0);
        padding: 6rem 0 4rem;
    }

    .policy-hero-content {
        max-width: 760px;
        margin: 0 auto;
        text-align: center;
    }

    .policy-eyebrow {
        text-transform: uppercase;
        letter-spacing: 3px;
        color: #c8a96a;
        font-size: 0.78rem;
        font-weight: 700;
        margin-bottom: 0.8rem;
    }

    .policy-hero h1 {
        font-size: 3rem;
        color: #111111;
        margin-bottom: 0.6rem;
    }

    .policy-subtitle {
        color: #6b6b6b;
        font-size: 0.95rem;
    }

    .policy-section {
        padding: 3rem 0 5rem;
        background: #fff;
    }

    .policy-card {
        background: #fff;
        border-radius: 18px;
        padding: 2.5rem;
        box-shadow: 0 18px 50px rgba(17, 17, 17, 0.08);
        border: 1px solid #f0f0f0;
    }

    .policy-card h2 {
        color: #111111;
        font-size: 2rem;
        margin-bottom: 1rem;
    }

    .policy-card h3 {
        color: #111111;
        font-size: 1rem;
        margin-top: 1.8rem;
        margin-bottom: 0.5rem;
        font-weight: 700;
    }

    .policy-card p {
        color: #555555;
        line-height: 1.9;
        margin-bottom: 0.8rem;
    }

    @media (max-width: 768px) {
        .policy-hero {
            padding: 5rem 0 3rem;
        }

        .policy-hero h1 {
            font-size: 2.2rem;
        }

        .policy-card {
            padding: 1.5rem;
        }
    }
</style>
@endsection
@extends('frontend.layouts.app')

@section('title', 'Payment Failed - Almukhtar Perfume')

@section('content')
<section class="checkout-failure-section">
    <div class="container">
        <div class="failure-container">
            <div class="failure-icon">
                <i class="fas fa-times-circle"></i>
            </div>
            
            <h1 class="failure-title">Payment Failed</h1>
            
            <div class="failure-message">
                <p>{{ session('error') ?? 'Your payment could not be processed.' }}</p>
                <p class="order-id">
                    Order ID: <strong>{{ request('order_id') ?? 'N/A' }}</strong>
                </p>
            </div>

            <div class="failure-details">
                <h3>What You Can Do:</h3>
                <ul>
                    <li><i class="fas fa-redo"></i> Try the payment again with the same or different method</li>
                    <li><i class="fas fa-exchange-alt"></i> Use a different payment method (JazzCash, EasyPaisa, Bank Transfer)</li>
                    <li><i class="fas fa-money-bill-wave"></i> Choose Cash on Delivery to pay when your order arrives</li>
                    <li><i class="fas fa-phone"></i> Contact our support team for assistance</li>
                </ul>
            </div>

            <div class="failure-actions">
                <a href="{{ route('shop') }}" class="btn btn-primary-custom">
                    <i class="fas fa-arrow-left"></i> Back to Checkout
                </a>
                <a href="{{ route('contact') }}" class="btn btn-secondary-custom">
                    <i class="fas fa-headset"></i> Contact Support
                </a>
            </div>

            <div class="failure-footer">
                <p class="text-muted">
                    Your cart has been saved. Your items are still available.
                </p>
                <p class="text-muted">
                    <strong>Need help?</strong> <a href="mailto:{{ config('app.support_email', 'support@almukhtar.com') }}">Email us</a> or call us for assistance.
                </p>
            </div>
        </div>
    </div>
</section>

<style>
    .checkout-failure-section {
        padding: 4rem 0;
        background: linear-gradient(135deg, #fff5f5 0%, #f9f9f9 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
    }

    .failure-container {
        background: white;
        padding: 3rem 2rem;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(255, 68, 68, 0.15);
        text-align: center;
        max-width: 500px;
        margin: 0 auto;
        border-left: 5px solid #ff4444;
    }

    .failure-icon {
        font-size: 5rem;
        color: #ff4444;
        margin-bottom: 1.5rem;
        animation: shake 0.5s ease-out;
    }

    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-10px); }
        75% { transform: translateX(10px); }
    }

    .failure-title {
        font-size: 2rem;
        color: #000000;
        margin-bottom: 1rem;
        font-weight: 700;
    }

    .failure-message {
        margin-bottom: 2rem;
        font-size: 1.1rem;
        color: #666666;
    }

    .order-id {
        font-size: 1rem;
        color: #ff4444;
        font-weight: 600;
        margin-top: 0.8rem;
    }

    .failure-details {
        background: #fff5f5;
        padding: 2rem;
        border-radius: 8px;
        margin-bottom: 2rem;
        text-align: left;
    }

    .failure-details h3 {
        font-size: 1.1rem;
        color: #000000;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .failure-details ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .failure-details li {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        padding: 0.6rem 0;
        color: #666666;
        font-size: 0.95rem;
    }

    .failure-details li i {
        color: #ff4444;
        font-size: 1.1rem;
    }

    .failure-actions {
        display: flex;
        gap: 1rem;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        justify-content: center;
    }

    .btn-primary-custom,
    .btn-secondary-custom {
        padding: 0.9rem 1.8rem;
        border-radius: 6px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        font-size: 0.95rem;
    }

    .btn-primary-custom {
        background: linear-gradient(135deg, #ff6b6b 0%, #ff5252 100%);
        color: white;
        border: none;
    }

    .btn-primary-custom:hover {
        background: linear-gradient(135deg, #ff5252 0%, #ff3333 100%);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 107, 107, 0.3);
    }

    .btn-secondary-custom {
        background: white;
        color: #ff4444;
        border: 2px solid #ff4444;
    }

    .btn-secondary-custom:hover {
        background: #fff5f5;
        border-color: #ff3333;
        color: #ff3333;
        transform: translateY(-2px);
    }

    .failure-footer {
        border-top: 1px solid #e0e0e0;
        padding-top: 1.5rem;
    }

    .failure-footer a {
        color: #ff4444;
        text-decoration: none;
        font-weight: 600;
    }

    .failure-footer a:hover {
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .checkout-failure-section {
            padding: 2rem 0;
        }

        .failure-container {
            padding: 1.5rem 1rem;
            border-left: 3px solid #ff4444;
        }

        .failure-icon {
            font-size: 3rem;
        }

        .failure-title {
            font-size: 1.5rem;
        }

        .failure-actions {
            flex-direction: column;
        }

        .btn-primary-custom,
        .btn-secondary-custom {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endsection

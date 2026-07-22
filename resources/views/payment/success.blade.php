@extends('frontend.layouts.app')

@section('title', 'Payment Successful - Almukhtar Perfume')

@section('content')
<section class="payment-success-section">
    <div class="container">
        <div class="success-container">
            <div class="success-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            
            <h1 class="success-title">Payment Successful!</h1>
            
            <div class="success-message">
                <p>Your payment has been processed successfully.</p>
                <p class="order-id">
                    Order ID: <strong>{{ request('order_id') ?? 'N/A' }}</strong>
                </p>
            </div>

            <div class="success-details">
                <h3>What's Next?</h3>
                <ul>
                    <li><i class="fas fa-envelope"></i> You will receive a confirmation email shortly</li>
                    <li><i class="fas fa-truck"></i> Your order will be processed and shipped soon</li>
                    <li><i class="fas fa-tracking"></i> You can track your order using the order ID</li>
                    <li><i class="fas fa-headset"></i> Contact our support team if you need assistance</li>
                </ul>
            </div>

            <div class="success-actions">
                <a href="{{ route('shop') }}" class="btn btn-primary-custom">
                    <i class="fas fa-shopping-bag"></i> Continue Shopping
                </a>
                <a href="/" class="btn btn-secondary-custom">
                    <i class="fas fa-home"></i> Back to Home
                </a>
            </div>

            <div class="success-footer">
                <p class="text-muted">
                    Thank you for your purchase!
                </p>
                <p class="text-muted">
                    <strong>Need help?</strong> <a href="mailto:{{ config('app.support_email', 'support@almukhtar.com') }}">Email us</a> or call us for assistance.
                </p>
            </div>
        </div>
    </div>
</section>

<style>
    .payment-success-section {
        padding: 4rem 0;
        background: linear-gradient(135deg, #f5fff5 0%, #f9f9f9 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
    }

    .success-container {
        background: white;
        padding: 3rem 2rem;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(76, 175, 80, 0.15);
        text-align: center;
        max-width: 500px;
        margin: 0 auto;
        border-left: 5px solid #4caf50;
    }

    .success-icon {
        font-size: 5rem;
        color: #4caf50;
        margin-bottom: 1.5rem;
        animation: scaleIn 0.5s ease-out;
    }

    @keyframes scaleIn {
        0% { transform: scale(0); opacity: 0; }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); opacity: 1; }
    }

    .success-title {
        font-size: 2rem;
        color: #000000;
        margin-bottom: 1rem;
        font-weight: 700;
    }

    .success-message {
        margin-bottom: 2rem;
        font-size: 1.1rem;
        color: #666666;
    }

    .order-id {
        font-size: 1rem;
        color: #4caf50;
        font-weight: 600;
        margin-top: 0.8rem;
    }

    .success-details {
        background: #f5fff5;
        padding: 2rem;
        border-radius: 8px;
        margin-bottom: 2rem;
        text-align: left;
    }

    .success-details h3 {
        font-size: 1.1rem;
        color: #000000;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .success-details ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .success-details li {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        padding: 0.6rem 0;
        color: #666666;
        font-size: 0.95rem;
    }

    .success-details li i {
        color: #4caf50;
        font-size: 1.1rem;
    }

    .success-actions {
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
        background: linear-gradient(135deg, #4caf50 0%, #45a049 100%);
        color: white;
        border: none;
    }

    .btn-primary-custom:hover {
        background: linear-gradient(135deg, #45a049 0%, #3d8b40 100%);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(76, 175, 80, 0.3);
    }

    .btn-secondary-custom {
        background: white;
        color: #4caf50;
        border: 2px solid #4caf50;
    }

    .btn-secondary-custom:hover {
        background: #f5fff5;
        border-color: #45a049;
        color: #45a049;
        transform: translateY(-2px);
    }

    .success-footer {
        border-top: 1px solid #e0e0e0;
        padding-top: 1.5rem;
    }

    .success-footer a {
        color: #4caf50;
        text-decoration: none;
        font-weight: 600;
    }

    .success-footer a:hover {
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .payment-success-section {
            padding: 2rem 0;
        }

        .success-container {
            padding: 1.5rem 1rem;
            border-left: 3px solid #4caf50;
        }

        .success-icon {
            font-size: 3rem;
        }

        .success-title {
            font-size: 1.5rem;
        }

        .success-actions {
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

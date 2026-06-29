@extends('frontend.layouts.app')

@section('title', 'Order Confirmed - Almukhtar Perfume')

@section('content')
<section class="checkout-success-section">
    <div class="container">
        <div class="success-container">
            <div class="success-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            
            <h1 class="success-title">Order Confirmed!</h1>
            
            <div class="success-message">
                <p>Thank you for your purchase!</p>
                <p class="order-id">
                    Order ID: <strong>{{ request('order_id') ?? '#12345' }}</strong>
                </p>
            </div>

            <div class="success-details">
                <h3>What Happens Next?</h3>
                <ul>
                    <li><i class="fas fa-check"></i> Order confirmation email sent to your address</li>
                    <li><i class="fas fa-box"></i> Your order will be packed and shipped soon</li>
                    <li><i class="fas fa-truck"></i> You'll receive tracking information via SMS and email</li>
                    <li><i class="fas fa-bell"></i> Expected delivery: 2-5 business days</li>
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
                    Need help? <a href="{{ route('contact') }}">Contact us</a> or check your email for order details.
                </p>
            </div>
        </div>
    </div>
</section>

<style>
    .checkout-success-section {
        padding: 4rem 0;
        background: linear-gradient(135deg, #f0f7ff 0%, #f9f9f9 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
    }

    .success-container {
        background: white;
        padding: 3rem 2rem;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0, 102, 204, 0.15);
        text-align: center;
        max-width: 500px;
        margin: 0 auto;
    }

    .success-icon {
        font-size: 5rem;
        color: #00cc00;
        margin-bottom: 1.5rem;
        animation: scaleIn 0.5s ease-out;
    }

    @keyframes scaleIn {
        from {
            opacity: 0;
            transform: scale(0);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
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
        color: #0066cc;
        font-weight: 600;
        margin-top: 0.8rem;
    }

    .success-details {
        background: #f9f9f9;
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
        color: #00cc00;
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
        background: linear-gradient(135deg, #0066cc 0%, #0052a3 100%);
        color: white;
        border: none;
    }

    .btn-primary-custom:hover {
        background: linear-gradient(135deg, #0052a3 0%, #003d7a 100%);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 102, 204, 0.3);
    }

    .btn-secondary-custom {
        background: white;
        color: #0066cc;
        border: 2px solid #0066cc;
    }

    .btn-secondary-custom:hover {
        background: #f0f7ff;
        border-color: #0052a3;
        color: #0052a3;
        transform: translateY(-2px);
    }

    .success-footer {
        border-top: 1px solid #e0e0e0;
        padding-top: 1.5rem;
    }

    .success-footer a {
        color: #0066cc;
        text-decoration: none;
        font-weight: 600;
    }

    .success-footer a:hover {
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .checkout-success-section {
            padding: 2rem 0;
        }

        .success-container {
            padding: 1.5rem 1rem;
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

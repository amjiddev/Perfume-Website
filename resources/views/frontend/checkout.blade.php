@extends('frontend.layouts.app')

@section('title', 'Checkout - Almukhtar Perfume')

@section('content')
    <section class="checkout-section">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12">
                    <a href="javascript:history.back()" class="back-link">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>

            <div class="row">
                <!-- Contact Information & Shipping Address -->
                <div class="col-lg-7">
                    <div class="checkout-form-section">
                        <h3 class="section-heading">Contact Information</h3>
                        <form id="checkoutForm">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstName" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lastName" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone Number" required>
                            </div>

                            <!-- Shipping Address -->
                            <h3 class="section-heading mt-5">Shipping Address</h3>

                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="Street address" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control" id="city" name="city" placeholder="City" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="state" class="form-label">State</label>
                                    <input type="text" class="form-control" id="state" name="state" placeholder="State" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="zip" class="form-label">ZIP</label>
                                    <input type="text" class="form-control" id="zip" name="zip" placeholder="ZIP Code" required>
                                </div>
                            </div>

                            <!-- Order Notes -->
                            <h3 class="section-heading mt-5">Order Notes (Optional)</h3>
                            <div class="mb-3">
                                <label for="notes" class="form-label">Special Instructions</label>
                                <textarea class="form-control" id="notes" name="notes" rows="4" placeholder="Any special instructions or notes for your order..."></textarea>
                            </div>

                            <button type="submit" class="btn btn-place-order">Place Order</button>
                        </form>
                    </div>
                </div>

                <!-- Order Summary (Right Side) -->
                <div class="col-lg-5">
                    <div class="order-summary-section">
                        <h3 class="section-heading">Order Summary</h3>
                        <div class="order-items" id="orderItemsContainer">
                            <!-- Items will be loaded via JavaScript from localStorage -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .checkout-section {
            padding: 3rem 0;
            background-color: #f9f9f9;
            min-height: 80vh;
        }

        .back-link {
            color: #666666;
            text-decoration: none;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 2rem;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            color: #000000;
        }

        .checkout-form-section {
            background: #ffffff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .section-heading {
            font-size: 1.3rem;
            font-weight: 700;
            color: #000000;
            margin-bottom: 1.5rem;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 1rem;
        }

        .form-label {
            color: #333333;
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        .form-control {
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            padding: 0.75rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #000000;
            box-shadow: 0 0 0 0.2rem rgba(0, 0, 0, 0.1);
            outline: none;
        }

        .btn-place-order {
            width: 100%;
            background: linear-gradient(135deg, #0066cc 0%, #0052a3 100%);
            color: #ffffff;
            border: none;
            padding: 1rem;
            border-radius: 6px;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-place-order:hover {
            background: linear-gradient(135deg, #0052a3 0%, #003d7a 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(0, 102, 204, 0.3);
        }

        .order-summary-section {
            background: #ffffff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 20px;
        }

        .order-items {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .order-item {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 1rem;
            padding: 1rem;
            background-color: #f9f9f9;
            border-radius: 6px;
        }

        .item-details {
            display: flex;
            gap: 1rem;
            flex: 1;
        }

        .item-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid #e0e0e0;
        }

        .item-info h5 {
            font-size: 1rem;
            font-weight: 700;
            color: #000000;
            margin-bottom: 0.5rem;
        }

        .item-price {
            color: #0066cc;
            font-weight: 700;
            font-size: 1rem;
            margin: 0.3rem 0;
        }

        .item-qty {
            color: #666666;
            font-size: 0.9rem;
            margin: 0;
        }

        .item-total {
            text-align: right;
            white-space: nowrap;
        }

        .item-total strong {
            font-size: 1.1rem;
            color: #000000;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 0.8rem 0;
            color: #666666;
            font-size: 0.95rem;
        }

        .summary-row.total {
            border-top: 2px solid #e0e0e0;
            padding-top: 1rem;
            margin-top: 1rem;
            color: #000000;
            font-weight: 700;
            font-size: 1.1rem;
        }

        .total-amount {
            color: #0066cc;
            font-weight: 700;
        }

        .empty-cart {
            text-align: center;
            padding: 2rem;
        }

        .empty-cart p {
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .checkout-form-section,
            .order-summary-section {
                padding: 1.5rem;
                margin-bottom: 2rem;
            }

            .order-summary-section {
                position: static;
            }

            .btn-place-order {
                padding: 0.8rem;
                font-size: 0.9rem;
            }

            .item-image {
                width: 70px;
                height: 70px;
            }

            .item-info h5 {
                font-size: 0.9rem;
            }
        }
    </style>

    <script>
        // Load cart items from localStorage
        function loadCartItems() {
            const orderItemsContainer = document.getElementById('orderItemsContainer');
            
            if (!orderItemsContainer) return;

            // Get cart data from localStorage
            let cartData = [];
            const localStorageData = localStorage.getItem('perfume_cart');
            
            if (localStorageData) {
                try {
                    cartData = JSON.parse(localStorageData);
                } catch (e) {
                    console.error('Error parsing localStorage:', e);
                    cartData = [];
                }
            }

            // Show empty message if no items
            if (!cartData || cartData.length === 0) {
                orderItemsContainer.innerHTML = `
                    <div class="empty-cart">
                        <p class="text-muted">Your cart is empty</p>
                        <a href="{{ route('shop') }}" class="btn btn-primary">Continue Shopping</a>
                    </div>
                `;
                return;
            }

            // Build items HTML
            let totalSubtotal = 0;
            let itemsHTML = '';

            cartData.forEach((item) => {
                const itemPrice = parseFloat(item.price) || 0;
                const itemQty = parseInt(item.quantity) || 1;
                const itemTotal = itemPrice * itemQty;
                totalSubtotal += itemTotal;
                
                itemsHTML += `
                    <div class="order-item">
                        <div class="item-details">
                            <img src="${item.image}" alt="${item.name}" class="item-image" onerror="this.src='{{ asset('frontend/images/perfume1.jpg') }}'">
                            <div class="item-info">
                                <h5>${item.name}</h5>
                                <p class="item-price">Rs ${itemPrice.toLocaleString()}</p>
                                <p class="item-qty">Qty: <strong>${itemQty}</strong></p>
                            </div>
                        </div>
                        <div class="item-total">
                            <strong>Rs ${itemTotal.toLocaleString()}</strong>
                        </div>
                    </div>
                `;
            });

            // Calculate shipping and total
            const shipping = totalSubtotal >= 2000 ? 0 : 300;
            const total = totalSubtotal + shipping;

            // Render the summary
            orderItemsContainer.innerHTML = `
                <div class="order-items">
                    ${itemsHTML}
                    <hr class="my-3">
                    <div class="summary-row">
                        <span>Subtotal:</span>
                        <span>Rs <span id="subtotalAmount">${totalSubtotal.toLocaleString()}</span></span>
                    </div>
                    <div class="summary-row">
                        <span>Shipping:</span>
                        <span id="shippingAmount">Rs ${shipping.toLocaleString()}</span>
                    </div>
                    <div class="summary-row total">
                        <span>Total:</span>
                        <span class="total-amount">Rs <span id="totalAmount">${total.toLocaleString()}</span></span>
                    </div>
                </div>
            `;
        }

        // Load cart items on page ready
        document.addEventListener('DOMContentLoaded', function() {
            loadCartItems();

            // Setup form submission
            const checkoutForm = document.getElementById('checkoutForm');
            if (checkoutForm) {
                checkoutForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    let cartData = JSON.parse(localStorage.getItem('perfume_cart') || '[]');

                    if (cartData.length === 0) {
                        alert('Your cart is empty!');
                        return;
                    }

                    // Get total from the summary
                    const totalElement = document.querySelector('.total-amount span');
                    let total = 0;
                    
                    if (totalElement) {
                        // Extract numeric value from the text
                        const totalText = totalElement.textContent;
                        total = parseFloat(totalText.replace(/[^0-9.]/g, ''));
                    }

                    if (total <= 0) {
                        alert('Error: Invalid total amount');
                        return;
                    }

                    const orderData = {
                        customer_name: document.getElementById('firstName').value + ' ' + document.getElementById('lastName').value,
                        email: document.getElementById('email').value,
                        phone: document.getElementById('phone').value,
                        address: document.getElementById('address').value,
                        city: document.getElementById('city').value,
                        state: document.getElementById('state').value,
                        zip: document.getElementById('zip').value,
                        notes: document.getElementById('notes').value,
                        products: cartData,
                        total: total,
                        status: 'pending'
                    };

                    console.log('Submitting order:', orderData);

                    // Submit order to backend
                    fetch('/api/orders', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                        },
                        body: JSON.stringify(orderData)
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Order response:', data);
                        if (data.success) {
                            alert('Order placed successfully! We will contact you soon to confirm your order.');
                            
                            // Clear cart
                            localStorage.removeItem('perfume_cart');
                            if (typeof cartManager !== 'undefined') {
                                cartManager.items = [];
                                cartManager.saveCart();
                                cartManager.updateBadge();
                            }
                            
                            // Redirect
                            setTimeout(() => {
                                window.location.href = '{{ route("home") }}';
                            }, 1000);
                        } else {
                            alert('Error placing order: ' + (data.message || 'Unknown error'));
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error placing order. Please try again.');
                    });
                });
            }
        });

        // Reload cart when page becomes visible (tab switching)
        document.addEventListener('visibilitychange', function() {
            if (!document.hidden) {
                loadCartItems();
            }
        });
    </script>
@endsection

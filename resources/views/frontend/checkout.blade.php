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
                            <div id="formValidationError" class="alert alert-danger mt-3" style="display: none;"></div>
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

    <!-- Payment Method Modal -->
    <div class="modal fade" id="paymentMethodModal" tabindex="-1" aria-labelledby="paymentMethodLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="paymentMethodLabel">
                        <i class="fas fa-lock"></i> Select Payment Method
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <p class="text-muted mb-4">Choose your preferred payment method to complete your order:</p>
                    
                    <div class="payment-methods">
                        <!-- Credit Card Payment -->
                        <div class="payment-option">
                            <input type="radio" id="payment_card" name="paymentMethod" value="card" checked>
                            <label for="payment_card" class="payment-label">
                                <div class="payment-icon">
                                    <i class="fas fa-credit-card"></i>
                                </div>
                                <div class="payment-details">
                                    <h6>Credit/Debit Card</h6>
                                    <p class="text-muted small">Visa, MasterCard, or other supported cards</p>
                                </div>
                                <div class="payment-check">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                            </label>
                        </div>

                        <!-- Mobile Wallet -->
                        <div class="payment-option">
                            <input type="radio" id="payment_wallet" name="paymentMethod" value="wallet">
                            <label for="payment_wallet" class="payment-label">
                                <div class="payment-icon">
                                    <i class="fas fa-wallet"></i>
                                </div>
                                <div class="payment-details">
                                    <h6>Mobile Wallet</h6>
                                    <p class="text-muted small">JazzCash, EasyPaisa, or other e-wallets</p>
                                </div>
                                <div class="payment-check">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                            </label>
                        </div>

                        <!-- Bank Transfer -->
                        <div class="payment-option">
                            <input type="radio" id="payment_bank" name="paymentMethod" value="bank">
                            <label for="payment_bank" class="payment-label">
                                <div class="payment-icon">
                                    <i class="fas fa-university"></i>
                                </div>
                                <div class="payment-details">
                                    <h6>Bank Transfer</h6>
                                    <p class="text-muted small">Direct bank transfer or online banking</p>
                                </div>
                                <div class="payment-check">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                            </label>
                        </div>

                        <!-- Cash on Delivery -->
                        <div class="payment-option">
                            <input type="radio" id="payment_cod" name="paymentMethod" value="cod">
                            <label for="payment_cod" class="payment-label">
                                <div class="payment-icon">
                                    <i class="fas fa-money-bill-wave"></i>
                                </div>
                                <div class="payment-details">
                                    <h6>Cash on Delivery</h6>
                                    <p class="text-muted small">Pay when your order arrives</p>
                                </div>
                                <div class="payment-check">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Payment Forms Section -->
                    <div id="paymentFormsContainer" class="mt-4" style="display: none;">
                        <hr class="my-3">

                        <!-- Card Form -->
                        <div id="cardForm" class="payment-form" style="display: none;">
                            <h6 class="mb-3">Credit/Debit Card Details</h6>
                            <div class="mb-3">
                                <label for="cardNumber" class="form-label">Card Number</label>
                                <input type="text" class="form-control" id="cardNumber" placeholder="1234 5678 9012 3456" maxlength="19">
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="cardExpiry" class="form-label">Expiry Date</label>
                                    <input type="text" class="form-control" id="cardExpiry" placeholder="MM/YY" maxlength="5">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="cardCVV" class="form-label">CVV</label>
                                    <input type="text" class="form-control" id="cardCVV" placeholder="123" maxlength="3">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="cardholderName" class="form-label">Cardholder Name</label>
                                <input type="text" class="form-control" id="cardholderName" placeholder="John Doe">
                            </div>
                        </div>

                        <!-- Mobile Wallet Form -->
                        <div id="walletForm" class="payment-form" style="display: none;">
                            <h6 class="mb-3">Mobile Wallet Details</h6>
                            <div class="mb-3">
                                <label for="walletType" class="form-label">Select Wallet</label>
                                <select class="form-select" id="walletType">
                                    <option value="">-- Choose a wallet --</option>
                                    <option value="easypaisa">EasyPaisa</option>
                                    <option value="jazzcash">JazzCash</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="walletPhone" class="form-label">Mobile Number</label>
                                <input type="tel" class="form-control" id="walletPhone" placeholder="03001234567">
                            </div>
                        </div>

                        <!-- Bank Transfer Form -->
                        <div id="bankForm" class="payment-form" style="display: none;">
                            <h6 class="mb-3">Bank Transfer Details</h6>
                            <div class="mb-3">
                                <label for="bankName" class="form-label">Select Bank</label>
                                <select class="form-select" id="bankName">
                                    <option value="">-- Choose a bank --</option>
                                    <option value="hbl">HBL (Habib Bank Limited)</option>
                                    <option value="abb">ABL (Allied Bank Limited)</option>
                                    <option value="mcb">MCB (Muslim Commercial Bank)</option>
                                    <option value="ful">Faysal Bank</option>
                                    <option value="umb">UBL (United Bank Limited)</option>
                                    <option value="scb">SCB (Standard Chartered Bank)</option>
                                    <option value="nbp">NBP (National Bank of Pakistan)</option>
                                    <option value="bnp">BNP (Bank of Punjab)</option>
                                    <option value="sbl">SBL (Soneri Bank)</option>
                                    <option value="kbl">KBL (Khushhali Bank)</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="bankAccount" class="form-label">Account Number</label>
                                <input type="text" class="form-control" id="bankAccount" placeholder="Enter 16-24 digit account number">
                            </div>
                            <div class="mb-3" id="otpContainer" style="display: none;">
                                <label for="bankOTP" class="form-label">OTP</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="bankOTP" placeholder="Enter OTP sent to your registered email" maxlength="6">
                                    <button class="btn btn-outline-secondary" type="button" id="resendOtpBtn">Resend OTP</button>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-info" id="verifyAccountBtn" style="display: none;">Verify Account & Get OTP</button>
                        </div>

                        <!-- COD Confirmation -->
                        <div id="codForm" class="payment-form" style="display: none;">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i> You will pay <strong>Rs {{ session('order_total', '0') }}</strong> when your order arrives.
                            </div>
                        </div>
                    </div>

                    <div id="paymentProcessing" style="display: none;" class="mt-4">
                        <div class="alert alert-info">
                            <div class="spinner-border spinner-border-sm me-2" role="status">
                                <span class="visually-hidden">Processing...</span>
                            </div>
                            <span>Processing your payment...</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="confirmPaymentBtn" class="btn btn-primary">
                        <i class="fas fa-lock"></i> Process Payment
                    </button>
                </div>
            </div>
        </div>
    </div>

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

        /* Payment Modal Styles */
        .payment-methods {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .payment-option {
            display: flex;
            flex-direction: column;
        }

        .payment-option input[type="radio"] {
            display: none;
        }

        .payment-label {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            padding: 1.5rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 0;
        }

        .payment-option input[type="radio"]:checked + .payment-label {
            border-color: #0066cc;
            background-color: #f0f7ff;
        }

        .payment-label:hover {
            border-color: #0066cc;
            background-color: #f5f5f5;
        }

        .payment-icon {
            font-size: 2rem;
            color: #0066cc;
            width: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .payment-details {
            flex: 1;
        }

        .payment-details h6 {
            margin: 0;
            font-weight: 700;
            color: #000000;
            font-size: 1rem;
        }

        .payment-details p {
            margin: 0.3rem 0 0 0;
            font-size: 0.85rem;
        }

        .payment-check {
            font-size: 1.5rem;
            color: #0066cc;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .payment-option input[type="radio"]:checked + .payment-label .payment-check {
            opacity: 1;
        }

        .payment-form {
            background-color: #f8f9fa;
            padding: 1.5rem;
            border-radius: 8px;
            margin-top: 1rem;
        }

        .payment-form h6 {
            color: #000;
            font-weight: 700;
            margin-bottom: 1.5rem;
            border-bottom: 2px solid #0066cc;
            padding-bottom: 0.5rem;
        }

        .payment-form .form-label {
            color: #333;
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .payment-form .form-control,
        .payment-form .form-select {
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 0.75rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .payment-form .form-control:focus,
        .payment-form .form-select:focus {
            border-color: #0066cc;
            box-shadow: 0 0 0 0.2rem rgba(0, 102, 204, 0.1);
        }

        .payment-form .input-group .btn {
            border: 1px solid #ddd;
            color: #0066cc;
            background-color: transparent;
        }

        .payment-form .input-group .btn:hover {
            background-color: #0066cc;
            color: white;
            border-color: #0066cc;
        }

        #verifyAccountBtn {
            margin-top: 0.5rem;
            width: 100%;
        }

        @media (max-width: 768px) {
            .payment-label {
                flex-wrap: wrap;
                gap: 1rem;
            }

            .payment-icon {
                width: 100%;
                justify-content: flex-start;
            }

            .payment-details {
                width: 100%;
            }
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

            // Initialize Bootstrap modal
            const paymentModal = new bootstrap.Modal(document.getElementById('paymentMethodModal'));

            // Setup form submission
            const checkoutForm = document.getElementById('checkoutForm');
            if (checkoutForm) {
                checkoutForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    // Validate form
                    if (!validateCheckoutForm()) {
                        return;
                    }

                    let cartData = JSON.parse(localStorage.getItem('perfume_cart') || '[]');

                    if (cartData.length === 0) {
                        showFormValidationError('Your cart is empty!');
                        return;
                    }

                    // Get total from the summary
                    const totalElement = document.querySelector('.total-amount span');
                    let total = 0;
                    
                    if (totalElement) {
                        const totalText = totalElement.textContent;
                        total = parseFloat(totalText.replace(/[,]/g, ''));
                    }

                    if (total <= 0) {
                        showFormValidationError('Error: Invalid total amount');
                        return;
                    }

                    // Store order data temporarily for payment processing
                    window.pendingOrder = {
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

                    // Show payment method modal
                    paymentModal.show();
                });
            }

            // Handle payment method selection
            const paymentMethods = document.querySelectorAll('input[name="paymentMethod"]');
            paymentMethods.forEach(method => {
                method.addEventListener('change', function() {
                    showPaymentForm(this.value);
                });
            });

            // Handle payment confirmation
            const confirmPaymentBtn = document.getElementById('confirmPaymentBtn');
            if (confirmPaymentBtn) {
                confirmPaymentBtn.addEventListener('click', function() {
                    const selectedMethod = document.querySelector('input[name="paymentMethod"]:checked');
                    if (!selectedMethod) {
                        alert('Please select a payment method');
                        return;
                    }

                    // Validate payment form fields
                    if (!validatePaymentForm(selectedMethod.value)) {
                        return;
                    }

                    processPayment(selectedMethod.value);
                });
            }

            // Bank Account Verification
            const verifyAccountBtn = document.getElementById('verifyAccountBtn');
            if (verifyAccountBtn) {
                verifyAccountBtn.addEventListener('click', function() {
                    const bankName = document.getElementById('bankName').value;
                    const bankAccount = document.getElementById('bankAccount').value;

                    if (!bankName || !bankAccount) {
                        alert('Please select a bank and enter account number');
                        return;
                    }

                    // Simulate OTP sending
                    alert('OTP has been sent to your registered email address');
                    document.getElementById('otpContainer').style.display = 'block';
                    verifyAccountBtn.style.display = 'none';
                });
            }

            // Resend OTP
            const resendOtpBtn = document.getElementById('resendOtpBtn');
            if (resendOtpBtn) {
                resendOtpBtn.addEventListener('click', function() {
                    alert('OTP has been resent to your registered email address');
                });
            }
        });

        // Show appropriate payment form
        function showPaymentForm(method) {
            // Hide all forms
            document.getElementById('paymentFormsContainer').style.display = 'block';
            document.getElementById('cardForm').style.display = 'none';
            document.getElementById('walletForm').style.display = 'none';
            document.getElementById('bankForm').style.display = 'none';
            document.getElementById('codForm').style.display = 'none';

            // Show selected form
            switch(method) {
                case 'card':
                    document.getElementById('cardForm').style.display = 'block';
                    break;
                case 'wallet':
                    document.getElementById('walletForm').style.display = 'block';
                    break;
                case 'bank':
                    document.getElementById('bankForm').style.display = 'block';
                    document.getElementById('verifyAccountBtn').style.display = 'block';
                    document.getElementById('otpContainer').style.display = 'none';
                    break;
                case 'cod':
                    document.getElementById('codForm').style.display = 'block';
                    break;
            }
        }

        // Validate payment form
        function validatePaymentForm(method) {
            switch(method) {
                case 'card':
                    const cardNumber = document.getElementById('cardNumber').value.replace(/\s/g, '');
                    const cardExpiry = document.getElementById('cardExpiry').value;
                    const cardCVV = document.getElementById('cardCVV').value;
                    const cardholderName = document.getElementById('cardholderName').value;

                    if (!cardNumber || cardNumber.length < 13) {
                        alert('Please enter a valid card number');
                        return false;
                    }
                    if (!cardExpiry || !/^\d{2}\/\d{2}$/.test(cardExpiry)) {
                        alert('Please enter expiry date in MM/YY format');
                        return false;
                    }
                    if (!cardCVV || cardCVV.length < 3) {
                        alert('Please enter a valid CVV');
                        return false;
                    }
                    if (!cardholderName) {
                        alert('Please enter cardholder name');
                        return false;
                    }
                    return true;

                case 'wallet':
                    const walletType = document.getElementById('walletType').value;
                    const walletPhone = document.getElementById('walletPhone').value;

                    if (!walletType) {
                        alert('Please select a wallet');
                        return false;
                    }
                    if (!walletPhone || walletPhone.length < 10) {
                        alert('Please enter a valid mobile number');
                        return false;
                    }
                    return true;

                case 'bank':
                    const bankName = document.getElementById('bankName').value;
                    const bankOTP = document.getElementById('bankOTP').value;

                    if (!bankName) {
                        alert('Please select a bank');
                        return false;
                    }
                    if (!bankOTP || bankOTP.length < 4) {
                        alert('Please enter valid OTP');
                        return false;
                    }
                    return true;

                case 'cod':
                    return true;

                default:
                    return false;
            }
        }

        // Validate checkout form
        function validateCheckoutForm() {
            const fields = ['firstName', 'lastName', 'email', 'phone', 'address', 'city', 'state', 'zip'];
            let isValid = true;
            let errorMessage = '';

            for (let field of fields) {
                const element = document.getElementById(field);
                if (!element.value.trim()) {
                    isValid = false;
                    errorMessage = `Please fill in all required fields. Missing: ${field}`;
                    break;
                }
            }

            // Validate email format
            const email = document.getElementById('email').value;
            if (email && !isValidEmail(email)) {
                isValid = false;
                errorMessage = 'Please enter a valid email address';
            }

            // Validate phone format
            const phone = document.getElementById('phone').value;
            if (phone && phone.length < 10) {
                isValid = false;
                errorMessage = 'Please enter a valid phone number';
            }

            if (!isValid) {
                showFormValidationError(errorMessage);
            }

            return isValid;
        }

        // Validate email format
        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        // Show form validation error
        function showFormValidationError(message) {
            const errorElement = document.getElementById('formValidationError');
            if (errorElement) {
                errorElement.textContent = message;
                errorElement.style.display = 'block';
                errorElement.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                setTimeout(() => {
                    errorElement.style.display = 'none';
                }, 5000);
            }
        }

        // Process payment through SafePay
        function processPayment(paymentMethod) {
            const confirmPaymentBtn = document.getElementById('confirmPaymentBtn');
            const paymentProcessing = document.getElementById('paymentProcessing');
            
            // Show processing state
            confirmPaymentBtn.disabled = true;
            paymentProcessing.style.display = 'block';

            // Collect payment details based on method
            let paymentDetails = {};
            
            switch(paymentMethod) {
                case 'card':
                    paymentDetails = {
                        card_number: document.getElementById('cardNumber').value.replace(/\s/g, ''),
                        card_expiry: document.getElementById('cardExpiry').value,
                        card_cvv: document.getElementById('cardCVV').value,
                        cardholder_name: document.getElementById('cardholderName').value,
                    };
                    break;
                case 'wallet':
                    paymentDetails = {
                        wallet_type: document.getElementById('walletType').value,
                        wallet_phone: document.getElementById('walletPhone').value,
                    };
                    break;
                case 'bank':
                    paymentDetails = {
                        bank_name: document.getElementById('bankName').value,
                        bank_account: document.getElementById('bankAccount').value,
                        bank_otp: document.getElementById('bankOTP').value,
                    };
                    break;
                case 'cod':
                    paymentDetails = {};
                    break;
            }

            const orderData = {
                ...window.pendingOrder,
                payment_method: paymentMethod,
                payment_details: paymentDetails,
            };

            console.log('Processing payment with method:', paymentMethod);
            console.log('Order data:', orderData);

            // Call SafePay Payment API
            fetch('/api/payments/initiate', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                },
                body: JSON.stringify(orderData)
            })
            .then(response => response.json())
            .then(data => {
                console.log('Payment Response:', data);
                
                if (data.success) {
                    // Hide processing
                    paymentProcessing.style.display = 'none';
                    confirmPaymentBtn.disabled = false;

                    // Get modal instance and hide
                    const paymentModal = bootstrap.Modal.getInstance(document.getElementById('paymentMethodModal'));
                    paymentModal.hide();

                    if (paymentMethod === 'cod') {
                        // COD - Show success immediately
                        showPaymentSuccess(data.order_id);
                    } else if (data.redirect_url) {
                        // For online payments, redirect to SafePay checkout
                        window.location.href = data.redirect_url;
                    } else {
                        // Fallback - redirect to success page if no redirect URL
                        window.location.href = data.redirect_url || '/checkout/success?order_id=' + data.order_id;
                    }
                } else {
                    // Hide processing
                    paymentProcessing.style.display = 'none';
                    confirmPaymentBtn.disabled = false;

                    alert('Payment failed: ' + (data.error || data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Payment Error:', error);
                paymentProcessing.style.display = 'none';
                confirmPaymentBtn.disabled = false;
                alert('Payment processing error: ' + error.message);
            });
        }

        // Complete payment and submit order
        function completePaymentAndOrder(orderData) {
            const confirmPaymentBtn = document.getElementById('confirmPaymentBtn');
            const paymentProcessing = document.getElementById('paymentProcessing');
            const paymentModal = bootstrap.Modal.getInstance(document.getElementById('paymentMethodModal'));

            // Make API call to create order
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
                
                // Hide processing
                paymentProcessing.style.display = 'none';
                confirmPaymentBtn.disabled = false;

                if (data.success) {
                    // Close modal
                    paymentModal.hide();

                    // Show success message
                    alert('✓ Payment Successful!\n\nYour order has been placed successfully.\nYou will receive a confirmation email shortly.\n\nThank you for your purchase!');
                    
                    // Clear cart
                    localStorage.removeItem('perfume_cart');
                    if (typeof cartManager !== 'undefined') {
                        cartManager.items = [];
                        cartManager.saveCart();
                        cartManager.updateBadge();
                    }

                    // Redirect to success page
                    setTimeout(() => {
                        window.location.href = '/';
                    }, 2000);
                } else {
                    alert('Order creation failed: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Order Error:', error);
                paymentProcessing.style.display = 'none';
                confirmPaymentBtn.disabled = false;
                alert('Order processing error: ' + error.message);
            });
        }

        // Show payment success
        function showPaymentSuccess(orderId) {
            alert('✓ Order Confirmed!\n\nYour order #' + orderId + ' has been placed successfully.\n\nYou will receive a confirmation email shortly with your order details and delivery information.\n\nThank you for your purchase!');
            
            // Clear cart
            localStorage.removeItem('perfume_cart');
            if (typeof cartManager !== 'undefined') {
                cartManager.items = [];
                cartManager.saveCart();
                cartManager.updateBadge();
            }

            // Redirect to home
            setTimeout(() => {
                window.location.href = '/';
            }, 2000);
        }

        // Reload cart when page becomes visible (tab switching)
        document.addEventListener('visibilitychange', function() {
            if (!document.hidden) {
                loadCartItems();
            }
        });
    </script>
@endsection

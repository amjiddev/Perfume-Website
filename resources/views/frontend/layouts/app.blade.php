<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Perfume Store') - Luxury Fragrances</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #ffffff;
            color: #1a1a1a;
            scroll-behavior: smooth;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
        }

        /* Page Content */
        .page-content {
            min-height: auto;
            padding: 4rem 0;
        }

        .section-title {
            font-size: 2.8rem;
            color: #000000;
            margin-bottom: 1rem;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 800;
        }

        .section-subtitle {
            font-size: 1rem;
            color: #666666;
            text-align: center;
            margin-bottom: 3.5rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.8;
        }

        .collection-label {
            text-align: center;
            color: #000000;
            font-size: 0.85rem;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin-bottom: 0.8rem;
            font-weight: 600;
        }

        /* Promo Banner Styles */
        .promo-banner-wrapper {
            background-color: #8B0000;
            color: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.1rem 1rem;
            gap: 0.5rem;
            position: relative;
        }

        .promo-nav-btn {
            background: none;
            border: none;
            color: #ffffffff;
            cursor: pointer;
            font-size: 0.9rem;
            padding: 0.2rem;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .promo-nav-btn:hover {
            color: #c8a96a;
            transform: scale(1.2);
        }

        .promo-banner-container {
            flex: 1;
            text-align: center;
            min-height: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .promo-slide {
            display: none;
            animation: slideIn 0.5s ease-in-out;
            font-size: 0.75rem;
            font-weight: 500;
            letter-spacing: 0.3px;
            line-height: 1;
        }

        .promo-slide.active {
            display: block;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @media (max-width: 768px) {
            .promo-banner-wrapper {
                padding: 0.1rem 0.5rem;
                gap: 0.3rem;
            }

            .promo-slide {
                font-size: 0.7rem;
            }

            .promo-nav-btn {
                font-size: 0.8rem;
                padding: 0.1rem;
            }

            .section-title {
                font-size: 2rem;
            }
        }
    </style>
    @yield('extra-css')
</head>
<body>
    <!-- Sliding Promo Banner -->
    <div class="promo-banner-wrapper">
        <button class="promo-nav-btn promo-prev" onclick="prevPromo()">
            <i class="fas fa-chevron-left"></i>
        </button>
        <div class="promo-banner-container">
            <div class="promo-slide active">
                <span>Enjoy Free Home Delivery on Orders Above Rs. 4000</span>
            </div>
            <div class="promo-slide">
                <span>Buy 2 Get Free Shipping, Buy 3 get 5% OFF, Buy 4 get 12% OFF</span>
            </div>
            <div class="promo-slide">
                <span>15-day Money-Back Guarantee on all orders.</span>
            </div>
        </div>
        <button class="promo-nav-btn promo-next" onclick="nextPromo()">
            <i class="fas fa-chevron-right"></i>
        </button>
    </div>

    @include('frontend.layouts.partials.navbar')

    <!-- Cart Drawer -->
    <div class="cart-drawer" id="cartDrawer">
        <div class="cart-drawer-header">
            <div class="cart-drawer-title">
                <i class="fas fa-shopping-bag"></i>
                <span>Your Cart</span>
                <span class="cart-count-badge" id="drawerBadge">0</span>
            </div>
            <button class="cart-close-btn">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="cart-drawer-content">
            <div class="cart-items-container" id="cartItems"></div>
            <div class="cart-empty-message" id="cartEmpty" style="display: none;">
                <i class="fas fa-shopping-cart"></i>
                <p>Your cart is empty</p>
            </div>
        </div>

        <div class="cart-drawer-footer">
            <div class="cart-subtotal">
                <span>Subtotal:</span>
                <span id="cartSubtotal">Rs 0</span>
            </div>
            <a href="{{ route('checkout') }}" class="btn-checkout">
                <i class="fas fa-arrow-right"></i> Proceed to Checkout
            </a>
            <a href="{{ route('shop') }}" class="btn-continue-shopping">
                Continue Shopping
            </a>
        </div>
    </div>

    <!-- Main Content -->
    @yield('content')

    @include('frontend.layouts.partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Promo Banner Slider
        let currentPromoIndex = 0;
        const promoSlides = document.querySelectorAll('.promo-slide');
        const totalPromos = promoSlides.length;

        function showPromoSlide(index) {
            promoSlides.forEach(slide => slide.classList.remove('active'));
            promoSlides[index].classList.add('active');
        }

        function nextPromo() {
            currentPromoIndex = (currentPromoIndex + 1) % totalPromos;
            showPromoSlide(currentPromoIndex);
        }

        function prevPromo() {
            currentPromoIndex = (currentPromoIndex - 1 + totalPromos) % totalPromos;
            showPromoSlide(currentPromoIndex);
        }

        // Auto-rotate promo banner every 5 seconds
        setInterval(nextPromo, 5000);

        // Cart Management System
        const cartManager = {
            items: [],

            init() {
                this.loadCart();
                this.updateBadge();
                this.updateCartDrawer();
                this.setupCartEvents();
            },

            loadCart() {
                const saved = localStorage.getItem('perfume_cart');
                this.items = saved ? JSON.parse(saved) : [];
            },

            saveCart() {
                localStorage.setItem('perfume_cart', JSON.stringify(this.items));
            },

            addItem(product) {
                const existing = this.items.find(item => item.id === product.id);
                if (existing) {
                    existing.quantity += product.quantity;
                } else {
                    this.items.push(product);
                }
                this.saveCart();
                this.updateBadge();
                this.updateCartDrawer();
            },

            removeItem(productId) {
                this.items = this.items.filter(item => item.id !== productId);
                this.saveCart();
                this.updateBadge();
                this.updateCartDrawer();
            },

            updateQuantity(productId, quantity) {
                const item = this.items.find(item => item.id === productId);
                if (item) {
                    item.quantity = Math.max(1, quantity);
                    this.saveCart();
                    this.updateBadge();
                    this.updateCartDrawer();
                }
            },

            getTotalItems() {
                return this.items.reduce((sum, item) => sum + item.quantity, 0);
            },

            getSubtotal() {
                return this.items.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            },

            updateBadge() {
                const badge = document.getElementById('cartBadge');
                const drawerBadge = document.getElementById('drawerBadge');
                const total = this.getTotalItems();
                
                if (badge) {
                    if (total > 0) {
                        badge.textContent = total;
                        badge.style.display = 'flex';
                    } else {
                        badge.style.display = 'none';
                    }
                }

                if (drawerBadge) {
                    drawerBadge.textContent = total;
                }
            },

            setupCartEvents() {
                const cartLink = document.querySelector('.navbar-cart-link');
                if (cartLink) {
                    cartLink.addEventListener('click', (e) => {
                        e.preventDefault();
                        this.toggleCartDrawer();
                    });
                }
            },

            toggleCartDrawer() {
                const drawer = document.getElementById('cartDrawer');
                if (drawer) {
                    drawer.classList.toggle('open');
                }
            },

            updateCartDrawer() {
                const itemsContainer = document.getElementById('cartItems');
                const subtotal = document.getElementById('cartSubtotal');
                const emptyMessage = document.getElementById('cartEmpty');

                if (!itemsContainer) return;

                if (this.items.length === 0) {
                    itemsContainer.innerHTML = '';
                    if (emptyMessage) emptyMessage.style.display = 'block';
                    if (subtotal) subtotal.textContent = 'Rs 0';
                    return;
                }

                if (emptyMessage) emptyMessage.style.display = 'none';

                itemsContainer.innerHTML = this.items.map(item => `
                    <div class="cart-item">
                        <img src="${item.image}" alt="${item.name}" class="cart-item-image">
                        <div class="cart-item-details">
                            <h6>${item.name}</h6>
                            <p class="cart-item-price">Rs ${(item.price * item.quantity).toLocaleString()}</p>
                        </div>
                        <div class="cart-item-actions">
                            <div class="cart-quantity-control">
                                <button class="cart-qty-minus" data-product-id="${item.id}" data-quantity="${item.quantity}">−</button>
                                <input type="number" value="${item.quantity}" readonly>
                                <button class="cart-qty-plus" data-product-id="${item.id}" data-quantity="${item.quantity}">+</button>
                            </div>
                            <button class="cart-remove-btn" data-product-id="${item.id}" title="Remove">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                `).join('');

                // Add event listeners to quantity buttons
                itemsContainer.querySelectorAll('.cart-qty-minus').forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        e.stopPropagation();
                        const productId = parseInt(btn.getAttribute('data-product-id'));
                        const quantity = parseInt(btn.getAttribute('data-quantity'));
                        this.updateQuantity(productId, quantity - 1);
                    });
                });

                itemsContainer.querySelectorAll('.cart-qty-plus').forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        e.stopPropagation();
                        const productId = parseInt(btn.getAttribute('data-product-id'));
                        const quantity = parseInt(btn.getAttribute('data-quantity'));
                        this.updateQuantity(productId, quantity + 1);
                    });
                });

                itemsContainer.querySelectorAll('.cart-remove-btn').forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        e.stopPropagation();
                        const productId = parseInt(btn.getAttribute('data-product-id'));
                        this.removeItem(productId);
                    });
                });

                if (subtotal) {
                    subtotal.textContent = 'Rs ' + this.getSubtotal().toLocaleString();
                }
            }
        };

        // Initialize cart on page load
        document.addEventListener('DOMContentLoaded', function() {
            cartManager.init();
        });

        // Update cart when page becomes visible (switching tabs)
        document.addEventListener('visibilitychange', function() {
            if (!document.hidden) {
                cartManager.init();
            }
        });

        // Close cart drawer when clicking outside
        document.addEventListener('click', function(e) {
            const drawer = document.getElementById('cartDrawer');
            const cartLink = document.querySelector('.navbar-cart-link');
            
            // Only close if clicking outside the drawer and cart link
            if (drawer && !drawer.contains(e.target) && !cartLink.contains(e.target)) {
                drawer.classList.remove('open');
            }
        });

        // Close cart drawer when clicking close button
        document.addEventListener('click', function(e) {
            if (e.target.closest('.cart-close-btn')) {
                const drawer = document.getElementById('cartDrawer');
                if (drawer) {
                    drawer.classList.remove('open');
                }
            }
        });
    </script>
    
    @yield('extra-js')
</body>
</html>

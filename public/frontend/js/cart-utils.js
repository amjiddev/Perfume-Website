/**
 * Cart Utilities - Reusable Cart Functions
 * Professional Add to Cart Implementation
 */

// Add to Cart Function
function addToCart(productId, productName, productPrice, productImage, quantity = 1) {
    // Validate inputs
    if (!productId || !productName || !productPrice || !productImage) {
        console.error('Invalid product data:', { productId, productName, productPrice, productImage });
        showNotification('Error: Invalid product data', 'error');
        return false;
    }

    // Check if cart manager is available
    if (typeof cartManager === 'undefined') {
        console.error('Cart manager not available');
        showNotification('Error: Cart system not loaded. Please refresh the page.', 'error');
        return false;
    }

    const product = {
        id: parseInt(productId),
        name: productName.trim(),
        price: parseFloat(productPrice),
        image: productImage,
        quantity: parseInt(quantity) || 1
    };

    try {
        cartManager.addItem(product);
        showNotification(`${productName} added to cart!`, 'success');
        return true;
    } catch (error) {
        console.error('Error adding to cart:', error);
        showNotification('Failed to add item to cart', 'error');
        return false;
    }
}

// Initialize Add to Cart Buttons
function initAddToCartButtons() {
    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
        // Remove existing listeners to prevent duplicates
        button.replaceWith(button.cloneNode(true));
    });

    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
        // Update button badge on init
        updateProductBadge(button);

        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            const productId = this.getAttribute('data-product-id');
            const productName = this.getAttribute('data-product-name');
            const productPrice = this.getAttribute('data-product-price');
            const productImage = this.getAttribute('data-product-image');
            const quantity = this.getAttribute('data-product-quantity') || 1;

            // Show loading state
            const originalHTML = this.innerHTML;
            this.disabled = true;
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adding...';

            // Simulate a small delay for better UX
            setTimeout(() => {
                const success = addToCart(productId, productName, productPrice, productImage, quantity);
                
                // Reset button state
                this.disabled = false;
                if (success) {
                    // Show success animation
                    this.innerHTML = '<i class="fas fa-check"></i> Added!';
                    this.classList.add('added-to-cart');
                    
                    setTimeout(() => {
                        this.innerHTML = originalHTML;
                        this.classList.remove('added-to-cart');
                        // Update badge after adding
                        updateProductBadge(this);
                        // Update all product badges
                        updateAllProductBadges();
                    }, 1500);
                } else {
                    this.innerHTML = originalHTML;
                }
            }, 300);
        });
    });
}

// Update product quantity badge on button
function updateProductBadge(button) {
    const productId = parseInt(button.getAttribute('data-product-id'));
    
    // Remove existing badge if any
    const existingBadge = button.querySelector('.product-qty-badge');
    if (existingBadge) {
        existingBadge.remove();
    }

    // Check cart for this product
    if (typeof cartManager !== 'undefined') {
        const cartItem = cartManager.items.find(item => item.id === productId);
        
        if (cartItem && cartItem.quantity > 0) {
            // Create badge - will be inserted before the icon
            const badge = document.createElement('span');
            badge.className = 'product-qty-badge';
            badge.textContent = cartItem.quantity;
            
            // Insert badge as first child of button (before icon)
            button.insertBefore(badge, button.firstChild);
        }
    }
}

// Update all product badges
function updateAllProductBadges() {
    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
        updateProductBadge(button);
    });
}

// Show Notification
function showNotification(message, type = 'success') {
    // Remove any existing notifications
    const existing = document.querySelector('.cart-notification');
    if (existing) {
        existing.remove();
    }

    const notification = document.createElement('div');
    notification.className = `cart-notification cart-notification-${type}`;
    
    const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
    const bgColor = type === 'success' ? '#00aa00' : '#ff4444';
    
    notification.innerHTML = `
        <i class="fas ${icon}"></i>
        <span>${message}</span>
    `;
    
    notification.style.backgroundColor = bgColor;
    document.body.appendChild(notification);

    // Trigger animation
    requestAnimationFrame(() => {
        notification.classList.add('show');
    });

    // Remove after delay
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

// Override cartManager methods to update badges after cart operations
document.addEventListener('DOMContentLoaded', function() {
    initAddToCartButtons();
    
    // Update badges after a short delay to ensure cart is loaded
    setTimeout(() => {
        updateAllProductBadges();
    }, 200);
    
    // Hook into cartManager's methods to update badges
    if (typeof cartManager !== 'undefined') {
        // Store original methods
        const originalRemoveItem = cartManager.removeItem.bind(cartManager);
        const originalUpdateQuantity = cartManager.updateQuantity.bind(cartManager);
        
        // Override removeItem to update badges
        cartManager.removeItem = function(productId) {
            originalRemoveItem(productId);
            setTimeout(() => updateAllProductBadges(), 100);
        };
        
        // Override updateQuantity to update badges
        cartManager.updateQuantity = function(productId, quantity) {
            originalUpdateQuantity(productId, quantity);
            setTimeout(() => updateAllProductBadges(), 100);
        };
        
        console.log('Product badges hooked into cartManager');
    }
});

// Listen for storage changes (cart updates from other tabs)
window.addEventListener('storage', function(e) {
    if (e.key === 'perfume_cart') {
        updateAllProductBadges();
    }
});

// Update badges when page becomes visible
document.addEventListener('visibilitychange', function() {
    if (!document.hidden) {
        updateAllProductBadges();
    }
});

// Re-initialize when content is dynamically loaded
window.reinitAddToCartButtons = initAddToCartButtons;
window.updateAllProductBadges = updateAllProductBadges;

// Make functions globally accessible
window.addToCart = addToCart;
window.showNotification = showNotification;

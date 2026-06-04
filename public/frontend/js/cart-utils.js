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
                    }, 1500);
                } else {
                    this.innerHTML = originalHTML;
                }
            }, 300);
        });
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

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    initAddToCartButtons();
});

// Re-initialize when content is dynamically loaded
window.reinitAddToCartButtons = initAddToCartButtons;

// Make functions globally accessible
window.addToCart = addToCart;
window.showNotification = showNotification;

<section class="section" style="margin-top: 120px;">
    <div class="container">
        <div class="section-header">
            <h1 class="section-title">Shopping Cart</h1>
            <p class="section-subtitle">Review your selected services and proceed to checkout</p>
        </div>
        
        <!-- Cart Items -->
        <div id="cart-items" class="card" style="margin-bottom: 2rem;">
            <h3 style="margin-bottom: 1.5rem; color: var(--deep-green);">Your Services</h3>
            <div id="cart-content">
                <!-- Cart items will be populated by JavaScript -->
            </div>
            <div id="cart-total" style="border-top: 2px solid var(--light); padding-top: 1rem; margin-top: 1rem;">
                <!-- Total will be calculated by JavaScript -->
            </div>
        </div>
        
        <!-- Empty Cart Message -->
        <div id="empty-cart" class="card" style="text-align: center; padding: 3rem; display: none;">
            <div style="font-size: 4rem; margin-bottom: 1rem;">🛒</div>
            <h3 style="color: var(--deep-green); margin-bottom: 1rem;">Your cart is empty</h3>
            <p style="color: #666; margin-bottom: 2rem;">Add some services to get started!</p>
            <a href="<?= base_url('/') ?>" class="btn btn-primary">Browse Services</a>
        </div>
        
        <!-- Checkout Form -->
        <div id="checkout-form" class="card" style="display: none;">
            <h3 style="margin-bottom: 1.5rem; color: var(--deep-green);">Checkout Information</h3>
            
            <form id="checkout" method="POST" action="<?= base_url('/checkout') ?>">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-bottom: 2rem;">
                    <div>
                        <label for="email" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--deep-green);">Email Address *</label>
                        <input type="email" id="email" name="email" required style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 6px; font-size: 1rem;">
                    </div>
                    
                    <div>
                        <label for="phone" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--deep-green);">Phone Number *</label>
                        <input type="tel" id="phone" name="phone" required style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 6px; font-size: 1rem;">
                    </div>
                    
                    <div>
                        <label for="password" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--deep-green);">Password (to create account) *</label>
                        <input type="password" id="password" name="password" required style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 6px; font-size: 1rem;">
                    </div>
                    
                    <div>
                        <label for="preferred_date" style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--deep-green);">Preferred Date (Optional)</label>
                        <input type="date" id="preferred_date" name="preferred_date" style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 6px; font-size: 1rem;">
                    </div>
                </div>
                
                <div style="background: var(--light); padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem;">
                    <h4 style="color: var(--deep-green); margin-bottom: 1rem;">Important Notice</h4>
                    <p style="margin-bottom: 1rem; color: #666;">After completing your order, please call us at <strong>(717) 387-1643</strong> to schedule your appointment. Payment is due upon arrival.</p>
                    <p style="color: #666; margin: 0;">We'll send you a confirmation email with your order details and our contact information.</p>
                </div>
                
                <div style="text-align: center;">
                    <button type="submit" class="btn btn-primary" style="font-size: 1.1rem; padding: 1rem 3rem;">
                        Complete Order & Call to Schedule
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    loadCart();
});

function loadCart() {
    const cart = JSON.parse(localStorage.getItem('golf_cart')) || [];
    const cartContent = document.getElementById('cart-content');
    const cartTotal = document.getElementById('cart-total');
    const emptyCart = document.getElementById('empty-cart');
    const checkoutForm = document.getElementById('checkout-form');
    
    if (cart.length === 0) {
        document.getElementById('cart-items').style.display = 'none';
        emptyCart.style.display = 'block';
        checkoutForm.style.display = 'none';
        return;
    }
    
    let total = 0;
    let cartHTML = '';
    
    cart.forEach((item, index) => {
        const itemTotal = item.price * item.quantity;
        total += itemTotal;
        
        cartHTML += `
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 1rem; border-bottom: 1px solid var(--light);">
                <div style="flex: 1;">
                    <h4 style="margin: 0 0 0.5rem 0; color: var(--deep-green);">${item.name}</h4>
                    <p style="margin: 0; color: #666; font-size: 0.9rem;">${item.unit || 'Service'}</p>
                </div>
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <button onclick="updateQuantity(${index}, ${item.quantity - 1})" style="background: var(--light); border: 1px solid #ddd; border-radius: 4px; width: 30px; height: 30px; cursor: pointer;">-</button>
                        <span style="min-width: 30px; text-align: center;">${item.quantity}</span>
                        <button onclick="updateQuantity(${index}, ${item.quantity + 1})" style="background: var(--light); border: 1px solid #ddd; border-radius: 4px; width: 30px; height: 30px; cursor: pointer;">+</button>
                    </div>
                    <div style="text-align: right; min-width: 100px;">
                        <div style="font-weight: 600; color: var(--deep-green);">$${itemTotal.toFixed(2)}</div>
                        <button onclick="removeItem(${index})" style="background: none; border: none; color: #dc3545; cursor: pointer; font-size: 0.8rem;">Remove</button>
                    </div>
                </div>
            </div>
        `;
    });
    
    cartContent.innerHTML = cartHTML;
    cartTotal.innerHTML = `
        <div style="display: flex; justify-content: space-between; align-items: center; font-size: 1.2rem; font-weight: 700;">
            <span>Total:</span>
            <span style="color: var(--deep-green);">$${total.toFixed(2)}</span>
        </div>
    `;
    
    document.getElementById('cart-items').style.display = 'block';
    emptyCart.style.display = 'none';
    checkoutForm.style.display = 'block';
}

function updateQuantity(index, newQuantity) {
    if (newQuantity < 1) {
        removeItem(index);
        return;
    }
    
    const cart = JSON.parse(localStorage.getItem('golf_cart')) || [];
    cart[index].quantity = newQuantity;
    localStorage.setItem('golf_cart', JSON.stringify(cart));
    
    // Trigger cart update event
    document.dispatchEvent(new CustomEvent('cartUpdated'));
    
    loadCart();
}

function removeItem(index) {
    const cart = JSON.parse(localStorage.getItem('golf_cart')) || [];
    cart.splice(index, 1);
    localStorage.setItem('golf_cart', JSON.stringify(cart));
    
    // Trigger cart update event
    document.dispatchEvent(new CustomEvent('cartUpdated'));
    
    loadCart();
}

// Handle checkout form submission
document.getElementById('checkout').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const cart = JSON.parse(localStorage.getItem('golf_cart')) || [];
    
    // Calculate total
    let total = 0;
    cart.forEach(item => {
        total += item.price * item.quantity;
    });
    
    // Show confirmation
    alert(`Order submitted! Total: $${total.toFixed(2)}\n\nPlease call (717) 387-1643 to schedule your appointment.\n\nYou will receive a confirmation email shortly.`);
    
    // Clear cart
    localStorage.removeItem('golf_cart');
    
    // Redirect to home
    window.location.href = '<?= base_url('/') ?>';
});
</script>

<section class="section" style="margin-top: 120px;">
    <div class="container">
        <div class="section-header">
            <h1 class="section-title">Shopping Cart</h1>
            <p class="section-subtitle">Review your selected services and proceed to checkout</p>
        </div>
        
        <!-- Same-Day Service Notice (if active) -->
        <div id="emergency-notice" style="display: none; margin-bottom: 2rem;">
            <div class="card" style="background: linear-gradient(135deg, #ff6b6b, #ee5a52); color: white; border: none;">
                <div style="display: flex; align-items: start; gap: 1rem;">
                    <div style="font-size: 2.5rem;">🚨</div>
                    <div style="flex: 1;">
                        <h3 style="margin: 0 0 0.75rem 0; color: white;">Same-Day Service Selected</h3>
                        <p style="margin: 0 0 0.75rem 0; color: rgba(255,255,255,0.9); font-size: 1rem;">You have selected ASAP same-day or next-day service with a +50% labor charge.</p>
                        <p style="margin: 0 0 1rem 0; color: white; font-weight: 700; font-size: 1.1rem;">⚠️ You MUST call <a href="tel:7173871643" style="color: white; text-decoration: underline;">(717) 387-1643</a> to confirm availability for same-day service.</p>
                        <button onclick="removeSameDayService()" style="background: white; color: #ff6b6b; border: none; padding: 0.75rem 1.5rem; border-radius: 6px; font-weight: 700; cursor: pointer; font-size: 0.95rem;">
                            Remove Same-Day Service
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Notice -->
        <div class="card" style="margin-bottom: 2rem; background: linear-gradient(135deg, var(--gold), #e6c45c); border: none; color: var(--graphite);">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="font-size: 2.5rem;">💳</div>
                <div>
                    <h3 style="margin: 0 0 0.5rem 0; color: var(--graphite);">Payment Information</h3>
                    <p style="margin: 0; font-weight: 600;">Payment is due upon arrival. We do not accept online payments at this time.</p>
                </div>
            </div>
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
    const emergencyMode = localStorage.getItem('emergency_mode') === 'true';
    const cartContent = document.getElementById('cart-content');
    const cartTotal = document.getElementById('cart-total');
    const emptyCart = document.getElementById('empty-cart');
    const checkoutForm = document.getElementById('checkout-form');
    const emergencyNotice = document.getElementById('emergency-notice');
    
    // Show/hide emergency notice
    if (emergencyMode && cart.length > 0) {
        emergencyNotice.style.display = 'block';
    } else {
        emergencyNotice.style.display = 'none';
    }
    
    if (cart.length === 0) {
        document.getElementById('cart-items').style.display = 'none';
        emptyCart.style.display = 'block';
        checkoutForm.style.display = 'none';
        emergencyNotice.style.display = 'none';
        return;
    }
    
    let subtotal = 0;
    let cartHTML = '';
    
    cart.forEach((item, index) => {
        const itemTotal = item.price * item.quantity;
        subtotal += itemTotal;
        
        cartHTML += `
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 1rem; border-bottom: 1px solid var(--light);">
                <div style="flex: 1;">
                    <h4 style="margin: 0 0 0.5rem 0; color: var(--deep-green);">${item.name}</h4>
                    <p style="margin: 0; color: #666; font-size: 0.9rem;">$${item.price.toFixed(2)} ${item.unit}</p>
                </div>
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <button type="button" onclick="updateCartQuantity(${index}, -1)" style="padding: 0.25rem 0.5rem; border: 1px solid #ddd; background: white; border-radius: 4px; cursor: pointer;">-</button>
                    <span style="min-width: 30px; text-align: center; font-weight: 600;">${item.quantity}</span>
                    <button type="button" onclick="updateCartQuantity(${index}, 1)" style="padding: 0.25rem 0.5rem; border: 1px solid #ddd; background: white; border-radius: 4px; cursor: pointer;">+</button>
                    <button type="button" onclick="removeItem(${index})" style="padding: 0.25rem 0.5rem; border: 1px solid #ff6b6b; background: #ff6b6b; color: white; border-radius: 4px; cursor: pointer; margin-left: 0.5rem;">×</button>
                </div>
                <div style="font-weight: 700; color: var(--deep-green); margin-left: 1rem;">$${itemTotal.toFixed(2)}</div>
            </div>
        `;
    });
    
    // Calculate emergency fee if applicable
    let emergencyFee = 0;
    let total = subtotal;
    
    if (emergencyMode) {
        emergencyFee = subtotal * 0.5; // 50% of subtotal
        total = subtotal + emergencyFee;
    }
    
    cartContent.innerHTML = cartHTML;
    
    let totalHTML = `
        <div style="margin-bottom: 1rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; font-size: 1.1rem; margin-bottom: 0.5rem;">
                <span style="font-weight: 600;">Subtotal:</span>
                <span style="color: var(--deep-green); font-weight: 600;">$${subtotal.toFixed(2)}</span>
            </div>
    `;
    
    if (emergencyMode) {
        totalHTML += `
            <div style="display: flex; justify-content: space-between; align-items: center; font-size: 1rem; margin-bottom: 0.5rem; color: #ff6b6b;">
                <span style="font-weight: 600;">Same-Day Service Fee (+50%):</span>
                <span style="font-weight: 700;">$${emergencyFee.toFixed(2)}</span>
            </div>
        `;
    }
    
    totalHTML += `
        </div>
        <div style="display: flex; justify-content: space-between; align-items: center; font-size: 1.3rem; font-weight: 700; padding-top: 1rem; border-top: 2px solid var(--deep-green);">
            <span>Total:</span>
            <span style="color: var(--deep-green);">$${total.toFixed(2)}</span>
        </div>
    `;
    
    cartTotal.innerHTML = totalHTML;
    
    document.getElementById('cart-items').style.display = 'block';
    emptyCart.style.display = 'none';
    checkoutForm.style.display = 'block';
}

// Cart editing functions
function updateCartQuantity(index, change) {
    const cart = JSON.parse(localStorage.getItem('golf_cart')) || [];
    if (cart[index]) {
        const newQuantity = cart[index].quantity + change;
        if (newQuantity > 0) {
            cart[index].quantity = newQuantity;
        } else {
            // Remove item if quantity drops to 0
            cart.splice(index, 1);
        }
        localStorage.setItem('golf_cart', JSON.stringify(cart));
        document.dispatchEvent(new CustomEvent('cartUpdated')); // Trigger event
        loadCart();
    }
}

function removeItem(index) {
    const cart = JSON.parse(localStorage.getItem('golf_cart')) || [];
    cart.splice(index, 1);
    localStorage.setItem('golf_cart', JSON.stringify(cart));
    document.dispatchEvent(new CustomEvent('cartUpdated')); // Trigger event
    loadCart();
}

// Remove same-day service function
function removeSameDayService() {
    localStorage.setItem('emergency_mode', 'false');
    
    // Trigger cart update event for other pages
    document.dispatchEvent(new CustomEvent('cartUpdated'));
    
    // Reload cart display
    loadCart();
    
    // Show success message
    alert('Same-Day Service removed. Your cart has been updated with standard pricing.');
}

// Handle checkout form submission
document.getElementById('checkout').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const cart = JSON.parse(localStorage.getItem('golf_cart')) || [];
    const emergencyMode = localStorage.getItem('emergency_mode') === 'true';
    
    // Calculate total
    let subtotal = 0;
    cart.forEach(item => {
        subtotal += item.price * item.quantity;
    });
    
    // Add emergency fee if applicable
    let total = subtotal;
    if (emergencyMode) {
        total += subtotal * 0.5;
    }
    
    // Show confirmation
    let message = `Order submitted! Total: $${total.toFixed(2)}\n\nPlease call (717) 387-1643 to schedule your appointment.`;
    if (emergencyMode) {
        message += '\n\n⚠️ IMPORTANT: You MUST call to confirm same-day service availability!';
    }
    message += '\n\nYou will receive a confirmation email shortly.';
    
    alert(message);
    
    // Clear cart and emergency mode
    localStorage.removeItem('golf_cart');
    localStorage.removeItem('emergency_mode');
    
    // Redirect to home
    window.location.href = '<?= base_url('/') ?>';
});
</script>

<!-- Policy Banner -->
<div style="background: var(--deep-green); color: white; text-align: center; padding: 0.75rem; font-weight: 600;">
    In-home workshop — No walk-ins. Call to book: <a href="tel:7173871643" style="color: white; text-decoration: underline;">(717) 387-1643</a>
</div>

<section class="section" style="margin-top: 120px;">
    <div class="container">
        <div class="section-header">
            <h1 class="section-title">Custom Club Building</h1>
            <p class="section-subtitle">Select your services and add them to your cart for checkout</p>
        </div>
        
        <!-- Emergency Service Notice -->
        <div class="card" style="margin-bottom: 3rem; background: linear-gradient(135deg, #ff6b6b, #ee5a52); color: white; border: none;">
            <h3 style="margin-bottom: 1rem; color: white;">🚨 Emergency Repair Service</h3>
            <p style="margin-bottom: 1rem; color: rgba(255,255,255,0.9);">Need same-day or next-day service? Select emergency repair for +50% labor charge.</p>
            <div style="display: flex; align-items: center; gap: 1rem;">
                <input type="checkbox" id="emergency-service" style="transform: scale(1.2);">
                <label for="emergency-service" style="font-weight: 600; color: white;">Emergency Service (+50% on labor)</label>
            </div>
            <p style="margin-top: 1rem; color: rgba(255,255,255,0.8); font-size: 0.9rem;">⚠️ Emergency service requires phone confirmation for same-day or close appointments</p>
        </div>
        
        <!-- Call to Schedule Notice -->
        <div class="card" style="margin-bottom: 3rem; background: linear-gradient(135deg, var(--gold), #e6c45c); border: none; color: var(--graphite);">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="font-size: 3rem;">📞</div>
                <div>
                    <h3 style="margin: 0 0 0.5rem 0; color: var(--graphite);">Appointments Scheduled by Phone</h3>
                    <p style="margin: 0; font-weight: 500;">Please complete your order online, then call us at <a href="tel:7173871643" style="color: var(--graphite); text-decoration: underline; font-weight: 700;">(717) 387-1643</a> to schedule your drop-off time. Payment is due upon arrival.</p>
                </div>
            </div>
        </div>
        
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 3rem;">
            <!-- Services Selection -->
            <div>
                <!-- Club Builds -->
                <div class="card" style="margin-bottom: 2rem;">
                    <h3 style="margin-bottom: 1.5rem; color: var(--deep-green);">Club Builds</h3>
                    <div style="display: grid; gap: 1rem;">
                        <?php foreach ($services['club_builds'] as $service): ?>
                        <div class="service-item" style="display: flex; justify-content: space-between; align-items: center; padding: 1rem; border: 2px solid var(--light); border-radius: 8px; transition: all 0.3s ease;">
                            <div style="flex: 1;">
                                <h4 style="margin: 0 0 0.5rem 0; color: var(--deep-green);"><?= $service['name'] ?></h4>
                                <p style="margin: 0; color: #666; font-size: 0.9rem;"><?= $service['description'] ?></p>
                            </div>
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <span style="font-weight: 700; color: var(--deep-green);">$<span class="service-price"><?= number_format($service['price'], 2) ?></span> <?= $service['unit'] ?></span>
                                <div style="display: flex; align-items: center; gap: 0.5rem;">
                                    <button type="button" class="btn btn-outline" onclick="changeQuantity('<?= $service['id'] ?>', -1)" style="padding: 0.25rem 0.5rem; font-size: 0.8rem;">-</button>
                                    <input type="number" id="qty-<?= $service['id'] ?>" value="0" min="0" style="width: 60px; text-align: center; padding: 0.25rem; border: 1px solid #ddd; border-radius: 4px;">
                                    <button type="button" class="btn btn-outline" onclick="changeQuantity('<?= $service['id'] ?>', 1)" style="padding: 0.25rem 0.5rem; font-size: 0.8rem;">+</button>
                                </div>
                                <button type="button" class="btn btn-primary" onclick="addToCart('<?= $service['id'] ?>', '<?= $service['name'] ?>', <?= $service['price'] ?>, '<?= $service['unit'] ?>')" style="padding: 0.5rem 1rem; font-size: 0.9rem;">Add to Cart</button>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <!-- Regrips -->
                <div class="card" style="margin-bottom: 2rem;">
                    <h3 style="margin-bottom: 1.5rem; color: var(--deep-green);">Regrips & Grip Services</h3>
                    <div style="display: grid; gap: 1rem;">
                        <?php foreach ($services['regrips'] as $service): ?>
                        <div class="service-item" style="display: flex; justify-content: space-between; align-items: center; padding: 1rem; border: 2px solid var(--light); border-radius: 8px; transition: all 0.3s ease;">
                            <div style="flex: 1;">
                                <h4 style="margin: 0 0 0.5rem 0; color: var(--deep-green);"><?= $service['name'] ?></h4>
                                <p style="margin: 0; color: #666; font-size: 0.9rem;"><?= $service['description'] ?></p>
                            </div>
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <span style="font-weight: 700; color: var(--deep-green);">$<span class="service-price"><?= number_format($service['price'], 2) ?></span> <?= $service['unit'] ?></span>
                                <div style="display: flex; align-items: center; gap: 0.5rem;">
                                    <button type="button" class="btn btn-outline" onclick="changeQuantity('<?= $service['id'] ?>', -1)" style="padding: 0.25rem 0.5rem; font-size: 0.8rem;">-</button>
                                    <input type="number" id="qty-<?= $service['id'] ?>" value="0" min="0" style="width: 60px; text-align: center; padding: 0.25rem; border: 1px solid #ddd; border-radius: 4px;">
                                    <button type="button" class="btn btn-outline" onclick="changeQuantity('<?= $service['id'] ?>', 1)" style="padding: 0.25rem 0.5rem; font-size: 0.8rem;">+</button>
                                </div>
                                <button type="button" class="btn btn-primary" onclick="addToCart('<?= $service['id'] ?>', '<?= $service['name'] ?>', <?= $service['price'] ?>, '<?= $service['unit'] ?>')" style="padding: 0.5rem 1rem; font-size: 0.9rem;">Add to Cart</button>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <!-- Grip Tiers -->
                    <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid #eee;">
                        <h4 style="margin-bottom: 1rem; color: var(--deep-green);">Grip Tiers (Examples)</h4>
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                            <?php foreach ($services['grip_tiers'] as $tier): ?>
                            <div style="padding: 1rem; background: var(--light); border-radius: 8px; text-align: center;">
                                <h5 style="margin: 0 0 0.5rem 0; color: var(--deep-green);"><?= $tier['name'] ?></h5>
                                <p style="margin: 0 0 0.5rem 0; color: #666; font-size: 0.9rem;"><?= $tier['description'] ?></p>
                                <span style="font-weight: 700; color: var(--deep-green);"><?= $tier['price_range'] ?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Cart Sidebar -->
            <div>
                <div class="card" style="position: sticky; top: 140px;">
                    <h3 style="margin-bottom: 1.5rem; color: var(--deep-green);">Your Cart</h3>
                    <div id="cart-items" style="margin-bottom: 2rem;">
                        <p style="color: #666; text-align: center; margin: 2rem 0;">Your cart is empty</p>
                    </div>
                    
                    <div id="cart-total" style="display: none; margin-bottom: 2rem; padding-top: 2rem; border-top: 2px solid var(--deep-green);">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                            <span style="font-weight: 600; color: var(--deep-green);">Subtotal:</span>
                            <span id="subtotal" style="font-weight: 700; color: var(--deep-green);">$0.00</span>
                        </div>
                        <div id="emergency-fee" style="display: none; margin-bottom: 1rem;">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span style="color: #ff6b6b; font-weight: 600;">Emergency Fee (+50%):</span>
                                <span id="emergency-fee-amount" style="color: #ff6b6b; font-weight: 700;">$0.00</span>
                            </div>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center; font-size: 1.2rem; font-weight: 700; color: var(--deep-green);">
                            <span>Total:</span>
                            <span id="total">$0.00</span>
                        </div>
                    </div>
                    
                    <div style="display: flex; flex-direction: column; gap: 1rem;">
                        <a href="<?= base_url('/cart') ?>" class="btn btn-primary" style="width: 100%; text-align: center; display: none;" id="view-cart-btn">View Cart</a>
                        <a href="<?= base_url('/checkout') ?>" class="btn btn-primary" style="width: 100%; text-align: center; display: none;" id="checkout-btn">Proceed to Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// Cart functionality
let cart = JSON.parse(localStorage.getItem('golf_cart')) || [];
let emergencyMode = false;

// Update emergency mode
document.getElementById('emergency-service').addEventListener('change', function() {
    emergencyMode = this.checked;
    updateCartDisplay();
});

function changeQuantity(serviceId, change) {
    const input = document.getElementById('qty-' + serviceId);
    const newValue = Math.max(0, parseInt(input.value) + change);
    input.value = newValue;
}

function addToCart(serviceId, serviceName, price, unit) {
    const quantity = parseInt(document.getElementById('qty-' + serviceId).value);
    
    if (quantity <= 0) {
        alert('Please select a quantity first');
        return;
    }
    
    // Check if item already exists in cart
    const existingItem = cart.find(item => item.id === serviceId);
    
    if (existingItem) {
        existingItem.quantity += quantity;
    } else {
        cart.push({
            id: serviceId,
            name: serviceName,
            price: price,
            unit: unit,
            quantity: quantity,
            category: 'club_building'
        });
    }
    
    // Reset quantity
    document.getElementById('qty-' + serviceId).value = 0;
    
    // Save to localStorage
    localStorage.setItem('golf_cart', JSON.stringify(cart));
    
    // Update display
    updateCartDisplay();
    
    // Show success message
    alert('Added to cart!');
}

function updateCartDisplay() {
    const cartItems = document.getElementById('cart-items');
    const cartTotal = document.getElementById('cart-total');
    const viewCartBtn = document.getElementById('view-cart-btn');
    const checkoutBtn = document.getElementById('checkout-btn');
    
    if (cart.length === 0) {
        cartItems.innerHTML = '<p style="color: #666; text-align: center; margin: 2rem 0;">Your cart is empty</p>';
        cartTotal.style.display = 'none';
        viewCartBtn.style.display = 'none';
        checkoutBtn.style.display = 'none';
        return;
    }
    
    // Display cart items
    let html = '';
    let subtotal = 0;
    
    cart.forEach((item, index) => {
        const itemTotal = item.price * item.quantity;
        subtotal += itemTotal;
        
        html += `
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 0; border-bottom: 1px solid #eee;">
                <div style="flex: 1;">
                    <div style="font-weight: 600; color: var(--deep-green);">${item.name}</div>
                    <div style="font-size: 0.9rem; color: #666;">Qty: ${item.quantity} × $${item.price.toFixed(2)}</div>
                </div>
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <button type="button" onclick="updateCartQuantity(${index}, -1)" style="padding: 0.25rem 0.5rem; border: 1px solid #ddd; background: white; border-radius: 4px; cursor: pointer;">-</button>
                    <span style="min-width: 30px; text-align: center; font-weight: 600;">${item.quantity}</span>
                    <button type="button" onclick="updateCartQuantity(${index}, 1)" style="padding: 0.25rem 0.5rem; border: 1px solid #ddd; background: white; border-radius: 4px; cursor: pointer;">+</button>
                    <button type="button" onclick="removeFromCart(${index})" style="padding: 0.25rem 0.5rem; border: 1px solid #ff6b6b; background: #ff6b6b; color: white; border-radius: 4px; cursor: pointer; margin-left: 0.5rem;">×</button>
                </div>
                <div style="font-weight: 700; color: var(--deep-green); margin-left: 1rem;">$${itemTotal.toFixed(2)}</div>
            </div>
        `;
    });
    
    cartItems.innerHTML = html;
    
    // Calculate emergency fee
    let emergencyFee = 0;
    if (emergencyMode) {
        emergencyFee = subtotal * 0.5;
    }
    
    const total = subtotal + emergencyFee;
    
    // Update totals
    document.getElementById('subtotal').textContent = '$' + subtotal.toFixed(2);
    document.getElementById('emergency-fee-amount').textContent = '$' + emergencyFee.toFixed(2);
    document.getElementById('total').textContent = '$' + total.toFixed(2);
    
    // Show/hide emergency fee
    const emergencyFeeDiv = document.getElementById('emergency-fee');
    if (emergencyMode && emergencyFee > 0) {
        emergencyFeeDiv.style.display = 'block';
    } else {
        emergencyFeeDiv.style.display = 'none';
    }
    
    // Show buttons
    cartTotal.style.display = 'block';
    viewCartBtn.style.display = 'block';
    checkoutBtn.style.display = 'block';
}

// Cart editing functions
function updateCartQuantity(index, change) {
    cart[index].quantity = Math.max(0, cart[index].quantity + change);
    
    // Remove item if quantity becomes 0
    if (cart[index].quantity === 0) {
        cart.splice(index, 1);
    }
    
    // Save to localStorage
    localStorage.setItem('golf_cart', JSON.stringify(cart));
    
    // Update display
    updateCartDisplay();
}

function removeFromCart(index) {
    cart.splice(index, 1);
    
    // Save to localStorage
    localStorage.setItem('golf_cart', JSON.stringify(cart));
    
    // Update display
    updateCartDisplay();
}

// Initialize display
updateCartDisplay();

// No calendar functionality needed - appointments scheduled by phone after checkout
</script>

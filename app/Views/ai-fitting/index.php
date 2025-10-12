<!-- Policy Banner -->
<div style="background: var(--deep-green); color: white; text-align: center; padding: 0.75rem; font-weight: 600;">
    In-home workshop — No walk-ins. Call to book: <a href="tel:7173871643" style="color: white; text-decoration: underline;">(717) 387-1643</a>
</div>

<section class="section" style="margin-top: 120px;">
    <div class="container">
        <div class="section-header">
            <h1 class="section-title">AI Club & Shaft Fitting</h1>
            <p class="section-subtitle">Revolutionary AI technology analyzes your swing in real-time, providing data-driven recommendations for optimal club selection and customization.</p>
        </div>
        
        <!-- Call to Schedule Notice -->
        <div class="card" style="margin-bottom: 3rem; background: linear-gradient(135deg, var(--gold), #e6c45c); border: none; color: var(--graphite);">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <div style="font-size: 3rem;">📞</div>
                <div>
                    <h3 style="margin: 0 0 0.5rem 0; color: var(--graphite);">Appointments Scheduled by Phone</h3>
                    <p style="margin: 0; font-weight: 500;">Please complete your order online, then call us at <a href="tel:7173871643" style="color: var(--graphite); text-decoration: underline; font-weight: 700;">(717) 387-1643</a> to reserve your time slot. Payment is due upon arrival.</p>
                </div>
            </div>
        </div>
        
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 3rem;">
            <!-- Services Selection -->
            <div>
                <!-- Fitting Services -->
                <div class="card" style="margin-bottom: 2rem;">
                    <h3 style="margin-bottom: 1.5rem; color: var(--deep-green);">Fitting Services</h3>
                    <div style="display: grid; gap: 1.5rem;">
                        <?php foreach ($fitting_services as $service): ?>
                        <div class="service-item" style="padding: 2rem; border: 2px solid var(--light); border-radius: 12px; transition: all 0.3s ease;">
                            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem;">
                                <div style="flex: 1;">
                                    <h4 style="margin: 0 0 0.5rem 0; color: var(--deep-green); font-size: 1.3rem;"><?= $service['name'] ?></h4>
                                    <p style="margin: 0 0 1rem 0; color: #666;"><?= $service['description'] ?></p>
                                    <ul style="list-style: none; padding: 0; margin: 0;">
                                        <?php foreach ($service['includes'] as $include): ?>
                                        <li style="margin-bottom: 0.5rem; color: #555;">✓ <?= $include ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <div style="text-align: right; margin-left: 2rem;">
                                    <div style="font-size: 2rem; font-weight: 700; color: var(--deep-green); margin-bottom: 0.5rem;">
                                        $<?= number_format($service['price'], 2) ?>
                                    </div>
                                    <div style="color: #666; margin-bottom: 1rem;"><?= $service['duration'] ?></div>
                                    <button class="btn btn-primary" onclick="addFittingToCart('<?= $service['id'] ?>', '<?= $service['name'] ?>', <?= $service['price'] ?>, '<?= $service['duration'] ?>')" style="padding: 0.75rem 1.5rem;">Add to Cart</button>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <!-- Repair Services -->
                <div class="card" style="margin-bottom: 2rem;">
                    <h3 style="margin-bottom: 1.5rem; color: var(--deep-green);">Repair & Adjustment Services</h3>
                    <p style="margin-bottom: 2rem; color: #666;">Add repair services to your fitting appointment. All services include rush option (+50% for same-day service).</p>
                    
                    <div style="display: grid; gap: 1rem;">
                        <?php foreach ($repair_services as $service): ?>
                        <div class="service-item" style="display: flex; justify-content: space-between; align-items: center; padding: 1rem; border: 2px solid var(--light); border-radius: 8px; transition: all 0.3s ease;">
                            <div style="flex: 1;">
                                <h4 style="margin: 0 0 0.5rem 0; color: var(--deep-green);"><?= $service['name'] ?></h4>
                                <p style="margin: 0; color: #666; font-size: 0.9rem;"><?= $service['description'] ?></p>
                                <?php if (isset($service['set_price'])): ?>
                                <p style="margin: 0.5rem 0 0 0; color: #888; font-size: 0.85rem;"><?= $service['set_unit'] ?>: $<?= number_format($service['set_price'], 2) ?></p>
                                <?php endif; ?>
                            </div>
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <span style="font-weight: 700; color: var(--deep-green);">$<?= number_format($service['price'], 2) ?> <?= $service['unit'] ?></span>
                                <div style="display: flex; align-items: center; gap: 0.5rem;">
                                    <button type="button" class="btn btn-outline" onclick="changeRepairQuantity('<?= $service['id'] ?>', -1)" style="padding: 0.25rem 0.5rem; font-size: 0.8rem;">-</button>
                                    <input type="number" id="qty-<?= $service['id'] ?>" value="0" min="0" style="width: 60px; text-align: center; padding: 0.25rem; border: 1px solid #ddd; border-radius: 4px;">
                                    <button type="button" class="btn btn-outline" onclick="changeRepairQuantity('<?= $service['id'] ?>', 1)" style="padding: 0.25rem 0.5rem; font-size: 0.8rem;">+</button>
                                </div>
                                <button type="button" class="btn btn-primary" onclick="addRepairToCart('<?= $service['id'] ?>', '<?= $service['name'] ?>', <?= $service['price'] ?>, '<?= $service['unit'] ?>')" style="padding: 0.5rem 1rem; font-size: 0.9rem;">Add to Cart</button>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <!-- Stiffness Profile Info -->
                <div class="card" style="background: var(--light);">
                    <h3 style="margin-bottom: 1.5rem; color: var(--deep-green);">Shaft Stiffness Profile</h3>
                    <p style="margin-bottom: 1.5rem; color: #666;">We determine your optimal shaft flex based on swing speed, tempo, launch characteristics, and strike pattern.</p>
                    
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); gap: 1rem; margin-bottom: 1.5rem;">
                        <div style="text-align: center; padding: 1rem; background: white; border-radius: 8px;">
                            <div style="font-weight: 700; color: var(--deep-green); margin-bottom: 0.5rem;">L</div>
                            <div style="font-size: 0.9rem; color: #666;">Ladies</div>
                        </div>
                        <div style="text-align: center; padding: 1rem; background: white; border-radius: 8px;">
                            <div style="font-weight: 700; color: var(--deep-green); margin-bottom: 0.5rem;">A/M</div>
                            <div style="font-size: 0.9rem; color: #666;">Senior</div>
                        </div>
                        <div style="text-align: center; padding: 1rem; background: white; border-radius: 8px;">
                            <div style="font-weight: 700; color: var(--deep-green); margin-bottom: 0.5rem;">R</div>
                            <div style="font-size: 0.9rem; color: #666;">Regular</div>
                        </div>
                        <div style="text-align: center; padding: 1rem; background: white; border-radius: 8px;">
                            <div style="font-weight: 700; color: var(--deep-green); margin-bottom: 0.5rem;">S</div>
                            <div style="font-size: 0.9rem; color: #666;">Stiff</div>
                        </div>
                        <div style="text-align: center; padding: 1rem; background: white; border-radius: 8px;">
                            <div style="font-weight: 700; color: var(--deep-green); margin-bottom: 0.5rem;">X</div>
                            <div style="font-size: 0.9rem; color: #666;">Extra Stiff</div>
                        </div>
                        <div style="text-align: center; padding: 1rem; background: white; border-radius: 8px;">
                            <div style="font-weight: 700; color: var(--deep-green); margin-bottom: 0.5rem;">TX</div>
                            <div style="font-size: 0.9rem; color: #666;">Tour Extra</div>
                        </div>
                    </div>
                    
                    <p style="margin: 0; color: #666; font-size: 0.9rem; font-style: italic;">After your fitting, you'll receive a final flex recommendation, shaft brand/model shortlist, grip size & brand recommendation, and optional build plan.</p>
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
                        <div style="display: flex; justify-content: space-between; align-items: center; font-size: 1.2rem; font-weight: 700; color: var(--deep-green);">
                            <span>Total:</span>
                            <span id="total">$0.00</span>
                        </div>
                    </div>
                    
                </div>
                
                <!-- Checkout Button (Outside sticky cart) -->
                <div style="margin-bottom: 2rem;">
                    <a href="<?= base_url('/cart') ?>" class="btn btn-primary" style="width: 100%; text-align: center; display: none;" id="checkout-btn">View Cart & Checkout</a>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// Cart functionality
let cart = JSON.parse(localStorage.getItem('golf_cart')) || [];

function changeRepairQuantity(serviceId, change) {
    const input = document.getElementById('qty-' + serviceId);
    const newValue = Math.max(0, parseInt(input.value) + change);
    input.value = newValue;
}

function addFittingToCart(serviceId, serviceName, price, duration) {
    // Check if fitting already exists in cart
    const existingFitting = cart.find(item => item.category === 'fitting');
    if (existingFitting) {
        if (confirm('You already have a fitting service in your cart. Replace it with this one?')) {
            cart = cart.filter(item => item.category !== 'fitting');
        } else {
            return;
        }
    }
    
    cart.push({
        id: serviceId,
        name: serviceName,
        price: price,
        unit: duration,
        quantity: 1,
        category: 'fitting'
    });
    
    localStorage.setItem('golf_cart', JSON.stringify(cart));
    
    // Trigger cart update event
    document.dispatchEvent(new CustomEvent('cartUpdated'));
    
    updateCartDisplay();
}

function addRepairToCart(serviceId, serviceName, price, unit) {
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
            category: 'repair'
        });
    }
    
    // Reset quantity
    document.getElementById('qty-' + serviceId).value = 0;
    
    // Save to localStorage
    localStorage.setItem('golf_cart', JSON.stringify(cart));
    
    // Trigger cart update event
    document.dispatchEvent(new CustomEvent('cartUpdated'));
    
    // Update display
    updateCartDisplay();
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
    
    // Update totals
    document.getElementById('subtotal').textContent = '$' + subtotal.toFixed(2);
    document.getElementById('total').textContent = '$' + subtotal.toFixed(2);
    
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
    
    // Trigger cart update event
    document.dispatchEvent(new CustomEvent('cartUpdated'));
    
    // Update display
    updateCartDisplay();
}

function removeFromCart(index) {
    cart.splice(index, 1);
    
    // Save to localStorage
    localStorage.setItem('golf_cart', JSON.stringify(cart));
    
    // Trigger cart update event
    document.dispatchEvent(new CustomEvent('cartUpdated'));
    
    // Update display
    updateCartDisplay();
}

// Initialize display
updateCartDisplay();

// No calendar functionality needed - appointments scheduled by phone after checkout
</script>

<!-- Policy Banner -->
<div style="background: var(--deep-green); color: white; text-align: center; padding: 0.75rem; font-weight: 600;">
    In-home workshop — No walk-ins. Call to book: <a href="tel:7173871643" style="color: white; text-decoration: underline;">(717) 387-1643</a>
</div>

<section class="section" style="margin-top: 120px;">
    <div class="container">
        <div class="section-header">
            <h1 class="section-title">Simulator</h1>
            <p class="section-subtitle">GC3 Foresight simulator rental with professional analysis</p>
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
        
        <!-- Simulator Info -->
        <div class="card" style="margin-bottom: 3rem; background: var(--light);">
            <h3 style="margin-bottom: 1.5rem; color: var(--deep-green);">GC3 Foresight Simulator</h3>
            <p style="margin-bottom: 2rem; font-size: 1.1rem;">Professional-grade launch monitor providing accurate ball flight data, club analysis, and course simulation.</p>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
                <div>
                    <h4 style="color: var(--deep-green); margin-bottom: 1rem;">What You Get</h4>
                    <ul style="list-style: none; padding: 0;">
                        <li style="margin-bottom: 0.5rem;">✓ Accurate ball flight tracking</li>
                        <li style="margin-bottom: 0.5rem;">✓ Club head speed & path analysis</li>
                        <li style="margin-bottom: 0.5rem;">✓ Launch angle & spin rate data</li>
                        <li style="margin-bottom: 0.5rem;">✓ Distance & carry measurements</li>
                        <li style="margin-bottom: 0.5rem;">✓ Course simulation (weather conditions)</li>
                        <li style="margin-bottom: 0.5rem;">✓ Practice range & target games</li>
                    </ul>
                </div>
                
                <div>
                    <h4 style="color: var(--deep-green); margin-bottom: 1rem;">Perfect For</h4>
                    <ul style="list-style: none; padding: 0;">
                        <li style="margin-bottom: 0.5rem;">✓ Winter practice sessions</li>
                        <li style="margin-bottom: 0.5rem;">✓ Club fitting & testing</li>
                        <li style="margin-bottom: 0.5rem;">✓ Swing analysis & improvement</li>
                        <li style="margin-bottom: 0.5rem;">✓ Fun with friends & family</li>
                        <li style="margin-bottom: 0.5rem;">✓ Weather-independent golf</li>
                        <li style="margin-bottom: 0.5rem;">✓ Course strategy practice</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Rental Options -->
        <div class="card" style="margin-bottom: 3rem;">
            <h3 style="margin-bottom: 1.5rem; color: var(--deep-green);">Select Rental Duration</h3>
            <p style="margin-bottom: 2rem; color: #666;">Choose your rental duration and add to cart. All rentals include setup, instruction, and cleanup.</p>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
                <div style="text-align: center; padding: 2rem; border: 2px solid var(--light); border-radius: 12px; background: white;">
                    <h4 style="color: var(--deep-green); margin-bottom: 1rem;">Hourly</h4>
                    <div style="font-size: 2.5rem; font-weight: 700; color: var(--deep-green); margin-bottom: 1rem;">
                        $<?= number_format($pricing['hourly'], 2) ?>/hr
                    </div>
                    <p style="color: #666; margin-bottom: 1.5rem;">Perfect for quick practice sessions or testing new clubs</p>
                    <ul style="list-style: none; padding: 0; text-align: left; margin-bottom: 2rem;">
                        <li style="margin-bottom: 0.5rem;">✓ 1 hour of simulator time</li>
                        <li style="margin-bottom: 0.5rem;">✓ Basic instruction included</li>
                        <li style="margin-bottom: 0.5rem;">✓ Data export available</li>
                    </ul>
                    <div style="display: flex; align-items: center; justify-content: center; gap: 1rem; margin-bottom: 1rem;">
                        <label style="font-weight: 600;">Hours:</label>
                        <input type="number" id="hourly-hours" min="1" max="8" value="1" style="width: 80px; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px; text-align: center;">
                    </div>
                    <button class="btn btn-primary rental-option-btn" data-type="hourly" data-duration="60" style="width: 100%;">Add to Cart</button>
                </div>
                
                <div style="text-align: center; padding: 2rem; border: 2px solid var(--deep-green); border-radius: 12px; background: var(--light); position: relative;">
                    <div style="position: absolute; top: -10px; left: 50%; transform: translateX(-50%); background: var(--deep-green); color: white; padding: 0.5rem 1rem; border-radius: 20px; font-size: 0.9rem; font-weight: 600;">
                        POPULAR
                    </div>
                    <h4 style="color: var(--deep-green); margin-bottom: 1rem;">Half-Day</h4>
                    <div style="font-size: 2.5rem; font-weight: 700; color: var(--deep-green); margin-bottom: 1rem;">
                        $<?= number_format($pricing['half_day'], 2) ?>
                    </div>
                    <p style="color: #666; margin-bottom: 1.5rem;"><?= $pricing['half_day_hours'] ?> hours - Great for group sessions</p>
                    <ul style="list-style: none; padding: 0; text-align: left; margin-bottom: 2rem;">
                        <li style="margin-bottom: 0.5rem;">✓ <?= $pricing['half_day_hours'] ?> hours of simulator time</li>
                        <li style="margin-bottom: 0.5rem;">✓ Full instruction & analysis</li>
                        <li style="margin-bottom: 0.5rem;">✓ Course selection included</li>
                        <li style="margin-bottom: 0.5rem;">✓ Data export & recommendations</li>
                    </ul>
                    <button class="btn btn-primary rental-option-btn" data-type="half-day" data-duration="240" style="width: 100%;">Add to Cart</button>
                </div>
                
                <div style="text-align: center; padding: 2rem; border: 2px solid var(--light); border-radius: 12px; background: white;">
                    <h4 style="color: var(--deep-green); margin-bottom: 1rem;">Full-Day</h4>
                    <div style="font-size: 2.5rem; font-weight: 700; color: var(--deep-green); margin-bottom: 1rem;">
                        $<?= number_format($pricing['full_day'], 2) ?>
                    </div>
                    <p style="color: #666; margin-bottom: 1.5rem;"><?= $pricing['full_day_hours'] ?> hours - Ultimate golf experience</p>
                    <ul style="list-style: none; padding: 0; text-align: left; margin-bottom: 2rem;">
                        <li style="margin-bottom: 0.5rem;">✓ <?= $pricing['full_day_hours'] ?> hours of simulator time</li>
                        <li style="margin-bottom: 0.5rem;">✓ Complete swing analysis</li>
                        <li style="margin-bottom: 0.5rem;">✓ Multiple course options</li>
                        <li style="margin-bottom: 0.5rem;">✓ Detailed performance report</li>
                        <li style="margin-bottom: 0.5rem;">✓ Lunch break included</li>
                    </ul>
                    <button class="btn btn-primary rental-option-btn" data-type="full-day" data-duration="480" style="width: 100%;">Add to Cart</button>
                </div>
            </div>
        </div>
        
        <!-- Policies -->
        <div class="card" style="margin-bottom: 3rem;">
            <h3 style="margin-bottom: 1.5rem; color: var(--deep-green);">Booking Policies</h3>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
                <div>
                    <h4 style="color: var(--deep-green); margin-bottom: 1rem;">24-Hour Notice Policy</h4>
                    <p style="margin-bottom: 1rem; color: #666;">All simulator rentals require 24-hour advance notice. No same-day online requests allowed.</p>
                    <ul style="list-style: none; padding: 0;">
                        <li style="margin-bottom: 0.5rem;">✓ Book at least 24 hours in advance</li>
                        <li style="margin-bottom: 0.5rem;">✓ Availability may vary if out of town</li>
                        <li style="margin-bottom: 0.5rem;">✓ Call to confirm availability</li>
                    </ul>
                </div>
                
                <div>
                    <h4 style="color: var(--deep-green); margin-bottom: 1rem;">Emergency Override</h4>
                    <p style="margin-bottom: 1rem; color: #666;">Same-day or closed slot bookings may be possible via admin override.</p>
                    <ul style="list-style: none; padding: 0;">
                        <li style="margin-bottom: 0.5rem;">✓ Call for emergency bookings</li>
                        <li style="margin-bottom: 0.5rem;">✓ Private link may be provided</li>
                        <li style="margin-bottom: 0.5rem;">✓ Subject to availability</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- What to Bring -->
        <div class="card" style="margin-bottom: 3rem;">
            <h3 style="margin-bottom: 1.5rem; color: var(--deep-green);">What to Bring</h3>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
                <div>
                    <h4 style="color: var(--deep-green); margin-bottom: 1rem;">Required</h4>
                    <ul style="list-style: none; padding: 0;">
                        <li style="margin-bottom: 0.5rem;">✓ Your golf clubs</li>
                        <li style="margin-bottom: 0.5rem;">✓ Golf shoes (or clean athletic shoes)</li>
                        <li style="margin-bottom: 0.5rem;">✓ Comfortable clothing</li>
                    </ul>
                </div>
                
                <div>
                    <h4 style="color: var(--deep-green); margin-bottom: 1rem;">Optional</h4>
                    <ul style="list-style: none; padding: 0;">
                        <li style="margin-bottom: 0.5rem;">✓ Water bottle</li>
                        <li style="margin-bottom: 0.5rem;">✓ Snacks</li>
                        <li style="margin-bottom: 0.5rem;">✓ Notebook for data</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- CTA Section -->
        <div style="text-align: center; background: linear-gradient(135deg, var(--deep-green) 0%, #0d2a5c 100%); color: white; padding: 3rem; border-radius: 12px;">
            <h2 style="color: white; margin-bottom: 1rem;">Ready to Practice Year-Round?</h2>
            <p style="margin-bottom: 2rem; color: rgba(255,255,255,0.9);">Call us to book your simulator session. Remember: 24-hour notice required.</p>
            <a href="tel:7173871643" class="btn btn-primary" style="font-size: 1.2rem; padding: 1rem 3rem; background: white; color: var(--deep-green); border: none;">
                📞 Call (717) 387-1643
            </a>
        </div>
    </div>
</section>

<script>
// Simplified cart functionality - no calendar/time selection needed
document.querySelectorAll('.rental-option-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const type = this.dataset.type;
        let duration, price, name;
        
        if (type === 'hourly') {
            const hours = parseInt(document.getElementById('hourly-hours').value);
            duration = `${hours} hour${hours > 1 ? 's' : ''}`;
            price = <?= $pricing['hourly'] ?> * hours;
            name = `Simulator Rental - ${duration}`;
        } else if (type === 'half-day') {
            duration = '4 hours (Half-Day)';
            price = <?= $pricing['half_day'] ?>;
            name = 'Simulator Rental - Half Day';
        } else if (type === 'full-day') {
            duration = '8 hours (Full-Day)';
            price = <?= $pricing['full_day'] ?>;
            name = 'Simulator Rental - Full Day';
        }
        
        // Get existing cart
        let cart = JSON.parse(localStorage.getItem('golf_cart')) || [];
        
        // Add to cart
        cart.push({
            id: 'simulator_' + Date.now(),
            name: name,
            price: price,
            unit: duration,
            quantity: 1,
            category: 'simulator'
        });
        
        // Save to localStorage
        localStorage.setItem('golf_cart', JSON.stringify(cart));
        
        // Show success message
        alert('Added to cart! Call (717) 387-1643 after checkout to schedule your appointment.');
        
        // Redirect to cart
        window.location.href = '<?= base_url('/cart') ?>';
    });
});
</script>

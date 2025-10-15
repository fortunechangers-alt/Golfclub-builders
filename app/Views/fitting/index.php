<!-- Policy Banner -->
<div class="policy-banner" style="background: var(--deep-green); color: white; text-align: center; padding: 0.75rem; font-weight: 600;">
    In-home workshop — No walk-ins. Call to book: <a href="tel:7173871643" style="color: white; text-decoration: underline;">(717) 387-1643</a>
</div>

<section class="section">
    <div class="container">
        <div class="section-header">
            <h1 class="section-title">Fitting</h1>
            <p class="section-subtitle">Professional shaft and grip fitting services</p>
        </div>
        
        <!-- Fitting Calculator -->
        <div class="club-building-grid" style="display: grid; grid-template-columns: 2fr 1fr; gap: 3rem;">
            <div>
                <div class="card" style="margin-bottom: 3rem; background: var(--light);">
                    <h3 style="margin-bottom: 1.5rem; color: var(--deep-green);">Service Calculator</h3>
                    <p style="margin-bottom: 2rem; color: #666;">Calculate your fitting and repair costs. All prices are labour only unless noted.</p>
                    
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
                        <div>
                            <h4 style="margin-bottom: 1rem;">Repairs & Adjustments</h4>
                    
                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Loft/Lie Adjustment</label>
                        <div style="display: flex; gap: 0.5rem; align-items: center;">
                            <input type="number" id="loft-lie-count" min="0" value="0" style="width: 80px; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
                            <span>clubs × $<span id="loft-lie-price">5.00</span></span>
                        </div>
                    </div>
                    
                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Swing Weight - Standard</label>
                        <div style="display: flex; gap: 0.5rem; align-items: center;">
                            <input type="number" id="swing-weight-std-count" min="0" value="0" style="width: 80px; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
                            <span>clubs × $<span id="swing-weight-std-price">10.00</span></span>
                        </div>
                    </div>
                    
                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Shaft Pull (Adapter Only)</label>
                        <div style="display: flex; gap: 0.5rem; align-items: center;">
                            <input type="number" id="shaft-pull-count" min="0" value="0" style="width: 80px; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
                            <span>clubs × $<span id="shaft-pull-price">9.99</span></span>
                        </div>
                    </div>
                </div>
                
                <div>
                    <h4 style="margin-bottom: 1rem;">Shaft Modifications</h4>
                    
                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Shorten Shaft</label>
                        <div style="display: flex; gap: 0.5rem; align-items: center;">
                            <input type="number" id="shorten-count" min="0" value="0" style="width: 80px; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
                            <span>clubs × $<span id="shorten-price">6.00</span></span>
                        </div>
                    </div>
                    
                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Lengthen Shaft (Labour)</label>
                        <div style="display: flex; gap: 0.5rem; align-items: center;">
                            <input type="number" id="lengthen-count" min="0" value="0" style="width: 80px; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
                            <span>clubs × $<span id="lengthen-price">6.00</span></span>
                        </div>
                    </div>
                    
                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Reinstall Shaft</label>
                        <div style="display: flex; gap: 0.5rem; align-items: center;">
                            <input type="number" id="reinstall-count" min="0" value="0" style="width: 80px; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
                            <span>clubs × $<span id="reinstall-price">15.00</span></span>
                        </div>
                    </div>
                </div>
            </div>
                </div>
            </div>
            
            <!-- Cart/Total Sidebar -->
            <div>
                <div class="card" style="position: sticky; top: 140px; z-index: 10;">
                    <h3 style="margin-bottom: 1.5rem; color: var(--deep-green);">Total Labour Cost</h3>
                    
                    <div style="background: white; padding: 1.5rem; border-radius: 8px; border: 2px solid var(--deep-green);">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <h3 style="margin: 0; color: var(--deep-green);">Total:</h3>
                            <h2 style="margin: 0; color: var(--deep-green);" id="total-cost">$0.00</h2>
                        </div>
                        <p style="margin: 0.5rem 0 0 0; color: #666; font-size: 0.9rem;">Extensions and grips not included in total</p>
                    </div>
                </div>
                
                <!-- Same-Day Service Notice Sidebar -->
                <div class="card" id="emergency-card" style="position: sticky; top: 140px; margin-top: 2rem; background: linear-gradient(135deg, #ff6b6b, #ee5a52); color: white; border: none; z-index: 5; padding: 1.5rem;">
                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 0.75rem;">
                        <input type="checkbox" id="rush-toggle" style="transform: scale(1.3); cursor: pointer; flex-shrink: 0;">
                        <label for="rush-toggle" style="font-weight: 700; color: white; cursor: pointer; flex: 1; font-size: 1rem; margin: 0;">
                            🚨 Same-Day Service (+50%)
                        </label>
                    </div>
                    <p style="margin: 0; color: rgba(255,255,255,0.9); font-size: 0.8rem; line-height: 1.4;">
                        ASAP same-day/next-day service. Call <a href="tel:7173871643" style="color: white; text-decoration: underline; font-weight: 600;">(717) 387-1643</a> to confirm.
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Fitting Scope -->
        <div class="card" style="margin-bottom: 3rem; background: var(--light);">
            <h3 style="margin-bottom: 1.5rem; color: var(--deep-green);">What We Do</h3>
            <p style="margin-bottom: 1.5rem; font-size: 1.1rem;">Our fitting service determines the optimal shaft stiffness (including TX flex), shortlists shaft brands/models, and recommends grip size & brand based on your swing characteristics.</p>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem;">
                <div>
                    <h4 style="color: var(--deep-green); margin-bottom: 1rem;">How We Decide</h4>
                    <ul style="list-style: none; padding: 0;">
                        <li style="margin-bottom: 0.5rem;">✓ Swing speed + tempo (smooth vs aggressive)</li>
                        <li style="margin-bottom: 0.5rem;">✓ Launch/spin tendencies (flight windows)</li>
                        <li style="margin-bottom: 0.5rem;">✓ Strike pattern / lie angle (centered contact)</li>
                        <li style="margin-bottom: 0.5rem;">✓ Feel and grip size (hand size, brand preference)</li>
                    </ul>
                </div>
                
                <div>
                    <h4 style="color: var(--deep-green); margin-bottom: 1rem;">Deliverables</h4>
                    <ul style="list-style: none; padding: 0;">
                        <li style="margin-bottom: 0.5rem;">✓ Final flex and shaft brand/model shortlist (2–3 options)</li>
                        <li style="margin-bottom: 0.5rem;">✓ Grip size & brand recommendation</li>
                        <li style="margin-bottom: 0.5rem;">✓ Optional build plan (per club or set)</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Shaft Flex Guide -->
        <div class="card" style="margin-bottom: 3rem;">
            <h3 style="margin-bottom: 1.5rem; color: var(--deep-green);">Shaft Stiffness Profile (Including TX)</h3>
            <p style="margin-bottom: 2rem; color: #666;">Understanding shaft flex codes and typical guidance (not a rule):</p>
            
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: var(--light);">
                            <th style="padding: 1rem; text-align: left; border-bottom: 2px solid var(--deep-green);">Flex Code</th>
                            <th style="padding: 1rem; text-align: left; border-bottom: 2px solid var(--deep-green);">Name</th>
                            <th style="padding: 1rem; text-align: left; border-bottom: 2px solid var(--deep-green);">Typical Guidance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($flex_codes as $code => $info): ?>
                        <tr>
                            <td style="padding: 1rem; border-bottom: 1px solid #eee; font-weight: 700; color: var(--deep-green);"><?= $code ?></td>
                            <td style="padding: 1rem; border-bottom: 1px solid #eee;"><?= $info['name'] ?></td>
                            <td style="padding: 1rem; border-bottom: 1px solid #eee;"><?= $info['description'] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Repairs & Adjustments -->
        <div class="card" style="margin-bottom: 3rem;">
            <h3 style="margin-bottom: 1.5rem; color: var(--deep-green);">Repairs & Adjustments</h3>
            <p style="margin-bottom: 2rem; color: #666;">Professional repair and adjustment services for your clubs.</p>
            
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: var(--light);">
                            <th style="padding: 1rem; text-align: left; border-bottom: 2px solid var(--deep-green);">Service</th>
                            <th style="padding: 1rem; text-align: center; border-bottom: 2px solid var(--deep-green);">Standard</th>
                            <th style="padding: 1rem; text-align: center; border-bottom: 2px solid var(--deep-green);">Rush</th>
                            <th style="padding: 1rem; text-align: left; border-bottom: 2px solid var(--deep-green);">Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding: 1rem; border-bottom: 1px solid #eee;">Loft/Lie adjustment (per club)</td>
                            <td style="padding: 1rem; text-align: center; border-bottom: 1px solid #eee;">$<?= number_format($repair_pricing['loft_lie']['standard'], 2) ?></td>
                            <td style="padding: 1rem; text-align: center; border-bottom: 1px solid #eee;">$<?= number_format($repair_pricing['loft_lie']['rush'], 2) ?></td>
                            <td style="padding: 1rem; border-bottom: 1px solid #eee;">8-club set: $<?= $repair_pricing['loft_lie']['set_8'][0] ?> / $<?= $repair_pricing['loft_lie']['set_8'][1] ?></td>
                        </tr>
                        <tr>
                            <td style="padding: 1rem; border-bottom: 1px solid #eee;">Swing-Weight — Standard</td>
                            <td style="padding: 1rem; text-align: center; border-bottom: 1px solid #eee;">$<?= number_format($repair_pricing['swing_weight_standard']['standard'], 2) ?></td>
                            <td style="padding: 1rem; text-align: center; border-bottom: 1px solid #eee;">$<?= number_format($repair_pricing['swing_weight_standard']['rush'], 2) ?></td>
                            <td style="padding: 1rem; border-bottom: 1px solid #eee;">—</td>
                        </tr>
                        <tr>
                            <td style="padding: 1rem; border-bottom: 1px solid #eee;">Swing-Weight — Premium (Tour Lock)</td>
                            <td style="padding: 1rem; text-align: center; border-bottom: 1px solid #eee;">$<?= number_format($repair_pricing['swing_weight_premium']['standard'], 2) ?></td>
                            <td style="padding: 1rem; text-align: center; border-bottom: 1px solid #eee;">$<?= number_format($repair_pricing['swing_weight_premium']['rush'], 2) ?></td>
                            <td style="padding: 1rem; border-bottom: 1px solid #eee;"><?= $repair_pricing['swing_weight_premium']['note'] ?></td>
                        </tr>
                        <tr>
                            <td style="padding: 1rem; border-bottom: 1px solid #eee;">Shorten shaft (labour)</td>
                            <td style="padding: 1rem; text-align: center; border-bottom: 1px solid #eee;">$<?= number_format($repair_pricing['shorten_shaft']['standard'], 2) ?></td>
                            <td style="padding: 1rem; text-align: center; border-bottom: 1px solid #eee;">$<?= number_format($repair_pricing['shorten_shaft']['rush'], 2) ?></td>
                            <td style="padding: 1rem; border-bottom: 1px solid #eee;">—</td>
                        </tr>
                        <tr>
                            <td style="padding: 1rem; border-bottom: 1px solid #eee;">Lengthen shaft (labour)</td>
                            <td style="padding: 1rem; text-align: center; border-bottom: 1px solid #eee;">$<?= number_format($repair_pricing['lengthen_shaft']['standard'], 2) ?></td>
                            <td style="padding: 1rem; text-align: center; border-bottom: 1px solid #eee;">$<?= number_format($repair_pricing['lengthen_shaft']['rush'], 2) ?></td>
                            <td style="padding: 1rem; border-bottom: 1px solid #eee;"><?= $repair_pricing['lengthen_shaft']['note'] ?></td>
                        </tr>
                        <tr>
                            <td style="padding: 1rem; border-bottom: 1px solid #eee;">Lengthen shaft (incl. basic grip)</td>
                            <td style="padding: 1rem; text-align: center; border-bottom: 1px solid #eee;">$<?= number_format($repair_pricing['lengthen_with_grip']['standard'], 2) ?></td>
                            <td style="padding: 1rem; text-align: center; border-bottom: 1px solid #eee;">$<?= number_format($repair_pricing['lengthen_with_grip']['rush'], 2) ?></td>
                            <td style="padding: 1rem; border-bottom: 1px solid #eee;"><?= $repair_pricing['lengthen_with_grip']['note'] ?></td>
                        </tr>
                        <tr>
                            <td style="padding: 1rem; border-bottom: 1px solid #eee;">Shaft pull — adapter only</td>
                            <td style="padding: 1rem; text-align: center; border-bottom: 1px solid #eee;">$<?= number_format($repair_pricing['shaft_pull']['standard'], 2) ?></td>
                            <td style="padding: 1rem; text-align: center; border-bottom: 1px solid #eee;">$<?= number_format($repair_pricing['shaft_pull']['rush'], 2) ?></td>
                            <td style="padding: 1rem; border-bottom: 1px solid #eee;"><?= $repair_pricing['shaft_pull']['note'] ?></td>
                        </tr>
                        <tr>
                            <td style="padding: 1rem; border-bottom: 1px solid #eee;">Reinstall shaft (reset loose head)</td>
                            <td style="padding: 1rem; text-align: center; border-bottom: 1px solid #eee;">$<?= number_format($repair_pricing['reinstall_shaft']['standard'], 2) ?></td>
                            <td style="padding: 1rem; text-align: center; border-bottom: 1px solid #eee;">$<?= number_format($repair_pricing['reinstall_shaft']['rush'], 2) ?></td>
                            <td style="padding: 1rem; border-bottom: 1px solid #eee;"><?= $repair_pricing['reinstall_shaft']['note'] ?></td>
                        </tr>
                        <tr>
                            <td style="padding: 1rem;">Install new shaft adapter — Labour</td>
                            <td style="padding: 1rem; text-align: center;">$<?= number_format($repair_pricing['adapter_install']['standard'], 2) ?></td>
                            <td style="padding: 1rem; text-align: center;">$<?= number_format($repair_pricing['adapter_install']['rush'], 2) ?></td>
                            <td style="padding: 1rem;"><?= $repair_pricing['adapter_install']['note'] ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- CTA Section -->
        <div style="text-align: center; background: linear-gradient(135deg, var(--deep-green) 0%, #0d2a5c 100%); color: white; padding: 3rem; border-radius: 12px;">
            <h2 style="color: white; margin-bottom: 1rem;">Ready for Professional Fitting?</h2>
            <p style="margin-bottom: 2rem; color: rgba(255,255,255,0.9);">Call us to schedule your fitting session and discover your optimal shaft and grip setup.</p>
            <a href="tel:7173871643" class="btn btn-primary" style="font-size: 1.2rem; padding: 1rem 3rem; background: white; color: var(--deep-green); border: none;">
                📞 Call (717) 387-1643
            </a>
        </div>
    </div>
</section>

<script>
// Fitting Service Calculator JavaScript
const rushMultiplier = 1.5;

function updatePrices() {
    const isRush = document.getElementById('rush-toggle').checked;
    const multiplier = isRush ? rushMultiplier : 1;
    
    // Update displayed prices
    document.getElementById('loft-lie-price').textContent = (5.00 * multiplier).toFixed(2);
    document.getElementById('swing-weight-std-price').textContent = (10.00 * multiplier).toFixed(2);
    document.getElementById('shaft-pull-price').textContent = (9.99 * multiplier).toFixed(2);
    document.getElementById('shorten-price').textContent = (6.00 * multiplier).toFixed(2);
    document.getElementById('lengthen-price').textContent = (6.00 * multiplier).toFixed(2);
    document.getElementById('reinstall-price').textContent = (15.00 * multiplier).toFixed(2);
    
    calculateTotal();
}

function calculateTotal() {
    const isRush = document.getElementById('rush-toggle').checked;
    const multiplier = isRush ? rushMultiplier : 1;
    
    const loftLieCount = parseInt(document.getElementById('loft-lie-count').value) || 0;
    const swingWeightCount = parseInt(document.getElementById('swing-weight-std-count').value) || 0;
    const shaftPullCount = parseInt(document.getElementById('shaft-pull-count').value) || 0;
    const shortenCount = parseInt(document.getElementById('shorten-count').value) || 0;
    const lengthenCount = parseInt(document.getElementById('lengthen-count').value) || 0;
    const reinstallCount = parseInt(document.getElementById('reinstall-count').value) || 0;
    
    const total = (loftLieCount * 5.00 + swingWeightCount * 10.00 + shaftPullCount * 9.99 + 
                  shortenCount * 6.00 + lengthenCount * 6.00 + reinstallCount * 15.00) * multiplier;
    
    document.getElementById('total-cost').textContent = '$' + total.toFixed(2);
}

// Add event listeners
document.getElementById('rush-toggle').addEventListener('change', updatePrices);
document.querySelectorAll('input[type="number"]').forEach(input => {
    input.addEventListener('input', calculateTotal);
});

// Initialize
updatePrices();

// Dynamic sticky positioning for emergency card
function updateEmergencyCardPosition() {
    const cartCard = document.querySelector('.card[style*="position: sticky"]');
    const emergencyCard = document.getElementById('emergency-card');
    
    if (cartCard && emergencyCard) {
        const cartHeight = cartCard.offsetHeight;
        emergencyCard.style.top = `${140 + cartHeight + 32}px`; // 140px base + cart height + 2rem gap (32px)
    }
}

// Update position on load and when window resizes
updateEmergencyCardPosition();
window.addEventListener('resize', updateEmergencyCardPosition);

// Also update position when calculator values change
const originalUpdatePrices = updatePrices;
updatePrices = function() {
    originalUpdatePrices();
    setTimeout(updateEmergencyCardPosition, 50); // Small delay to let DOM update
};
</script>

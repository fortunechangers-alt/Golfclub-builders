<!-- Policy Banner -->
<div style="background: var(--deep-green); color: white; text-align: center; padding: 0.75rem; font-weight: 600;">
    In-home workshop — No walk-ins. Call to book: <a href="tel:7173871643" style="color: white; text-decoration: underline;">(717) 387-1643</a>
</div>

<section class="section" style="margin-top: 120px;">
    <div class="container">
        <div class="section-header">
            <h1 class="section-title">Club Builds</h1>
            <p class="section-subtitle">Professional club building services with precision and care</p>
        </div>
        
        <!-- Build Calculator -->
        <div class="card" style="margin-bottom: 3rem; background: var(--light);">
            <h3 style="margin-bottom: 1.5rem; color: var(--deep-green);">Build Calculator</h3>
            <p style="margin-bottom: 2rem; color: #666;">Calculate your build costs. All prices are labour only unless noted.</p>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
                <div>
                    <h4 style="margin-bottom: 1rem;">Club Builds</h4>
                    
                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Iron Shaft Installation</label>
                        <div style="display: flex; gap: 0.5rem; align-items: center;">
                            <input type="number" id="iron-count" min="0" value="0" style="width: 80px; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
                            <span>clubs × $<span id="iron-price">21.99</span></span>
                        </div>
                    </div>
                    
                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Metalwood/Hybrid Installation</label>
                        <div style="display: flex; gap: 0.5rem; align-items: center;">
                            <input type="number" id="metalwood-count" min="0" value="0" style="width: 80px; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
                            <span>clubs × $<span id="metalwood-price">24.99</span></span>
                        </div>
                    </div>
                    
                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Shaft Adapter Installation</label>
                        <div style="display: flex; gap: 0.5rem; align-items: center;">
                            <input type="number" id="adapter-count" min="0" value="0" style="width: 80px; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
                            <span>adapters × $<span id="adapter-price">17.99</span></span>
                        </div>
                    </div>
                    
                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Old Club Polishing</label>
                        <div style="display: flex; gap: 0.5rem; align-items: center;">
                            <input type="number" id="polish-count" min="0" value="0" style="width: 80px; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
                            <span>clubs × $<span id="polish-price">20.00</span></span>
                        </div>
                    </div>
                </div>
                
                <div>
                    <h4 style="margin-bottom: 1rem;">Regrips</h4>
                    
                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Grip Installation (Bring Your Grips)</label>
                        <div style="display: flex; gap: 0.5rem; align-items: center;">
                            <input type="number" id="grip-bring-count" min="0" value="0" style="width: 80px; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
                            <span>clubs × $<span id="grip-bring-price">3.99</span></span>
                        </div>
                    </div>
                    
                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Grip Installation (With Grip Purchase)</label>
                        <div style="display: flex; gap: 0.5rem; align-items: center;">
                            <input type="number" id="grip-with-count" min="0" value="0" style="width: 80px; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
                            <span>clubs × $<span id="grip-with-price">3.99</span> + grip cost</span>
                        </div>
                    </div>
                    
                    <div style="margin-bottom: 1rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Save & Reinstall Old Grip</label>
                        <div style="display: flex; gap: 0.5rem; align-items: center;">
                            <input type="number" id="grip-save-count" min="0" value="0" style="width: 80px; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px;">
                            <span>clubs × $<span id="grip-save-price">7.99</span></span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div style="margin-top: 2rem; padding-top: 2rem; border-top: 2px solid var(--deep-green);">
                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                    <input type="checkbox" id="rush-toggle" style="transform: scale(1.2);">
                    <label for="rush-toggle" style="font-weight: 600; color: var(--deep-green);">Emergency/Rush Service (+50% on labour)</label>
                </div>
                
                <div style="background: white; padding: 1.5rem; border-radius: 8px; border: 2px solid var(--deep-green);">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <h3 style="margin: 0; color: var(--deep-green);">Total Labour Cost:</h3>
                        <h2 style="margin: 0; color: var(--deep-green);" id="total-cost">$0.00</h2>
                    </div>
                    <p style="margin: 0.5rem 0 0 0; color: #666; font-size: 0.9rem;">Parts and grips not included in total</p>
                </div>
            </div>
        </div>
        
        <!-- Pricing Tables -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 2rem; margin-bottom: 3rem;">
            <!-- Club Builds Table -->
            <div class="card">
                <h3 style="margin-bottom: 1.5rem; color: var(--deep-green);">Club Builds</h3>
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background: var(--light);">
                                <th style="padding: 1rem; text-align: left; border-bottom: 2px solid var(--deep-green);">Task</th>
                                <th style="padding: 1rem; text-align: center; border-bottom: 2px solid var(--deep-green);">Standard</th>
                                <th style="padding: 1rem; text-align: center; border-bottom: 2px solid var(--deep-green);">Rush</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="padding: 1rem; border-bottom: 1px solid #eee;">Install head on new shaft — Iron</td>
                                <td style="padding: 1rem; text-align: center; border-bottom: 1px solid #eee;">$24.00</td>
                                <td style="padding: 1rem; text-align: center; border-bottom: 1px solid #eee;">$36.00</td>
                            </tr>
                            <tr>
                                <td style="padding: 1rem; border-bottom: 1px solid #eee;">Install head on new shaft — Metalwood/Hybrid</td>
                                <td style="padding: 1rem; text-align: center; border-bottom: 1px solid #eee;">$28.00</td>
                                <td style="padding: 1rem; text-align: center; border-bottom: 1px solid #eee;">$42.00</td>
                            </tr>
                            <tr>
                                <td style="padding: 1rem; border-bottom: 1px solid #eee;">Install new shaft adapter — Labour</td>
                                <td style="padding: 1rem; text-align: center; border-bottom: 1px solid #eee;">$24.00</td>
                                <td style="padding: 1rem; text-align: center; border-bottom: 1px solid #eee;">$36.00</td>
                            </tr>
                            <tr>
                                <td style="padding: 1rem;">Old club polishing</td>
                                <td style="padding: 1rem; text-align: center;">$20.00/club</td>
                                <td style="padding: 1rem; text-align: center;">$30.00/club</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <p style="margin-top: 1rem; color: #666; font-size: 0.9rem;">Set builds: price by per-club labour × quantity (rush toggle if applicable)</p>
            </div>
            
            <!-- Regrips Table -->
            <div class="card">
                <h3 style="margin-bottom: 1.5rem; color: var(--deep-green);">Regrips & Grip Prices</h3>
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background: var(--light);">
                                <th style="padding: 1rem; text-align: left; border-bottom: 2px solid var(--deep-green);">Service</th>
                                <th style="padding: 1rem; text-align: center; border-bottom: 2px solid var(--deep-green);">Standard</th>
                                <th style="padding: 1rem; text-align: center; border-bottom: 2px solid var(--deep-green);">Rush</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="padding: 1rem; border-bottom: 1px solid #eee;">Grip installation (labour only)</td>
                                <td style="padding: 1rem; text-align: center; border-bottom: 1px solid #eee;">$3.99/club</td>
                                <td style="padding: 1rem; text-align: center; border-bottom: 1px solid #eee;">$5.99/club</td>
                            </tr>
                            <tr>
                                <td style="padding: 1rem; border-bottom: 1px solid #eee;">Grip installation (with grip purchase)</td>
                                <td style="padding: 1rem; text-align: center; border-bottom: 1px solid #eee;">$3.99 + grip</td>
                                <td style="padding: 1rem; text-align: center; border-bottom: 1px solid #eee;">$5.99 + grip</td>
                            </tr>
                            <tr>
                                <td style="padding: 1rem;">Save & reinstall old grip</td>
                                <td style="padding: 1rem; text-align: center;">$7.99</td>
                                <td style="padding: 1rem; text-align: center;">$11.99</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div style="margin-top: 1.5rem;">
                    <h4 style="margin-bottom: 1rem; color: var(--deep-green);">Grip Tiers (Examples)</h4>
                    <div style="display: grid; gap: 0.5rem;">
                        <div style="display: flex; justify-content: space-between; padding: 0.5rem; background: var(--light); border-radius: 4px;">
                            <span><strong>Basic:</strong> Tour Velvet-style</span>
                            <span>$8–$12</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; padding: 0.5rem; background: var(--light); border-radius: 4px;">
                            <span><strong>Mid:</strong> Multi-compound/Cord</span>
                            <span>$13–$19</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; padding: 0.5rem; background: var(--light); border-radius: 4px;">
                            <span><strong>Premium/Putter:</strong> High-end grips</span>
                            <span>$20–$35+</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- CTA Section -->
        <div style="text-align: center; background: linear-gradient(135deg, var(--deep-green) 0%, #0d2a5c 100%); color: white; padding: 3rem; border-radius: 12px;">
            <h2 style="color: white; margin-bottom: 1rem;">Ready to Build Your Perfect Clubs?</h2>
            <p style="margin-bottom: 2rem; color: rgba(255,255,255,0.9);">Call us to discuss your project and get a detailed quote.</p>
            <a href="tel:7173871643" class="btn btn-primary" style="font-size: 1.2rem; padding: 1rem 3rem; background: white; color: var(--deep-green); border: none;">
                📞 Call (717) 387-1643
            </a>
        </div>
    </div>
</section>

<script>
// Build Calculator JavaScript
const pricing = <?= json_encode($pricing) ?>;
const rushMultiplier = pricing.rush_multiplier;

function updatePrices() {
    const isRush = document.getElementById('rush-toggle').checked;
    const multiplier = isRush ? rushMultiplier : 1;
    
    // Update displayed prices
    document.getElementById('iron-price').textContent = (21.99 * multiplier).toFixed(2);
    document.getElementById('metalwood-price').textContent = (24.99 * multiplier).toFixed(2);
    document.getElementById('adapter-price').textContent = (17.99 * multiplier).toFixed(2);
    document.getElementById('polish-price').textContent = (20.00 * multiplier).toFixed(2);
    document.getElementById('grip-bring-price').textContent = (3.99 * multiplier).toFixed(2);
    document.getElementById('grip-with-price').textContent = (3.99 * multiplier).toFixed(2);
    document.getElementById('grip-save-price').textContent = (7.99 * multiplier).toFixed(2);
    
    calculateTotal();
}

function calculateTotal() {
    const isRush = document.getElementById('rush-toggle').checked;
    const multiplier = isRush ? rushMultiplier : 1;
    
    const ironCount = parseInt(document.getElementById('iron-count').value) || 0;
    const metalwoodCount = parseInt(document.getElementById('metalwood-count').value) || 0;
    const adapterCount = parseInt(document.getElementById('adapter-count').value) || 0;
    const polishCount = parseInt(document.getElementById('polish-count').value) || 0;
    const gripBringCount = parseInt(document.getElementById('grip-bring-count').value) || 0;
    const gripWithCount = parseInt(document.getElementById('grip-with-count').value) || 0;
    const gripSaveCount = parseInt(document.getElementById('grip-save-count').value) || 0;
    
    const total = (ironCount * 21.99 + metalwoodCount * 24.99 + adapterCount * 17.99 + 
                  polishCount * 20.00 + gripBringCount * 3.99 + gripWithCount * 3.99 + 
                  gripSaveCount * 7.99) * multiplier;
    
    document.getElementById('total-cost').textContent = '$' + total.toFixed(2);
}

// Add event listeners
document.getElementById('rush-toggle').addEventListener('change', updatePrices);
document.querySelectorAll('input[type="number"]').forEach(input => {
    input.addEventListener('input', calculateTotal);
});

// Initialize
updatePrices();
</script>

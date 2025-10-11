<!-- Policy Banner -->
<div style="background: var(--deep-green); color: white; text-align: center; padding: 0.75rem; font-weight: 600;">
    In-home workshop — No walk-ins. Call to book: <a href="tel:7173871643" style="color: white; text-decoration: underline;">(717) 387-1643</a>
</div>

<section class="section" style="margin-top: 120px;">
    <div class="container">
        <div class="section-header">
            <h1 class="section-title">Fitting</h1>
            <p class="section-subtitle">Professional shaft and grip fitting services</p>
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

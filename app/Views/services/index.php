<section class="section" style="margin-top: 120px;">
    <div class="container">
        <div class="section-header">
            <h1 class="section-title">Our Services</h1>
            <p class="section-subtitle">Professional golf services powered by cutting-edge technology</p>
        </div>
        
        <div class="services-grid">
            <!-- AI Club Fitting -->
            <div class="card service-card">
                <div class="service-icon">🎯</div>
                <h3>AI Club Fitting</h3>
                <p>Experience the future of club fitting with our revolutionary AI-powered analysis system. We measure over 100 data points including club head speed, attack angle, ball speed, spin rate, and launch angle to provide scientifically-backed recommendations.</p>
                
                <div style="margin: 2rem 0; text-align: left;">
                    <h4 style="margin-bottom: 1rem;">What's Included:</h4>
                    <ul style="list-style: none; padding: 0;">
                        <li style="margin-bottom: 0.5rem;">✓ Comprehensive swing analysis</li>
                        <li style="margin-bottom: 0.5rem;">✓ AI-powered club recommendations</li>
                        <li style="margin-bottom: 0.5rem;">✓ Driver, fairway woods, and iron fitting</li>
                        <li style="margin-bottom: 0.5rem;">✓ Shaft optimization</li>
                        <li style="margin-bottom: 0.5rem;">✓ Detailed performance report</li>
                        <li style="margin-bottom: 0.5rem;">✓ 90 minutes session</li>
                    </ul>
                </div>
                
                <p style="font-size: 2rem; font-weight: 700; color: var(--golf-green); margin: 1rem 0;">$199</p>
                <a href="<?= base_url('/booking?service=ai-fitting') ?>" class="btn btn-primary" style="width: 100%;">Book AI Fitting</a>
            </div>
            
            <!-- Professional Regripping -->
            <div class="card service-card">
                <div class="service-icon" style="background: linear-gradient(135deg, var(--gold), #e6c45c);">🏌️</div>
                <h3>Professional Regripping</h3>
                <p>Enhance your control and comfort with professionally installed grips. We offer a wide selection of premium grips from all major manufacturers, installed with precision and care by our expert technicians.</p>
                
                <div style="margin: 2rem 0; text-align: left;">
                    <h4 style="margin-bottom: 1rem;">What's Included:</h4>
                    <ul style="list-style: none; padding: 0;">
                        <li style="margin-bottom: 0.5rem;">✓ Expert grip consultation</li>
                        <li style="margin-bottom: 0.5rem;">✓ Professional installation</li>
                        <li style="margin-bottom: 0.5rem;">✓ Choice of premium grips</li>
                        <li style="margin-bottom: 0.5rem;">✓ Proper sizing and alignment</li>
                        <li style="margin-bottom: 0.5rem;">✓ Same-day service available</li>
                        <li style="margin-bottom: 0.5rem;">✓ 30 minutes per club</li>
                    </ul>
                </div>
                
                <p style="font-size: 2rem; font-weight: 700; color: var(--gold); margin: 1rem 0;">$49</p>
                <p style="font-size: 0.9rem; color: #666;">+ grip cost</p>
                <a href="<?= base_url('/booking?service=regripping') ?>" class="btn btn-primary" style="width: 100%;">Book Regripping</a>
            </div>
            
            <!-- Custom Club Building -->
            <div class="card service-card">
                <div class="service-icon" style="background: linear-gradient(135deg, var(--navy-blue), #1a3a6b);">⚙️</div>
                <h3>Custom Club Building</h3>
                <p>Build your dream clubs from the ground up. Our master club builders work with you to select the perfect combination of components, ensuring every club is precisely matched to your swing and preferences.</p>
                
                <div style="margin: 2rem 0; text-align: left;">
                    <h4 style="margin-bottom: 1rem;">What's Included:</h4>
                    <ul style="list-style: none; padding: 0;">
                        <li style="margin-bottom: 0.5rem;">✓ Personal consultation</li>
                        <li style="margin-bottom: 0.5rem;">✓ Component selection (heads, shafts, grips)</li>
                        <li style="margin-bottom: 0.5rem;">✓ Precise assembly and testing</li>
                        <li style="margin-bottom: 0.5rem;">✓ Swing weight matching</li>
                        <li style="margin-bottom: 0.5rem;">✓ Custom specifications</li>
                        <li style="margin-bottom: 0.5rem;">✓ Performance validation</li>
                    </ul>
                </div>
                
                <p style="font-size: 2rem; font-weight: 700; color: var(--navy-blue); margin: 1rem 0;">Starting at $299</p>
                <a href="<?= base_url('/contact') ?>" class="btn btn-primary" style="width: 100%;">Request Quote</a>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Our Services Section -->
<section class="section section-light">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">The Golf Builders Difference</h2>
        </div>
        
        <div class="services-grid" style="grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));">
            <div class="card">
                <h4>🔬 Scientific Approach</h4>
                <p>Our AI system provides objective, data-driven insights that eliminate guesswork from the fitting process.</p>
            </div>
            
            <div class="card">
                <h4>🏆 Certified Experts</h4>
                <p>All our technicians are certified club fitters with years of experience working with golfers of all skill levels.</p>
            </div>
            
            <div class="card">
                <h4>⚡ Fast Turnaround</h4>
                <p>Most services completed same-day or within 24 hours, so you can get back on the course quickly.</p>
            </div>
            
            <div class="card">
                <h4>💯 Satisfaction Guarantee</h4>
                <p>We stand behind our work. If you're not satisfied, we'll make it right - no questions asked.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section" style="background: linear-gradient(135deg, var(--navy-blue) 0%, #0d2a5c 100%); color: white;">
    <div class="container" style="text-align: center;">
        <h2 style="color: white; font-size: 2.5rem; margin-bottom: 1.5rem;">Ready to Get Started?</h2>
        <p style="font-size: 1.2rem; margin-bottom: 2rem; color: rgba(255,255,255,0.9);">Book your appointment today and experience the Golf Builders difference.</p>
        <a href="<?= base_url('/booking') ?>" class="btn btn-primary" style="font-size: 1.2rem; padding: 1rem 3rem;">Book Now</a>
    </div>
</section>


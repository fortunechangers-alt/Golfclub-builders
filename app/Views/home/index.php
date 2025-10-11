<!-- Policy Banner -->
<div style="background: var(--deep-green); color: white; text-align: center; padding: 0.75rem; font-weight: 600;">
    In-home workshop — No walk-ins. Call to book: <a href="tel:7173871643" style="color: white; text-decoration: underline;">(717) 387-1643</a>
</div>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-container">
        <div class="hero-content">
            <h1>Precision. Performance.<br><span class="highlight" style="color: var(--gold);">Every Swing.</span></h1>
            <p>Professional club building, fitting, and simulator services. In-home workshop serving Chambersburg and surrounding areas.</p>
            <div class="hero-cta">
                <a href="tel:7173871643" class="btn btn-primary">📞 Call (717) 387-1643</a>
                <a href="<?= base_url('/club-builds') ?>" class="btn btn-outline">Club Builds</a>
            </div>
        </div>
        <div class="hero-image">
            <img src="<?= base_url('images/hero-golf.jpg') ?>" alt="Golf Club Fitting" onerror="this.src='https://images.unsplash.com/photo-1587174486073-ae5e5cff23aa?w=800&q=80'">
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Our Services</h2>
            <p class="section-subtitle">Elevate your golf game with our professional services</p>
        </div>
        
        <div class="services-grid">
            <div class="card service-card">
                <div class="service-icon" style="background: linear-gradient(135deg, var(--deep-green), #0d2a5c);">⚙️</div>
                <h3>Custom Club Building</h3>
                <p>Complete custom club building service from shaft selection to final assembly. Each club meticulously crafted to your exact specifications.</p>
                <p><strong>Starting at $24</strong> | Emergency +50%</p>
                <a href="<?= base_url('/custom-club-building') ?>" class="btn btn-primary">Build & Order</a>
            </div>
            
            <div class="card service-card">
                <div class="service-icon" style="background: linear-gradient(135deg, var(--gold), #e6c45c);">🏌️</div>
                <h3>Simulator Rental</h3>
                <p>GC3 Foresight simulator rental with professional analysis. Perfect for winter practice, club testing, and swing improvement.</p>
                <p><strong>$40/hour</strong> | Half/Full day available</p>
                <a href="<?= base_url('/simulator') ?>" class="btn btn-primary">Rent Simulator</a>
            </div>
            
            <div class="card service-card">
                <div class="service-icon">🎯</div>
                <h3>AI Club & Shaft Fitting</h3>
                <p>Revolutionary AI technology analyzes your swing in real-time, providing data-driven recommendations for optimal club selection and customization.</p>
                <p><strong>Starting at $75</strong> | 90 minutes</p>
                <a href="<?= base_url('/ai-fitting') ?>" class="btn btn-primary">Book Fitting</a>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="section section-light">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Why Choose Golf Club Builders?</h2>
            <p class="section-subtitle">We combine cutting-edge technology with traditional craftsmanship</p>
        </div>
        
        <div class="services-grid">
            <div class="card">
                <h4>🔬 Advanced AI Technology</h4>
                <p>Our proprietary AI system analyzes over 100 data points in your swing, providing insights that traditional fitting methods simply can't match.</p>
            </div>
            
            <div class="card">
                <h4>👨‍🏫 Expert Technicians</h4>
                <p>Our certified club fitters have decades of combined experience and are passionate about helping you improve your game.</p>
            </div>
            
            <div class="card">
                <h4>🎨 Custom Solutions</h4>
                <p>Every golfer is unique. We provide personalized recommendations based on your swing characteristics, skill level, and goals.</p>
            </div>
            
            <div class="card">
                <h4>✅ Satisfaction Guaranteed</h4>
                <p>We're confident in our service. If you're not satisfied with your fitting, we'll make it right - guaranteed.</p>
            </div>
            
            <div class="card">
                <h4>🚀 Latest Equipment</h4>
                <p>We use the latest shaft technology, club heads, and grips from all major manufacturers to ensure perfect compatibility.</p>
            </div>
            
            <div class="card">
                <h4>💰 Best Value</h4>
                <p>Competitive pricing without compromising on quality. We believe great golf should be accessible to everyone.</p>
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">How It Works</h2>
            <p class="section-subtitle">Your journey to better golf in 4 simple steps</p>
        </div>
        
        <div class="services-grid">
            <div class="card" style="text-align: center;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">1️⃣</div>
                <h3>Book Online</h3>
                <p>Choose your preferred date and time using our easy online booking system. Select the service that fits your needs.</p>
            </div>
            
            <div class="card" style="text-align: center;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">2️⃣</div>
                <h3>Swing Analysis</h3>
                <p>Our AI system captures and analyzes your swing, measuring club head speed, attack angle, path, and more.</p>
            </div>
            
            <div class="card" style="text-align: center;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">3️⃣</div>
                <h3>Get Recommendations</h3>
                <p>Receive detailed, data-driven recommendations for clubs that will optimize your performance and consistency.</p>
            </div>
            
            <div class="card" style="text-align: center;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">4️⃣</div>
                <h3>Play Better Golf</h3>
                <p>Walk away with clubs perfectly suited to your swing, ready to lower your scores and enjoy the game more.</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="section section-light">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">What Our Customers Say</h2>
            <p class="section-subtitle">Real results from real golfers</p>
        </div>
        
        <div class="testimonial-slider">
            <div class="testimonial">
                <div class="stars">⭐⭐⭐⭐⭐</div>
                <p class="testimonial-text">"The AI fitting was incredible! I gained 20 yards with my driver and my accuracy improved dramatically. Best investment I've made in my golf game."</p>
                <div class="testimonial-author">
                    <div class="testimonial-avatar">JM</div>
                    <div>
                        <div class="testimonial-name">John Mitchell</div>
                        <div style="color: #666; font-size: 0.9rem;">Handicap: 12</div>
                    </div>
                </div>
            </div>
            
            <div class="testimonial">
                <div class="stars">⭐⭐⭐⭐⭐</div>
                <p class="testimonial-text">"Professional regripping service was quick and affordable. The new grips feel amazing and have really improved my control, especially in wet conditions."</p>
                <div class="testimonial-author">
                    <div class="testimonial-avatar">SP</div>
                    <div>
                        <div class="testimonial-name">Sarah Peterson</div>
                        <div style="color: #666; font-size: 0.9rem;">Handicap: 8</div>
                    </div>
                </div>
            </div>
            
            <div class="testimonial">
                <div class="stars">⭐⭐⭐⭐⭐</div>
                <p class="testimonial-text">"The team at Golf Club Builders really knows their stuff. The fitting process was thorough and the results speak for themselves. My scores have never been better!"</p>
                <div class="testimonial-author">
                    <div class="testimonial-avatar">MR</div>
                    <div>
                        <div class="testimonial-name">Mike Rodriguez</div>
                        <div style="color: #666; font-size: 0.9rem;">Handicap: 5</div>
                    </div>
                </div>
            </div>
        </div>
        
        <div style="text-align: center; margin-top: 3rem;">
            <a href="<?= base_url('/testimonials') ?>" class="btn btn-secondary">Read More Reviews</a>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section" style="background: linear-gradient(135deg, var(--navy-blue) 0%, #0d2a5c 100%); color: white;">
    <div class="container" style="text-align: center;">
        <h2 style="color: white; font-size: 3rem; margin-bottom: 1.5rem;">Ready to Transform Your Game?</h2>
        <p style="font-size: 1.3rem; margin-bottom: 2rem; color: rgba(255,255,255,0.9);">Book your AI club fitting today and experience the difference that perfectly fitted clubs can make.</p>
        <div style="display: flex; gap: 1.5rem; justify-content: center;">
            <a href="<?= base_url('/booking') ?>" class="btn btn-primary" style="font-size: 1.2rem; padding: 1rem 3rem;">Book Appointment</a>
            <a href="<?= base_url('/contact') ?>" class="btn btn-outline" style="font-size: 1.2rem; padding: 1rem 3rem; border-color: white; color: white;">Contact Us</a>
        </div>
    </div>
</section>



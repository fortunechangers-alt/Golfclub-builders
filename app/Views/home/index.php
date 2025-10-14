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
                <a href="<?= base_url('/fitting') ?>" class="btn btn-primary">Book Appointment</a>
                <a href="<?= base_url('/contact') ?>" class="btn btn-outline">Contact Us</a>
            </div>
        </div>
        <div class="hero-video-container">
            <video id="heroVideo" muted playsinline preload="auto">
                <source src="<?= base_url('video/Hero Video.mp4') ?>" type="video/mp4">
            </video>
            <audio id="ballDropSound" preload="auto">
                <source src="<?= base_url('video/Hero Video.mp4') ?>" type="audio/mp4">
            </audio>
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
                <div class="service-icon" style="background: linear-gradient(135deg, var(--deep-green), #0d2a5c); display: flex; align-items: center; justify-content: center; overflow: hidden;">
                    <img src="<?= base_url('images/club builders icon.png') ?>" alt="Custom Club Building" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <h3>Custom Club Building</h3>
                <p>Complete custom club building service from shaft selection to final assembly. Each club meticulously crafted to your exact specifications.</p>
                <p><strong>Starting at $21.99</strong> | Emergency +50%</p>
                <a href="<?= base_url('/custom-club-building') ?>" class="btn btn-primary">Build & Order</a>
            </div>
            
            <div class="card service-card">
                <div class="service-icon" style="background: linear-gradient(135deg, var(--gold), #e6c45c); display: flex; align-items: center; justify-content: center; overflow: hidden;">
                    <img src="<?= base_url('images/for golf sim icon.png') ?>" alt="Simulator Rental" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <h3>Simulator Rental</h3>
                <p>GC3 Foresight simulator rental with professional analysis. Accommodates up to 8 guests (6 comfortably). Perfect for winter practice, club testing, and swing improvement.</p>
                <p><strong>From $20/hour</strong> | Half/Full day rates available</p>
                <a href="<?= base_url('/simulator') ?>" class="btn btn-primary">Rent Simulator</a>
            </div>
            
            <div class="card service-card">
                <div class="service-icon" style="display: flex; align-items: center; justify-content: center; overflow: hidden;">
                    <img src="<?= base_url('images/AI CLUB AND SHAFT FITTING.png') ?>" alt="AI Club & Shaft Fitting" style="width: 100%; height: 100%; object-fit: contain;">
                </div>
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
                <h4>🎨 Custom Solutions</h4>
                <p>Every golfer is unique. We provide personalized recommendations based on your swing characteristics, skill level, and goals.</p>
            </div>
            
            <div class="card">
                <h4>✅ Satisfaction Guaranteed</h4>
                <p>We're confident in our service. If you're not satisfied with your fitting, we'll make it right - guaranteed.</p>
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
                <h3>Get Clarity</h3>
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
                    <div class="testimonial-avatar">DW</div>
                    <div>
                        <div class="testimonial-name">DANIEL W.</div>
                    </div>
                </div>
            </div>
            
            <div class="testimonial">
                <div class="stars">⭐⭐⭐⭐⭐</div>
                <p class="testimonial-text">"Professional regripping service was quick and affordable. The new grips feel amazing and have really improved my control, especially in wet conditions."</p>
                <div class="testimonial-author">
                    <div class="testimonial-avatar">JM</div>
                    <div>
                        <div class="testimonial-name">Jerry Mark</div>
                    </div>
                </div>
            </div>
            
            <div class="testimonial">
                <div class="stars">⭐⭐⭐⭐⭐</div>
                <p class="testimonial-text">"The team at Golf Club Builders really knows their stuff. The fitting process was thorough and the results speak for themselves. My scores have never been better!"</p>
                <div class="testimonial-author">
                    <div class="testimonial-avatar">WW</div>
                    <div>
                        <div class="testimonial-name">Wallace W.</div>
                    </div>
                </div>
            </div>
        </div>
        
        <div style="text-align: center; margin-top: 3rem; display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <a href="<?= base_url('/testimonials') ?>" class="btn btn-secondary">Read More Reviews</a>
            <button onclick="showAddReviewForm()" class="btn btn-primary">Add Your Review</button>
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




<!-- Add Review Modal -->
<div id="reviewModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.7); z-index: 1000; align-items: center; justify-content: center;">
    <div style="background: white; padding: 2rem; border-radius: 12px; max-width: 500px; width: 90%; max-height: 90vh; overflow-y: auto; margin: auto;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h3 style="margin: 0; color: var(--deep-green);">Add Your Review</h3>
            <button onclick="hideAddReviewForm()" style="background: none; border: none; font-size: 1.5rem; cursor: pointer; color: #666;">×</button>
        </div>
        
        <form id="reviewForm" onsubmit="submitReview(event)">
            <div style="margin-bottom: 1rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--deep-green);">Your Name *</label>
                <input type="text" id="reviewerName" required style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 6px; font-size: 1rem;">
            </div>
            
            <div style="margin-bottom: 1rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--deep-green);">Rating *</label>
                <div style="display: flex; gap: 0.5rem; margin-bottom: 0.5rem;">
                    <span onclick="setRating(1)" class="star-rating" data-rating="1">⭐</span>
                    <span onclick="setRating(2)" class="star-rating" data-rating="2">⭐</span>
                    <span onclick="setRating(3)" class="star-rating" data-rating="3">⭐</span>
                    <span onclick="setRating(4)" class="star-rating" data-rating="4">⭐</span>
                    <span onclick="setRating(5)" class="star-rating" data-rating="5">⭐</span>
                </div>
                <input type="hidden" id="rating" required>
            </div>
            
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--deep-green);">Your Review *</label>
                <textarea id="reviewText" required rows="4" style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 6px; font-size: 1rem; resize: vertical;" placeholder="Tell us about your experience..."></textarea>
            </div>
            
            <div style="display: flex; gap: 1rem; justify-content: flex-end;">
                <button type="button" onclick="hideAddReviewForm()" class="btn btn-outline">Cancel</button>
                <button type="submit" class="btn btn-primary">Submit Review</button>
            </div>
        </form>
    </div>
</div>

<script>
function showAddReviewForm() {
    document.getElementById("reviewModal").style.display = "flex";
    document.body.style.overflow = "hidden";
}

function hideAddReviewForm() {
    document.getElementById("reviewModal").style.display = "none";
    document.body.style.overflow = "auto";
    document.getElementById("reviewForm").reset();
    document.querySelectorAll(".star-rating").forEach(star => {
        star.style.opacity = "0.3";
    });
    document.getElementById("rating").value = "";
}

function setRating(rating) {
    document.getElementById("rating").value = rating;
    document.querySelectorAll(".star-rating").forEach((star, index) => {
        if (index < rating) {
            star.style.opacity = "1";
        } else {
            star.style.opacity = "0.3";
        }
    });
}

function submitReview(event) {
    event.preventDefault();
    
    const name = document.getElementById("reviewerName").value;
    const rating = document.getElementById("rating").value;
    const text = document.getElementById("reviewText").value;
    
    if (!rating) {
        alert("Please select a rating");
        return;
    }
    
    // Save review to localStorage
    const reviews = JSON.parse(localStorage.getItem('customerReviews') || '[]');
    const newReview = {
        id: Date.now(),
        name: name,
        rating: parseInt(rating),
        text: text,
        date: new Date().toISOString().split('T')[0]
    };
    
    reviews.push(newReview);
    localStorage.setItem('customerReviews', JSON.stringify(reviews));
    
    alert("Thank you for your review! We appreciate your feedback.");
    
    hideAddReviewForm();
}

// Close modal when clicking outside
document.getElementById("reviewModal").addEventListener("click", function(e) {
    if (e.target === this) {
        hideAddReviewForm();
    }
});
</script>

<style>
.star-rating {
    cursor: pointer;
    font-size: 1.5rem;
    opacity: 0.3;
    transition: opacity 0.2s ease;
}

.star-rating:hover {
    opacity: 1;
}

#reviewModal {
    display: none;
}
</style>

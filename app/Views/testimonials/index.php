<section class="section" style="margin-top: 120px;">
    <div class="container">
        <div class="section-header">
            <h1 class="section-title">Customer Reviews</h1>
            <p class="section-subtitle">What our customers are saying about our services</p>
        </div>
        
        <!-- Featured Reviews -->
        <div class="card" style="margin-bottom: 3rem;">
            <h3 style="margin-bottom: 2rem; color: var(--deep-green);">Featured Reviews</h3>
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
        </div>
        
        <!-- Customer Reviews -->
        <div class="card" style="margin-bottom: 3rem;">
            <h3 style="margin-bottom: 2rem; color: var(--deep-green);">Customer Reviews</h3>
            <div id="customer-reviews">
                <!-- Reviews will be loaded here -->
            </div>
        </div>
        
        <!-- Add Review Button -->
        <div style="text-align: center; margin-top: 3rem;">
            <button onclick="showAddReviewForm()" class="btn btn-primary">Add Your Review</button>
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
    loadCustomerReviews(); // Refresh the reviews display
}

function loadCustomerReviews() {
    const reviews = JSON.parse(localStorage.getItem('customerReviews') || '[]');
    const container = document.getElementById('customer-reviews');
    
    if (reviews.length === 0) {
        container.innerHTML = '<p style="text-align: center; color: #666; padding: 2rem;">No customer reviews yet. Be the first to leave a review!</p>';
        return;
    }
    
    let html = '';
    reviews.forEach(review => {
        const stars = '⭐'.repeat(review.rating);
        const initials = review.name.split(' ').map(n => n[0]).join('').toUpperCase();
        
        html += `
            <div class="testimonial" style="margin-bottom: 2rem; padding: 1.5rem; border: 1px solid var(--light); border-radius: 8px;">
                <div class="stars">${stars}</div>
                <p class="testimonial-text">"${review.text}"</p>
                <div class="testimonial-author">
                    <div class="testimonial-avatar">${initials}</div>
                    <div>
                        <div class="testimonial-name">${review.name}</div>
                        <div style="color: #666; font-size: 0.9rem;">${review.date}</div>
                    </div>
                </div>
            </div>
        `;
    });
    
    container.innerHTML = html;
}

// Load reviews when page loads
document.addEventListener('DOMContentLoaded', function() {
    loadCustomerReviews();
});

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

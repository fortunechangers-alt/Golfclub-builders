<section class="section" style="margin-top: 120px;">
    <div class="container" style="max-width: 800px;">
        <div style="text-align: center; margin-bottom: 3rem;">
            <div style="width: 100px; height: 100px; background: var(--golf-green); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 2rem; font-size: 3rem;">
                ✓
            </div>
            <h1 style="color: var(--golf-green); margin-bottom: 1rem;">Booking Confirmed!</h1>
            <p style="font-size: 1.2rem; color: #666;">Your appointment has been successfully booked</p>
        </div>
        
        <div class="card">
            <h3 style="margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 2px solid var(--golf-green);">Booking Details</h3>
            
            <div style="display: grid; gap: 1.5rem;">
                <div style="display: flex; justify-content: space-between; padding: 1rem; background: var(--light-gray); border-radius: 10px;">
                    <strong>Booking Reference:</strong>
                    <span style="color: var(--golf-green); font-weight: 700; font-size: 1.2rem;"><?= esc($booking['booking_reference']) ?></span>
                </div>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <div>
                        <strong style="color: var(--navy-blue); display: block; margin-bottom: 0.5rem;">Service:</strong>
                        <span><?= esc($service['name']) ?></span>
                    </div>
                    
                    <div>
                        <strong style="color: var(--navy-blue); display: block; margin-bottom: 0.5rem;">Price:</strong>
                        <span>$<?= number_format($service['price'], 2) ?></span>
                    </div>
                    
                    <div>
                        <strong style="color: var(--navy-blue); display: block; margin-bottom: 0.5rem;">Date:</strong>
                        <span><?= date('l, F j, Y', strtotime($booking['booking_date'])) ?></span>
                    </div>
                    
                    <div>
                        <strong style="color: var(--navy-blue); display: block; margin-bottom: 0.5rem;">Time:</strong>
                        <span><?= date('g:i A', strtotime($booking['start_time'])) ?> - <?= date('g:i A', strtotime($booking['end_time'])) ?></span>
                    </div>
                    
                    <div>
                        <strong style="color: var(--navy-blue); display: block; margin-bottom: 0.5rem;">Duration:</strong>
                        <span><?= $service['duration'] ?> minutes</span>
                    </div>
                    
                    <div>
                        <strong style="color: var(--navy-blue); display: block; margin-bottom: 0.5rem;">Status:</strong>
                        <span style="color: var(--gold); font-weight: 600;">Pending Confirmation</span>
                    </div>
                </div>
                
                <div style="padding: 1rem; background: var(--light-gray); border-radius: 10px; border-left: 4px solid var(--golf-green);">
                    <strong style="color: var(--navy-blue); display: block; margin-bottom: 0.5rem;">Customer Information:</strong>
                    <p style="margin: 0.5rem 0;"><?= esc($booking['customer_name']) ?></p>
                    <p style="margin: 0.5rem 0;"><?= esc($booking['customer_email']) ?></p>
                    <p style="margin: 0.5rem 0;"><?= esc($booking['customer_phone']) ?></p>
                </div>
                
                <?php if (!empty($booking['special_requests'])): ?>
                <div>
                    <strong style="color: var(--navy-blue); display: block; margin-bottom: 0.5rem;">Special Requests:</strong>
                    <p style="padding: 1rem; background: var(--light-gray); border-radius: 10px;"><?= esc($booking['special_requests']) ?></p>
                </div>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="alert alert-info" style="margin-top: 2rem;">
            <strong>📧 Confirmation Email Sent!</strong><br>
            A confirmation email has been sent to <?= esc($booking['customer_email']) ?> with your booking details. 
            Please check your spam folder if you don't see it in your inbox.
        </div>
        
        <div class="card" style="margin-top: 2rem;">
            <h4 style="margin-bottom: 1rem;">What's Next?</h4>
            <ul style="list-style: none; padding: 0;">
                <li style="padding: 0.75rem 0; border-bottom: 1px solid #eee;">
                    ✓ You'll receive a confirmation email shortly
                </li>
                <li style="padding: 0.75rem 0; border-bottom: 1px solid #eee;">
                    ✓ Our team will review your booking and confirm within 24 hours
                </li>
                <li style="padding: 0.75rem 0; border-bottom: 1px solid #eee;">
                    ✓ Please arrive 10 minutes early for your appointment
                </li>
                <li style="padding: 0.75rem 0;">
                    ✓ Bring your current clubs if you have them
                </li>
            </ul>
        </div>
        
        <div style="text-align: center; margin-top: 3rem; display: flex; gap: 1rem; justify-content: center;">
            <a href="<?= base_url('/') ?>" class="btn btn-secondary">Back to Home</a>
            <a href="<?= base_url('/booking') ?>" class="btn btn-outline">Book Another Appointment</a>
        </div>
        
        <div style="text-align: center; margin-top: 2rem; color: #666;">
            <p>Need to make changes? Contact us at:</p>
            <p style="font-weight: 600; color: var(--navy-blue);">📞 (717) 387-1643 | 📧 Daniel@Golfclub-builders.com</p>
        </div>
    </div>
</section>


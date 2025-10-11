<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<div style="margin-bottom: 1.5rem;">
    <a href="<?= base_url('/admin/bookings') ?>" class="btn btn-outline">← Back to Bookings</a>
</div>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
    <!-- Booking Details -->
    <div class="card">
        <h3 style="margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 2px solid var(--golf-green);">
            Booking Details
            <span style="float: right; font-size: 1.2rem; color: var(--golf-green);"><?= esc($booking['booking_reference']) ?></span>
        </h3>
        
        <div style="display: grid; gap: 1.5rem;">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div>
                    <strong style="color: var(--navy-blue); display: block; margin-bottom: 0.5rem;">Service:</strong>
                    <span style="font-size: 1.1rem;"><?= esc($service['name']) ?></span>
                </div>
                
                <div>
                    <strong style="color: var(--navy-blue); display: block; margin-bottom: 0.5rem;">Price:</strong>
                    <span style="font-size: 1.1rem; color: var(--golf-green);">$<?= number_format($service['price'], 2) ?></span>
                </div>
                
                <div>
                    <strong style="color: var(--navy-blue); display: block; margin-bottom: 0.5rem;">Date:</strong>
                    <span style="font-size: 1.1rem;"><?= date('l, F j, Y', strtotime($booking['booking_date'])) ?></span>
                </div>
                
                <div>
                    <strong style="color: var(--navy-blue); display: block; margin-bottom: 0.5rem;">Time:</strong>
                    <span style="font-size: 1.1rem;"><?= date('g:i A', strtotime($booking['start_time'])) ?> - <?= date('g:i A', strtotime($booking['end_time'])) ?></span>
                </div>
                
                <div>
                    <strong style="color: var(--navy-blue); display: block; margin-bottom: 0.5rem;">Duration:</strong>
                    <span><?= $service['duration'] ?> minutes</span>
                </div>
                
                <div>
                    <strong style="color: var(--navy-blue); display: block; margin-bottom: 0.5rem;">Booked On:</strong>
                    <span><?= date('M j, Y g:i A', strtotime($booking['created_at'])) ?></span>
                </div>
            </div>
            
            <div style="padding: 1.5rem; background: var(--light-gray); border-radius: 10px;">
                <strong style="color: var(--navy-blue); display: block; margin-bottom: 1rem;">Customer Information:</strong>
                <p style="margin: 0.5rem 0;"><strong>Name:</strong> <?= esc($booking['customer_name']) ?></p>
                <p style="margin: 0.5rem 0;"><strong>Email:</strong> <a href="mailto:<?= esc($booking['customer_email']) ?>" style="color: var(--golf-green);"><?= esc($booking['customer_email']) ?></a></p>
                <p style="margin: 0.5rem 0;"><strong>Phone:</strong> <a href="tel:<?= esc($booking['customer_phone']) ?>" style="color: var(--golf-green);"><?= esc($booking['customer_phone']) ?></a></p>
            </div>
            
            <?php if (!empty($booking['special_requests'])): ?>
            <div>
                <strong style="color: var(--navy-blue); display: block; margin-bottom: 0.5rem;">Special Requests:</strong>
                <p style="padding: 1rem; background: var(--light-gray); border-radius: 10px; margin: 0;"><?= nl2br(esc($booking['special_requests'])) ?></p>
            </div>
            <?php endif; ?>
            
            <?php if (!empty($booking['admin_notes'])): ?>
            <div>
                <strong style="color: var(--navy-blue); display: block; margin-bottom: 0.5rem;">Admin Notes:</strong>
                <p style="padding: 1rem; background: #fff3cd; border-radius: 10px; margin: 0;"><?= nl2br(esc($booking['admin_notes'])) ?></p>
            </div>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Update Status -->
    <div>
        <div class="card">
            <h3 style="margin-bottom: 1.5rem;">Update Status</h3>
            
            <form action="<?= base_url('/admin/bookings/update-status') ?>" method="POST">
                <?= csrf_field() ?>
                <input type="hidden" name="booking_id" value="<?= $booking['id'] ?>">
                
                <div class="form-group">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="pending" <?= $booking['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="confirmed" <?= $booking['status'] == 'confirmed' ? 'selected' : '' ?>>Confirmed</option>
                        <option value="completed" <?= $booking['status'] == 'completed' ? 'selected' : '' ?>>Completed</option>
                        <option value="cancelled" <?= $booking['status'] == 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                        <option value="no-show" <?= $booking['status'] == 'no-show' ? 'selected' : '' ?>>No-Show</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="admin_notes" class="form-label">Admin Notes</label>
                    <textarea class="form-control" id="admin_notes" name="admin_notes" rows="4"><?= esc($booking['admin_notes']) ?></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary" style="width: 100%;">Update Status</button>
            </form>
        </div>
        
        <div class="card" style="margin-top: 1.5rem;">
            <h4 style="margin-bottom: 1rem;">Quick Actions</h4>
            <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                <?php if ($booking['status'] == 'pending'): ?>
                    <form action="<?= base_url('/admin/bookings/update-status') ?>" method="POST" style="margin: 0;">
                        <?= csrf_field() ?>
                        <input type="hidden" name="booking_id" value="<?= $booking['id'] ?>">
                        <input type="hidden" name="status" value="confirmed">
                        <button type="submit" class="btn btn-primary" style="width: 100%;">✓ Confirm Booking</button>
                    </form>
                <?php endif; ?>
                
                <?php if ($booking['status'] != 'cancelled'): ?>
                    <form action="<?= base_url('/admin/bookings/update-status') ?>" method="POST" style="margin: 0;" onsubmit="return confirm('Cancel this booking?');">
                        <?= csrf_field() ?>
                        <input type="hidden" name="booking_id" value="<?= $booking['id'] ?>">
                        <input type="hidden" name="status" value="cancelled">
                        <button type="submit" class="btn btn-outline" style="width: 100%; border-color: #dc3545; color: #dc3545;">✗ Cancel Booking</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>


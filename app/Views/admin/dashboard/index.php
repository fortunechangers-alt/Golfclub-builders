<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-value"><?= $stats['total_bookings'] ?></div>
        <div class="stat-label">Total Bookings</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-value" style="color: var(--gold);"><?= $stats['pending_bookings'] ?></div>
        <div class="stat-label">Pending Bookings</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-value" style="color: var(--navy-blue);"><?= $stats['today_bookings'] ?></div>
        <div class="stat-label">Today's Bookings</div>
    </div>
    
    <div class="stat-card">
        <div class="stat-value"><?= $stats['total_customers'] ?></div>
        <div class="stat-label">Total Customers</div>
    </div>
</div>

<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h2 style="margin: 0;">Recent Bookings</h2>
        <a href="<?= base_url('/admin/bookings') ?>" class="btn btn-primary">View All</a>
    </div>
    
    <?php if (empty($recentBookings)): ?>
        <p style="text-align: center; color: #666; padding: 2rem;">No bookings yet.</p>
    <?php else: ?>
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="border-bottom: 2px solid var(--golf-green);">
                    <th style="padding: 1rem; text-align: left;">Reference</th>
                    <th style="padding: 1rem; text-align: left;">Customer</th>
                    <th style="padding: 1rem; text-align: left;">Date</th>
                    <th style="padding: 1rem; text-align: left;">Time</th>
                    <th style="padding: 1rem; text-align: left;">Status</th>
                    <th style="padding: 1rem; text-align: left;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recentBookings as $booking): ?>
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 1rem; font-weight: 600; color: var(--golf-green);"><?= esc($booking['booking_reference']) ?></td>
                        <td style="padding: 1rem;"><?= esc($booking['customer_name']) ?></td>
                        <td style="padding: 1rem;"><?= date('M j, Y', strtotime($booking['booking_date'])) ?></td>
                        <td style="padding: 1rem;"><?= date('g:i A', strtotime($booking['start_time'])) ?></td>
                        <td style="padding: 1rem;">
                            <span style="padding: 0.35rem 0.75rem; border-radius: 20px; font-size: 0.85rem; font-weight: 600;
                                <?php 
                                    if ($booking['status'] == 'confirmed') echo 'background: rgba(0,166,81,0.1); color: var(--golf-green);';
                                    elseif ($booking['status'] == 'pending') echo 'background: rgba(212,175,55,0.1); color: var(--gold);';
                                    elseif ($booking['status'] == 'completed') echo 'background: rgba(10,31,68,0.1); color: var(--navy-blue);';
                                    else echo 'background: rgba(220,53,69,0.1); color: #dc3545;';
                                ?>">
                                <?= ucfirst($booking['status']) ?>
                            </span>
                        </td>
                        <td style="padding: 1rem;">
                            <a href="<?= base_url('/admin/bookings/view/' . $booking['id']) ?>" class="btn btn-outline" style="padding: 0.5rem 1rem; font-size: 0.9rem;">View</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-top: 2rem;">
    <div class="card">
        <h3 style="margin-bottom: 1.5rem;">Quick Actions</h3>
        <div style="display: flex; flex-direction: column; gap: 1rem;">
            <a href="<?= base_url('/admin/available-dates-manager') ?>" class="btn" style="width: 100%; background: var(--golf-green); color: white; font-weight: 600;">
                📅 Manage Available Dates
            </a>
            <a href="<?= base_url('/admin/available-slots') ?>" class="btn" style="width: 100%; background: var(--gold); color: white; font-weight: 600;">
                🎯 Manage Available Slots (Soft Opening)
            </a>
            <a href="<?= base_url('/admin/calendar') ?>" class="btn btn-primary" style="width: 100%;">🗓️ Manage Calendar</a>
            <a href="<?= base_url('/admin/bookings') ?>" class="btn btn-secondary" style="width: 100%;">📅 View All Bookings</a>
            <a href="<?= base_url('/booking') ?>" class="btn btn-outline" style="width: 100%;">➕ New Booking</a>
        </div>
    </div>
    
    <div class="card">
        <h3 style="margin-bottom: 1.5rem;">Today's Schedule</h3>
        <?php 
        $bookingModel = new \App\Models\BookingModel();
        $todayBookings = $bookingModel->where('booking_date', date('Y-m-d'))->orderBy('start_time')->findAll();
        ?>
        <?php if (empty($todayBookings)): ?>
            <p style="color: #666;">No bookings today</p>
        <?php else: ?>
            <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                <?php foreach ($todayBookings as $booking): ?>
                    <div style="padding: 0.75rem; background: var(--light-gray); border-radius: 8px; border-left: 3px solid var(--golf-green);">
                        <div style="font-weight: 600;"><?= date('g:i A', strtotime($booking['start_time'])) ?></div>
                        <div style="font-size: 0.9rem; color: #666;"><?= esc($booking['customer_name']) ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>


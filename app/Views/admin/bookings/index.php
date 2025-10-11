<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h2 style="margin: 0;">All Bookings</h2>
        <a href="<?= base_url('/booking') ?>" class="btn btn-primary">➕ New Booking</a>
    </div>
    
    <!-- Filters -->
    <form method="GET" style="margin-bottom: 2rem; padding: 1.5rem; background: var(--light-gray); border-radius: 10px;">
        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr auto; gap: 1rem; align-items: end;">
            <div class="form-group" style="margin: 0;">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="">All Statuses</option>
                    <option value="pending" <?= $filterStatus == 'pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="confirmed" <?= $filterStatus == 'confirmed' ? 'selected' : '' ?>>Confirmed</option>
                    <option value="completed" <?= $filterStatus == 'completed' ? 'selected' : '' ?>>Completed</option>
                    <option value="cancelled" <?= $filterStatus == 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                    <option value="no-show" <?= $filterStatus == 'no-show' ? 'selected' : '' ?>>No-Show</option>
                </select>
            </div>
            
            <div class="form-group" style="margin: 0;">
                <label class="form-label">Date</label>
                <input type="date" name="date" class="form-control" value="<?= esc($filterDate) ?>">
            </div>
            
            <div>
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
            
            <div>
                <a href="<?= base_url('/admin/bookings') ?>" class="btn btn-outline">Clear</a>
            </div>
        </div>
    </form>
    
    <?php if (empty($bookings)): ?>
        <p style="text-align: center; color: #666; padding: 3rem;">No bookings found.</p>
    <?php else: ?>
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="border-bottom: 2px solid var(--golf-green); background: var(--light-gray);">
                    <th style="padding: 1rem; text-align: left;">Reference</th>
                    <th style="padding: 1rem; text-align: left;">Customer</th>
                    <th style="padding: 1rem; text-align: left;">Contact</th>
                    <th style="padding: 1rem; text-align: left;">Date</th>
                    <th style="padding: 1rem; text-align: left;">Time</th>
                    <th style="padding: 1rem; text-align: left;">Status</th>
                    <th style="padding: 1rem; text-align: left;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $booking): ?>
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 1rem;">
                            <strong style="color: var(--golf-green);"><?= esc($booking['booking_reference']) ?></strong>
                        </td>
                        <td style="padding: 1rem; font-weight: 600;"><?= esc($booking['customer_name']) ?></td>
                        <td style="padding: 1rem; font-size: 0.9rem; color: #666;">
                            <?= esc($booking['customer_email']) ?><br>
                            <?= esc($booking['customer_phone']) ?>
                        </td>
                        <td style="padding: 1rem;"><?= date('M j, Y', strtotime($booking['booking_date'])) ?></td>
                        <td style="padding: 1rem;"><?= date('g:i A', strtotime($booking['start_time'])) ?></td>
                        <td style="padding: 1rem;">
                            <span style="padding: 0.35rem 0.75rem; border-radius: 20px; font-size: 0.85rem; font-weight: 600; white-space: nowrap;
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
                            <a href="<?= base_url('/admin/bookings/view/' . $booking['id']) ?>" class="btn btn-primary" style="padding: 0.5rem 1rem; font-size: 0.9rem;">View</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>


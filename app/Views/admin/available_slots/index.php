<style>
.slot-calendar {
    background: white;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.slot-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem;
    margin-bottom: 0.5rem;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    background: white;
    transition: all 0.3s;
}

.slot-item:hover {
    border-color: var(--golf-green);
    transform: translateX(5px);
}

.slot-item.inactive {
    background: #f5f5f5;
    opacity: 0.6;
}

.slot-item.fully-booked {
    background: #ffe0e0;
    border-color: #ff6b6b;
}

.slot-date {
    font-weight: 600;
    color: var(--navy-blue);
    font-size: 1.1rem;
}

.slot-time {
    color: var(--golf-green);
    font-weight: 500;
}

.slot-status {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 500;
}

.status-active {
    background: #d4edda;
    color: #155724;
}

.status-inactive {
    background: #f8d7da;
    color: #721c24;
}

.btn-sm {
    padding: 0.4rem 0.8rem;
    font-size: 0.9rem;
    margin-left: 0.5rem;
}

.filter-section {
    background: white;
    padding: 1.5rem;
    border-radius: 8px;
    margin-bottom: 2rem;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.alert {
    padding: 1rem 1.5rem;
    border-radius: 8px;
    margin-bottom: 1.5rem;
    font-weight: 500;
}

.alert-success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.alert-error {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: white;
    padding: 1.5rem;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    text-align: center;
}

.stat-value {
    font-size: 2rem;
    font-weight: 700;
    color: var(--golf-green);
    margin-bottom: 0.5rem;
}

.stat-label {
    color: #666;
    font-size: 0.9rem;
}
</style>

<div class="container" style="padding: 2rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <div>
            <h1 style="color: var(--navy-blue); margin-bottom: 0.5rem;">🎯 Soft Opening - Available Time Slots</h1>
            <p style="color: #666;">Manage which time slots customers can book during the soft opening phase</p>
        </div>
        <div>
            <a href="<?= base_url('/admin/available-slots/create') ?>" class="btn btn-primary">
                ➕ Open New Slots
            </a>
            <a href="<?= base_url('/admin/available-slots/quick-create') ?>" class="btn" style="background: var(--gold); color: white;">
                ⚡ Quick Open
            </a>
        </div>
    </div>

    <!-- Success/Error Messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            ✅ <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>
    
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-error">
            ❌ <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <!-- Statistics -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-value"><?= count($slots) ?></div>
            <div class="stat-label">Total Slots Open</div>
        </div>
        <div class="stat-card">
            <div class="stat-value"><?= count(array_filter($slots, fn($s) => $s['is_active'])) ?></div>
            <div class="stat-label">Active Slots</div>
        </div>
        <div class="stat-card">
            <div class="stat-value"><?= count($bookings) ?></div>
            <div class="stat-label">Current Bookings</div>
        </div>
        <div class="stat-card">
            <div class="stat-value"><?= count(array_filter($slots, fn($s) => $s['current_bookings'] >= $s['max_bookings'])) ?></div>
            <div class="stat-label">Fully Booked</div>
        </div>
    </div>

    <!-- Filters -->
    <div class="filter-section">
        <form method="get" style="display: flex; gap: 1rem; align-items: end;">
            <div style="flex: 1;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Month</label>
                <input type="month" name="month" value="<?= $month ?>" class="form-control">
            </div>
            <div style="flex: 1;">
                <label style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Service</label>
                <select name="service_id" class="form-control">
                    <option value="">All Services</option>
                    <?php foreach ($services as $service): ?>
                        <option value="<?= $service['id'] ?>" <?= $serviceId == $service['id'] ? 'selected' : '' ?>>
                            <?= esc($service['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">🔍 Filter</button>
            <a href="<?= base_url('/admin/available-slots') ?>" class="btn">Clear</a>
        </form>
    </div>

    <!-- Slots List -->
    <div class="slot-calendar">
        <h2 style="margin-bottom: 1.5rem; color: var(--navy-blue);">Available Time Slots</h2>
        
        <?php if (empty($slots)): ?>
            <div style="text-align: center; padding: 3rem; color: #999;">
                <p style="font-size: 3rem; margin-bottom: 1rem;">📅</p>
                <h3 style="color: #666;">No Time Slots Opened Yet</h3>
                <p>Click "Open New Slots" to make time slots available to customers</p>
                <a href="<?= base_url('/admin/available-slots/create') ?>" class="btn btn-primary" style="margin-top: 1rem;">
                    Open Your First Slots
                </a>
            </div>
        <?php else: ?>
            <?php
            // Group by date
            $slotsByDate = [];
            foreach ($slots as $slot) {
                $slotsByDate[$slot['date']][] = $slot;
            }
            ksort($slotsByDate);
            ?>
            
            <?php foreach ($slotsByDate as $date => $dateSlots): ?>
                <div style="margin-bottom: 2rem;">
                    <h3 style="color: var(--golf-green); margin-bottom: 1rem;">
                        📅 <?= date('l, F j, Y', strtotime($date)) ?>
                    </h3>
                    
                    <?php foreach ($dateSlots as $slot): ?>
                        <?php 
                        $isFullyBooked = $slot['current_bookings'] >= $slot['max_bookings'];
                        $isActive = $slot['is_active'];
                        $service = array_filter($services, fn($s) => $s['id'] == $slot['service_id'])[0] ?? null;
                        ?>
                        
                        <div class="slot-item <?= !$isActive ? 'inactive' : '' ?> <?= $isFullyBooked ? 'fully-booked' : '' ?>">
                            <div style="flex: 1;">
                                <div style="display: flex; align-items: center; gap: 1rem;">
                                    <span class="slot-time">
                                        🕐 <?= date('g:i A', strtotime($slot['start_time'])) ?> - <?= date('g:i A', strtotime($slot['end_time'])) ?>
                                    </span>
                                    <span style="color: #666;">
                                        <?= $service ? esc($service['name']) : 'Unknown Service' ?>
                                    </span>
                                    <span class="slot-status <?= $isActive ? 'status-active' : 'status-inactive' ?>">
                                        <?= $isActive ? '✓ Active' : '✗ Inactive' ?>
                                    </span>
                                    <?php if ($isFullyBooked): ?>
                                        <span style="color: #d32f2f; font-weight: 600;">🔴 FULLY BOOKED</span>
                                    <?php else: ?>
                                        <span style="color: #2e7d32; font-size: 0.9rem;">
                                            <?= $slot['current_bookings'] ?>/<?= $slot['max_bookings'] ?> booked
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <?php if ($slot['notes']): ?>
                                    <div style="margin-top: 0.5rem; font-size: 0.85rem; color: #666;">
                                        📝 <?= esc($slot['notes']) ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <div style="display: flex; gap: 0.5rem;">
                                <a href="<?= base_url('/admin/available-slots/toggle/' . $slot['id']) ?>" 
                                   class="btn btn-sm" 
                                   style="background: <?= $isActive ? '#ff9800' : '#4caf50' ?>; color: white;">
                                    <?= $isActive ? '⏸ Deactivate' : '▶️ Activate' ?>
                                </a>
                                <a href="<?= base_url('/admin/available-slots/delete/' . $slot['id']) ?>" 
                                   class="btn btn-sm" 
                                   style="background: #f44336; color: white;"
                                   onclick="return confirm('Are you sure you want to delete this slot?')">
                                    🗑 Delete
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>


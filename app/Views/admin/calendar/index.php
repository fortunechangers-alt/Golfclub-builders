<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-error">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
    <!-- Calendar View -->
    <div class="card">
        <h3 style="margin-bottom: 2rem;">Block/Unblock Dates</h3>
        
        <div class="calendar">
            <div class="calendar-header">
                <button type="button" class="calendar-prev btn btn-outline" style="padding: 0.5rem 1rem;">◀ Prev</button>
                <h4 class="calendar-title" style="margin: 0;">Month Year</h4>
                <button type="button" class="calendar-next btn btn-outline" style="padding: 0.5rem 1rem;">Next ▶</button>
            </div>
            <div id="adminCalendarGrid" class="calendar-grid"></div>
        </div>
        
        <div style="margin-top: 2rem; padding: 1rem; background: var(--light-gray); border-radius: 10px;">
            <h4 style="margin-bottom: 1rem;">Legend:</h4>
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 0.75rem;">
                <div><span style="display: inline-block; width: 20px; height: 20px; background: rgba(0,166,81,0.2); border-radius: 4px; margin-right: 0.5rem;"></span> Available</div>
                <div><span style="display: inline-block; width: 20px; height: 20px; background: var(--golf-green); border-radius: 4px; margin-right: 0.5rem;"></span> Has Bookings</div>
                <div><span style="display: inline-block; width: 20px; height: 20px; background: rgba(220,53,69,0.3); border-radius: 4px; margin-right: 0.5rem;"></span> Blocked</div>
                <div><span style="display: inline-block; width: 20px; height: 20px; background: #eee; border-radius: 4px; margin-right: 0.5rem;"></span> Closed</div>
            </div>
        </div>
    </div>
    
    <!-- Block Date Form -->
    <div>
        <div class="card">
            <h3 style="margin-bottom: 1.5rem;">Block a Date</h3>
            
            <form action="<?= base_url('/admin/calendar/block') ?>" method="POST">
                <?= csrf_field() ?>
                
                <div class="form-group">
                    <label for="block_date" class="form-label">Date *</label>
                    <input type="date" class="form-control" id="block_date" name="date" required min="<?= date('Y-m-d') ?>">
                </div>
                
                <div class="form-group">
                    <label for="reason" class="form-label">Reason *</label>
                    <select class="form-control" id="reason" name="reason" required>
                        <option value="vacation">Vacation</option>
                        <option value="maintenance">Maintenance</option>
                        <option value="holiday">Holiday</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Time Range (Optional)</label>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div>
                            <input type="time" class="form-control" name="start_time" placeholder="Start Time">
                            <small style="color: #666; font-size: 0.85rem;">Leave blank to block full day</small>
                        </div>
                        <div>
                            <input type="time" class="form-control" name="end_time" placeholder="End Time">
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="notes" class="form-label">Notes</label>
                    <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                </div>
                
                <div class="form-group">
                    <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                        <input type="checkbox" name="is_recurring" value="1">
                        <span>Recurring (e.g., every week)</span>
                    </label>
                </div>
                
                <button type="submit" class="btn btn-primary" style="width: 100%;">Block Date</button>
            </form>
        </div>
    </div>
</div>

<!-- Blocked Dates List -->
<div class="card" style="margin-top: 2rem;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h3 style="margin: 0;">Currently Blocked Dates</h3>
    </div>
    
    <?php if (empty($blockedDates)): ?>
        <p style="text-align: center; color: #666; padding: 2rem;">No blocked dates.</p>
    <?php else: ?>
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="border-bottom: 2px solid var(--golf-green);">
                    <th style="padding: 1rem; text-align: left;">Date</th>
                    <th style="padding: 1rem; text-align: left;">Time Range</th>
                    <th style="padding: 1rem; text-align: left;">Reason</th>
                    <th style="padding: 1rem; text-align: left;">Notes</th>
                    <th style="padding: 1rem; text-align: left;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($blockedDates as $blocked): ?>
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 1rem; font-weight: 600;">
                            <?= date('M j, Y', strtotime($blocked['date'])) ?>
                            <?php if ($blocked['is_recurring']): ?>
                                <span style="background: var(--gold); color: white; padding: 0.2rem 0.5rem; border-radius: 4px; font-size: 0.75rem; margin-left: 0.5rem;">Recurring</span>
                            <?php endif; ?>
                        </td>
                        <td style="padding: 1rem;">
                            <?php if ($blocked['start_time'] && $blocked['end_time']): ?>
                                <?= date('g:i A', strtotime($blocked['start_time'])) ?> - <?= date('g:i A', strtotime($blocked['end_time'])) ?>
                            <?php else: ?>
                                <span style="color: #666;">Full Day</span>
                            <?php endif; ?>
                        </td>
                        <td style="padding: 1rem;">
                            <span style="padding: 0.25rem 0.75rem; background: rgba(0,0,0,0.05); border-radius: 15px; font-size: 0.85rem;">
                                <?= ucfirst($blocked['reason']) ?>
                            </span>
                        </td>
                        <td style="padding: 1rem; color: #666; font-size: 0.9rem;">
                            <?= esc($blocked['notes']) ?: '-' ?>
                        </td>
                        <td style="padding: 1rem;">
                            <form action="<?= base_url('/admin/calendar/unblock') ?>" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to unblock this date?');">
                                <?= csrf_field() ?>
                                <input type="hidden" name="blocked_date_id" value="<?= $blocked['id'] ?>">
                                <button type="submit" class="btn btn-outline" style="padding: 0.5rem 1rem; font-size: 0.9rem; border-color: #dc3545; color: #dc3545;">
                                    Unblock
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<script>
// Admin Calendar with bookings and blocked dates visualization
let currentMonth = new Date().getMonth();
let currentYear = new Date().getFullYear();

const blockedDatesData = <?= json_encode(array_column($blockedDates, 'date')) ?>;
const bookingsData = <?= json_encode(array_map(function($b) { 
    return ['date' => $b['booking_date'], 'status' => $b['status']]; 
}, $bookings)) ?>;

function renderAdminCalendar() {
    const grid = document.getElementById('adminCalendarGrid');
    const title = document.querySelector('.calendar-title');
    
    const monthNames = ['January', 'February', 'March', 'April', 'May', 'June',
                       'July', 'August', 'September', 'October', 'November', 'December'];
    
    title.textContent = `${monthNames[currentMonth]} ${currentYear}`;
    grid.innerHTML = '';
    
    // Day headers
    ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'].forEach(day => {
        const header = document.createElement('div');
        header.style.padding = '0.75rem';
        header.style.fontWeight = '600';
        header.style.textAlign = 'center';
        header.textContent = day;
        grid.appendChild(header);
    });
    
    // Get calendar data
    const firstDay = new Date(currentYear, currentMonth, 1).getDay();
    const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
    
    // Blank cells
    for (let i = 0; i < firstDay; i++) {
        grid.appendChild(document.createElement('div'));
    }
    
    // Days
    for (let day = 1; day <= daysInMonth; day++) {
        const dateStr = `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
        const dayEl = document.createElement('div');
        dayEl.className = 'calendar-day';
        dayEl.textContent = day;
        dayEl.style.position = 'relative';
        dayEl.style.minHeight = '60px';
        dayEl.style.padding = '0.5rem';
        
        // Check if blocked
        if (blockedDatesData.includes(dateStr)) {
            dayEl.style.background = 'rgba(220,53,69,0.3)';
            dayEl.style.fontWeight = '700';
            dayEl.title = 'Blocked';
        }
        // Check if has bookings
        else if (bookingsData.some(b => b.date === dateStr)) {
            const bookingCount = bookingsData.filter(b => b.date === dateStr).length;
            dayEl.style.background = 'var(--golf-green)';
            dayEl.style.color = 'white';
            dayEl.style.fontWeight = '700';
            dayEl.title = `${bookingCount} booking(s)`;
            
            const badge = document.createElement('div');
            badge.textContent = bookingCount;
            badge.style.cssText = 'position: absolute; top: 5px; right: 5px; background: white; color: var(--golf-green); width: 20px; height: 20px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: 700;';
            dayEl.appendChild(badge);
        }
        // Sunday check
        else if (new Date(currentYear, currentMonth, day).getDay() === 0) {
            dayEl.style.background = '#eee';
            dayEl.style.color = '#999';
            dayEl.title = 'Closed (Sunday)';
        }
        // Available
        else {
            dayEl.style.background = 'rgba(0,166,81,0.1)';
            dayEl.style.cursor = 'pointer';
            dayEl.title = 'Available - Click to block';
            dayEl.addEventListener('click', () => {
                document.getElementById('block_date').value = dateStr;
                window.scrollTo({ top: 0, behavior: 'smooth' });
                document.getElementById('block_date').focus();
            });
        }
        
        grid.appendChild(dayEl);
    }
}

// Navigation
document.querySelector('.calendar-prev').addEventListener('click', () => {
    currentMonth--;
    if (currentMonth < 0) {
        currentMonth = 11;
        currentYear--;
    }
    renderAdminCalendar();
});

document.querySelector('.calendar-next').addEventListener('click', () => {
    currentMonth++;
    if (currentMonth > 11) {
        currentMonth = 0;
        currentYear++;
    }
    renderAdminCalendar();
});

// Initial render
renderAdminCalendar();
</script>


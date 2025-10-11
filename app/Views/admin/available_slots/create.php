<style>
.form-container {
    max-width: 800px;
    margin: 0 auto;
    background: white;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 600;
    color: var(--navy-blue);
}

.time-slot-selector {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 0.75rem;
    margin-top: 0.5rem;
}

.time-slot-checkbox {
    display: flex;
    align-items: center;
    padding: 0.75rem;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s;
}

.time-slot-checkbox:hover {
    border-color: var(--golf-green);
    background: #f0f9f4;
}

.time-slot-checkbox input:checked + label {
    color: var(--golf-green);
    font-weight: 600;
}

.time-slot-checkbox input {
    margin-right: 0.5rem;
}

.helper-text {
    font-size: 0.85rem;
    color: #666;
    margin-top: 0.25rem;
}

.btn-container {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 2px solid #e0e0e0;
}
</style>

<div class="container" style="padding: 2rem;">
    <div style="margin-bottom: 2rem;">
        <a href="<?= base_url('/admin/available-slots') ?>" style="color: var(--golf-green); text-decoration: none; font-weight: 500;">
            ← Back to Slots
        </a>
    </div>

    <div class="form-container">
        <h1 style="color: var(--navy-blue); margin-bottom: 0.5rem;">Open New Time Slots</h1>
        <p style="color: #666; margin-bottom: 2rem;">Select the dates and times you want to make available for customers to book</p>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-error" style="background: #f8d7da; color: #721c24; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
                ❌ <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form method="post" action="<?= base_url('/admin/available-slots/store') ?>">
            <?= csrf_field() ?>
            
            <!-- Service Selection -->
            <div class="form-group">
                <label for="service_id">Select Service *</label>
                <select name="service_id" id="service_id" class="form-control" required>
                    <option value="">-- Choose a Service --</option>
                    <?php foreach ($services as $service): ?>
                        <option value="<?= $service['id'] ?>">
                            <?= esc($service['name']) ?> - $<?= number_format($service['price'], 2) ?> (<?= $service['duration'] ?> min)
                        </option>
                    <?php endforeach; ?>
                </select>
                <div class="helper-text">Which service are these time slots for?</div>
            </div>

            <!-- Date Range -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label for="start_date">Start Date *</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" 
                           min="<?= date('Y-m-d') ?>" value="<?= date('Y-m-d') ?>" required>
                    <div class="helper-text">First date to open</div>
                </div>

                <div class="form-group">
                    <label for="end_date">End Date *</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" 
                           min="<?= date('Y-m-d') ?>" value="<?= date('Y-m-d', strtotime('+7 days')) ?>" required>
                    <div class="helper-text">Last date to open</div>
                </div>
            </div>

            <!-- Time Slots Selection -->
            <div class="form-group">
                <label>Select Time Slots *</label>
                <div class="helper-text" style="margin-bottom: 1rem;">
                    Choose which times should be available. Each slot is 30 minutes.
                </div>
                
                <div class="time-slot-selector">
                    <?php
                    $times = [
                        '09:00-09:30', '09:30-10:00', '10:00-10:30', '10:30-11:00',
                        '11:00-11:30', '11:30-12:00', '12:00-12:30', '12:30-13:00',
                        '13:00-13:30', '13:30-14:00', '14:00-14:30', '14:30-15:00',
                        '15:00-15:30', '15:30-16:00', '16:00-16:30', '16:30-17:00'
                    ];
                    
                    foreach ($times as $time) {
                        [$start, $end] = explode('-', $time);
                        $displayStart = date('g:i A', strtotime($start));
                        $displayEnd = date('g:i A', strtotime($end));
                        ?>
                        <div class="time-slot-checkbox">
                            <input type="checkbox" name="time_slots[]" value="<?= $time ?>" id="time_<?= $time ?>">
                            <label for="time_<?= $time ?>" style="cursor: pointer; margin: 0;">
                                <?= $displayStart ?>
                            </label>
                        </div>
                    <?php } ?>
                </div>
                
                <div style="margin-top: 1rem;">
                    <button type="button" onclick="selectAll()" class="btn btn-sm" style="background: var(--golf-green); color: white;">
                        ✓ Select All
                    </button>
                    <button type="button" onclick="deselectAll()" class="btn btn-sm">
                        ✗ Deselect All
                    </button>
                    <button type="button" onclick="selectMorning()" class="btn btn-sm" style="background: #ffc107; color: black;">
                        🌅 Morning (9AM-12PM)
                    </button>
                    <button type="button" onclick="selectAfternoon()" class="btn btn-sm" style="background: #ff9800; color: white;">
                        ☀️ Afternoon (12PM-5PM)
                    </button>
                </div>
            </div>

            <!-- Notes -->
            <div class="form-group">
                <label for="notes">Notes (Optional)</label>
                <textarea name="notes" id="notes" class="form-control" rows="3" 
                          placeholder="e.g., Soft opening - introductory pricing"></textarea>
                <div class="helper-text">Internal notes about these slots</div>
            </div>

            <!-- Submit Buttons -->
            <div class="btn-container">
                <a href="<?= base_url('/admin/available-slots') ?>" class="btn">Cancel</a>
                <button type="submit" class="btn btn-primary" style="background: var(--golf-green);">
                    ✓ Create Available Slots
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function selectAll() {
    document.querySelectorAll('input[name="time_slots[]"]').forEach(cb => cb.checked = true);
}

function deselectAll() {
    document.querySelectorAll('input[name="time_slots[]"]').forEach(cb => cb.checked = false);
}

function selectMorning() {
    deselectAll();
    const morningSlots = ['09:00-09:30', '09:30-10:00', '10:00-10:30', '10:30-11:00', 
                          '11:00-11:30', '11:30-12:00'];
    morningSlots.forEach(slot => {
        const cb = document.getElementById('time_' + slot);
        if (cb) cb.checked = true;
    });
}

function selectAfternoon() {
    deselectAll();
    const afternoonSlots = ['12:00-12:30', '12:30-13:00', '13:00-13:30', '13:30-14:00',
                            '14:00-14:30', '14:30-15:00', '15:00-15:30', '15:30-16:00', 
                            '16:00-16:30', '16:30-17:00'];
    afternoonSlots.forEach(slot => {
        const cb = document.getElementById('time_' + slot);
        if (cb) cb.checked = true;
    });
}

// Update end date minimum when start date changes
document.getElementById('start_date').addEventListener('change', function() {
    document.getElementById('end_date').min = this.value;
});
</script>


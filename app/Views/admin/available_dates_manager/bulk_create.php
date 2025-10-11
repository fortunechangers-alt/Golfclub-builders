<style>
.form-container {
    max-width: 600px;
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

.form-control {
    width: 100%;
    padding: 0.75rem;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    font-size: 1rem;
    transition: border-color 0.3s;
}

.form-control:focus {
    outline: none;
    border-color: var(--golf-green);
}

.date-range-inputs {
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    gap: 1rem;
    align-items: center;
}

.btn-submit {
    width: 100%;
    padding: 1rem;
    background: var(--golf-green);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
}

.btn-submit:hover {
    background: #00995c;
    transform: translateY(-2px);
}

.form-text {
    font-size: 0.9rem;
    color: #666;
    margin-top: 0.5rem;
}

.info-box {
    background: #e6f7ee;
    border: 2px solid var(--golf-green);
    border-radius: 8px;
    padding: 1rem;
    margin-bottom: 2rem;
}

.info-box h4 {
    margin: 0 0 0.5rem 0;
    color: var(--golf-green);
}

.info-box p {
    margin: 0;
    color: #333;
}
</style>

<div class="admin-container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1 style="margin: 0;">📆 Bulk Add Date Range</h1>
        <a href="<?= base_url('/admin/available-dates-manager') ?>" class="btn btn-secondary">← Back to List</a>
    </div>

    <div class="form-container">
        <div class="info-box">
            <h4>💡 How This Works</h4>
            <p>Select a start and end date to make all dates in that range available for booking. This is perfect for opening up a whole week or month at once!</p>
        </div>

        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <ul style="margin: 0; padding-left: 1.5rem;">
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('/admin/available-dates-manager/store-bulk') ?>" method="post">
            <?= csrf_field() ?>

            <div class="form-group">
                <label>Select Date Range *</label>
                <div class="date-range-inputs">
                    <div>
                        <input type="date" 
                               name="start_date" 
                               id="start_date" 
                               class="form-control" 
                               value="<?= old('start_date', date('Y-m-d')) ?>" 
                               min="<?= date('Y-m-d') ?>"
                               required>
                        <small class="form-text">From</small>
                    </div>
                    <div style="text-align: center; font-size: 1.5rem; color: #666;">→</div>
                    <div>
                        <input type="date" 
                               name="end_date" 
                               id="end_date" 
                               class="form-control" 
                               value="<?= old('end_date', date('Y-m-d', strtotime('+7 days'))) ?>" 
                               min="<?= date('Y-m-d') ?>"
                               required>
                        <small class="form-text">To</small>
                    </div>
                </div>
                <small class="form-text">All dates between (and including) these two dates will be made available.</small>
            </div>

            <div class="form-group">
                <label for="notes">Notes (Optional)</label>
                <textarea name="notes" 
                          id="notes" 
                          class="form-control" 
                          rows="3"
                          placeholder="Add any internal notes about these dates..."><?= old('notes') ?></textarea>
                <small class="form-text">These notes will be applied to all dates in the range.</small>
            </div>

            <button type="submit" class="btn-submit">
                ✓ Make All Dates in Range Available
            </button>
        </form>

        <div style="margin-top: 2rem; text-align: center;">
            <p style="color: #666;">Need to add just one specific date?</p>
            <a href="<?= base_url('/admin/available-dates-manager/create') ?>" class="btn btn-outline">
                ➕ Add Single Date Instead
            </a>
        </div>
    </div>
</div>

<script>
// Auto-update end date when start date changes
document.getElementById('start_date').addEventListener('change', function() {
    const startDate = new Date(this.value);
    const endDateInput = document.getElementById('end_date');
    const endDate = new Date(endDateInput.value);
    
    // If end date is before start date, update it to 7 days after start
    if (endDate < startDate) {
        const newEndDate = new Date(startDate);
        newEndDate.setDate(newEndDate.getDate() + 7);
        endDateInput.value = newEndDate.toISOString().split('T')[0];
    }
    
    // Update min attribute of end date
    endDateInput.min = this.value;
});
</script>


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
</style>

<div class="admin-container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1 style="margin: 0;">➕ Add Single Available Date</h1>
        <a href="<?= base_url('/admin/available-dates-manager') ?>" class="btn btn-secondary">← Back to List</a>
    </div>

    <div class="form-container">
        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <ul style="margin: 0; padding-left: 1.5rem;">
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('/admin/available-dates-manager/store') ?>" method="post">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="date">Select Date *</label>
                <input type="date" 
                       name="date" 
                       id="date" 
                       class="form-control" 
                       value="<?= old('date', date('Y-m-d')) ?>" 
                       min="<?= date('Y-m-d') ?>"
                       required>
                <small class="form-text">Choose a date you want to make available for booking.</small>
            </div>

            <div class="form-group">
                <label for="notes">Notes (Optional)</label>
                <textarea name="notes" 
                          id="notes" 
                          class="form-control" 
                          rows="3"
                          placeholder="Add any internal notes about this date..."><?= old('notes') ?></textarea>
                <small class="form-text">These notes are for admin use only and won't be visible to customers.</small>
            </div>

            <button type="submit" class="btn-submit">
                ✓ Make This Date Available
            </button>
        </form>

        <div style="margin-top: 2rem; text-align: center;">
            <p style="color: #666;">Need to add multiple dates at once?</p>
            <a href="<?= base_url('/admin/available-dates-manager/bulk-create') ?>" class="btn btn-outline">
                📆 Use Bulk Add Instead
            </a>
        </div>
    </div>
</div>


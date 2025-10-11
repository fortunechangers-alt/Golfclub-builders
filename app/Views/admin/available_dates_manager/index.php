<style>
.dates-container {
    background: white;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.date-item {
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

.date-item:hover {
    border-color: var(--golf-green);
    transform: translateX(5px);
}

.date-item.inactive {
    background: #f5f5f5;
    opacity: 0.6;
}

.date-display {
    font-weight: 600;
    color: var(--navy-blue);
    font-size: 1.1rem;
}

.date-actions {
    display: flex;
    gap: 0.5rem;
}

.date-actions button, .date-actions a {
    padding: 0.5rem 1rem;
    border-radius: 6px;
    cursor: pointer;
    font-size: 0.9rem;
    text-decoration: none;
    border: none;
}

.btn-toggle {
    background: var(--golf-green);
    color: white;
}

.btn-toggle.inactive {
    background: #ccc;
}

.btn-delete {
    background: #dc3545;
    color: white;
}

.action-buttons {
    display: flex;
    gap: 1rem;
    margin-bottom: 2rem;
}

.empty-state {
    text-align: center;
    padding: 3rem;
    color: #666;
}

.empty-state-icon {
    font-size: 4rem;
    margin-bottom: 1rem;
}
</style>

<div class="admin-container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1 style="margin: 0;">📅 Manage Available Dates</h1>
        <a href="<?= base_url('/admin/dashboard') ?>" class="btn btn-secondary">← Back to Dashboard</a>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <div class="action-buttons">
        <a href="<?= base_url('/admin/available-dates-manager/create') ?>" class="btn btn-primary">
            ➕ Add Single Date
        </a>
        <a href="<?= base_url('/admin/available-dates-manager/bulk-create') ?>" class="btn btn-primary">
            📆 Add Date Range
        </a>
    </div>

    <div class="dates-container">
        <h2 style="margin-bottom: 1.5rem;">All Available Dates (<?= count($dates) ?>)</h2>

        <?php if (empty($dates)): ?>
            <div class="empty-state">
                <div class="empty-state-icon">📭</div>
                <h3>No Available Dates Yet</h3>
                <p>Add your first available date to let customers book appointments.</p>
                <a href="<?= base_url('/admin/available-dates-manager/create') ?>" class="btn btn-primary" style="margin-top: 1rem;">
                    ➕ Add Your First Date
                </a>
            </div>
        <?php else: ?>
            <?php foreach ($dates as $date): ?>
                <div class="date-item <?= $date['is_active'] ? '' : 'inactive' ?>">
                    <div>
                        <div class="date-display">
                            <?= date('l, F j, Y', strtotime($date['date'])) ?>
                        </div>
                        <?php if (!empty($date['notes'])): ?>
                            <small style="color: #888;">📝 <?= esc($date['notes']) ?></small>
                        <?php endif; ?>
                        <br>
                        <small style="color: <?= $date['is_active'] ? 'var(--golf-green)' : '#999' ?>;">
                            <?= $date['is_active'] ? '✅ Active' : '❌ Inactive' ?>
                        </small>
                    </div>
                    <div class="date-actions">
                        <form action="<?= base_url('/admin/available-dates-manager/toggle-status/' . $date['id']) ?>" method="post" style="display: inline;">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn-toggle <?= $date['is_active'] ? '' : 'inactive' ?>">
                                <?= $date['is_active'] ? 'Deactivate' : 'Activate' ?>
                            </button>
                        </form>
                        <form action="<?= base_url('/admin/available-dates-manager/delete/' . $date['id']) ?>" method="post" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this date? This cannot be undone.');">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn-delete">🗑️ Delete</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>


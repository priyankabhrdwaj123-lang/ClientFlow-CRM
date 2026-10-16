
<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="dashboard-page">

    <div class="dashboard-heading">
        <div>
            <p class="dashboard-eyebrow">OVERVIEW</p>
            <h1>Dashboard</h1>
            <p class="dashboard-subtitle">
                Track your customer relationships and business activity.
            </p>
        </div>

        <div class="dashboard-date">
            <span class="dashboard-date-label">TODAY</span>
            <strong><?= date('d M Y') ?></strong>
        </div>
    </div>

    <div class="dashboard-welcome">
        <div>
            <span class="welcome-label">CLIENTFLOW CRM</span>
            <h2>Your business, at a glance.</h2>
            <p>Manage relationships, organize customer information, and stay on top of your workflow.</p>
        </div>
        <div class="welcome-mark" aria-hidden="true">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <div class="dashboard-section-heading">
        <div>
            <h2>Business Overview</h2>
            <p>Your customer database summary</p>
        </div>
    </div>

    <div class="dashboard-stats">
        <div class="card stat-card">
            <div class="stat-topline">
                <span class="stat-label">Total Customers</span>
                <span class="stat-icon customers-icon">C</span>
            </div>

            <div class="stat-value">
                <?= esc($totalCustomers) ?>
            </div>

            <p class="stat-description">Customers stored in your CRM</p>
        </div>

        <div class="card stat-card">
            <div class="stat-topline">
                <span class="stat-label">Recent Records</span>
                <span class="stat-icon recent-icon">R</span>
            </div>

            <div class="stat-value">
                <?= esc(count($recentCustomers)) ?>
            </div>

            <p class="stat-description">Latest customer records loaded</p>
        </div>
    </div>

    <div class="dashboard-bottom-grid">

        <div class="card dashboard-activity-card">
            <div class="dashboard-card-heading">
                <div>
                    <h2>Recent Activity</h2>
                    <p>Your latest customer records</p>
                </div>

                <span class="activity-status">LIVE DATA</span>
            </div>

            <?php if (! empty($recentCustomers)): ?>
                <div class="activity-list">
                    <?php foreach ($recentCustomers as $customer): ?>
                        <div class="activity-item">
                            <div class="activity-avatar">
                                <?= esc(strtoupper(substr($customer['name'], 0, 1))) ?>
                            </div>

                            <div class="activity-details">
                                <strong><?= esc($customer['name']) ?></strong>
                                <span><?= esc($customer['email']) ?></span>
                            </div>

                            <div class="activity-company">
                                <?= esc($customer['company'] ?: 'Individual') ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="dashboard-empty-state">
                    <h3>No customer records yet</h3>
                    <p>Customer activity will appear here when records are available.</p>
                </div>
            <?php endif; ?>
        </div>

        <div class="card dashboard-quick-card">
            <h2>Quick Navigation</h2>
            <p>Go directly to a section of your CRM.</p>

            <a href="<?= site_url('customers') ?>" class="dashboard-nav-link">
                <span class="nav-link-icon">C</span>
                <span>
                    <strong>Customers</strong>
                    <small>View and manage records</small>
                </span>
                <span class="nav-arrow">&rarr;</span>
            </a>

            <a href="<?= site_url('customers/create') ?>" class="dashboard-nav-link">
                <span class="nav-link-icon">+</span>
                <span>
                    <strong>Create Customer</strong>
                    <small>Add a new customer record</small>
                </span>
                <span class="nav-arrow">&rarr;</span>
            </a>
        </div>

    </div>

</div>

<?= $this->endSection() ?>

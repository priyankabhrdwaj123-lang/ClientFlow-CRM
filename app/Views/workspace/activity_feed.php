
<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="page-header">
    <div>
        <h1>Activity Feed</h1>
        <p>Stay updated with the latest activity across your CRM.</p>
    </div>
</div>

<div class="activity-summary">
    <div class="activity-stat">
        <div class="activity-stat-icon purple">
            <i class="fa-solid fa-users"></i>
        </div>
        <div>
            <span>Total Customers</span>
            <h3>24</h3>
        </div>
    </div>

    <div class="activity-stat">
        <div class="activity-stat-icon green">
            <i class="fa-solid fa-circle-check"></i>
        </div>
        <div>
            <span>Completed Activities</span>
            <h3>12</h3>
        </div>
    </div>

    <div class="activity-stat">
        <div class="activity-stat-icon orange">
            <i class="fa-solid fa-clock"></i>
        </div>
        <div>
            <span>Pending Activities</span>
            <h3>5</h3>
        </div>
    </div>
</div>

<div class="activity-panel">
    <div class="activity-panel-header">
        <div>
            <h2>Recent Activity</h2>
            <p>A timeline of recent CRM updates</p>
        </div>
        <span class="activity-live-label">Recent updates</span>
    </div>

    <div class="activity-timeline">

        <div class="activity-entry">
            <div class="activity-entry-icon purple">
                <i class="fa-solid fa-user-plus"></i>
            </div>
            <div class="activity-entry-content">
                <h3>New customer added</h3>
                <p>A new customer was added to the customer directory.</p>
                <span>Today · Sample activity</span>
            </div>
        </div>

        <div class="activity-entry">
            <div class="activity-entry-icon green">
                <i class="fa-solid fa-check"></i>
            </div>
            <div class="activity-entry-content">
                <h3>Follow-up completed</h3>
                <p>A customer follow-up was marked as completed.</p>
                <span>Today · Sample activity</span>
            </div>
        </div>

        <div class="activity-entry">
            <div class="activity-entry-icon blue">
                <i class="fa-solid fa-calendar-check"></i>
            </div>
            <div class="activity-entry-content">
                <h3>Meeting scheduled</h3>
                <p>A new meeting was added to the calendar.</p>
                <span>Recently · Sample activity</span>
            </div>
        </div>

        <div class="activity-entry">
            <div class="activity-entry-icon orange">
                <i class="fa-solid fa-pen-to-square"></i>
            </div>
            <div class="activity-entry-content">
                <h3>Customer details updated</h3>
                <p>Customer information was updated in the CRM.</p>
                <span>Recently · Sample activity</span>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection() ?>

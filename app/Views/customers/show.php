<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="page-header">
    <div>
        <h1>Customer Details</h1>
        <p>View complete information about this customer.</p>
    </div>

    <div>
        <a href="<?= site_url('customers') ?>" class="btn btn-secondary">
            Back to Customers
        </a>

        <a href="<?= site_url('customers/' . $customer['id'] . '/edit') ?>" class="btn btn-primary">
            Edit Customer
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h2><?= esc($customer['name']) ?></h2>
    </div>

    <div class="card-body">
        <p>
            <strong>Customer ID:</strong>
            <?= esc($customer['id']) ?>
        </p>

        <p>
            <strong>Full Name:</strong>
            <?= esc($customer['name']) ?>
        </p>

        <p>
            <strong>Email:</strong>
            <?= esc($customer['email']) ?>
        </p>

        <p>
            <strong>Phone:</strong>
            <?= esc($customer['phone'] ?? 'Not provided') ?>
        </p>

        <p>
            <strong>Company:</strong>
            <?= esc($customer['company'] ?? 'Not provided') ?>
        </p>

        <p>
            <strong>Created At:</strong>
            <?= esc($customer['created_at'] ?? 'Not available') ?>
        </p>

        <p>
            <strong>Last Updated:</strong>
            <?= esc($customer['updated_at'] ?? 'Not available') ?>
        </p>
    </div>
</div>

<?= $this->endSection() ?>

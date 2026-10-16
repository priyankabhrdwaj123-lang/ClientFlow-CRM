<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="page-header">
    <div>
        <h1 class="page-title">Add Customer</h1>
        <p class="page-subtitle">
            Add a new customer to ClientFlow CRM.
        </p>
    </div>

    <a href="<?= site_url('customers') ?>" class="btn btn-primary">
        Back to Customers
    </a>
</div>

<div class="card">


    <?php if (session()->has('errors')): ?>
        <div class="alert alert-error">
            <?php foreach (session('errors') as $error): ?>
                <p><?= esc($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('customers/store') ?>" method="post">

        <?= csrf_field() ?>

        <div class="form-group">
            <label for="name" class="form-label">Customer Name *</label>
            <input
                type="text"
                id="name"
                name="name"
                class="form-control"
                placeholder="Enter customer name"
                required>
        </div>

        <div class="form-group">
            <label for="email" class="form-label">Email Address *</label>
            <input
                type="email"
                id="email"
                name="email"
                class="form-control"
                placeholder="Enter email address"
                required>
        </div>

        <div class="form-group">
            <label for="phone" class="form-label">Phone Number</label>
            <input
                type="text"
                id="phone"
                name="phone"
                class="form-control"
                placeholder="Enter phone number">
        </div>

        <div class="form-group">
            <label for="company" class="form-label">Company</label>
            <input
                type="text"
                id="company"
                name="company"
                class="form-control"
                placeholder="Enter company name">
        </div>

        <button type="submit" class="btn btn-primary">
            Save Customer
        </button>

    </form>
</div>

<?= $this->endSection() ?>